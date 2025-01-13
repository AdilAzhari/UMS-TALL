<?php

use App\Models\Course;
use App\Models\Payment;
use App\Models\Program;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function (): void {
    $this->user = User::factory()->create();
    $this->student = Student::factory()->create(['user_id' => $this->user->id]);
    $this->actingAs($this->user);
});
test('displays historical and upcoming payments', function (): void {
    $student = Student::factory()->create();
    Payment::factory()->create([
        'payment_date' => now()->subDay(),
        'status' => 'Completed',
        'student_id' => $student->id,
    ]);

    Payment::factory()->create([
        'payment_date' => now()->addDay(),
        'status' => 'Pending',
        'student_id' => $student->id,
    ]);
    $this->get('/payments?tab=history')->assertInertia(fn ($page) => $page
        ->component('Payments/Index')
        ->has('historicalPayments')
        ->has('upcomingPayments')
    );
});
it('renders the payments index page', function (): void {
    $user = User::factory(1)->create();
    $course = Course::factory()->create();
    //    $this->actingAs($user);
    $response = $this->get('/payments');

    Payment::factory()->count(3)->state([
        'status' => 'completed', ])
        ->create(['course_id' => $course->id,
            'student_id' => student::factory(1)->create(['user_id' => $user->id])->id,
            'program_id' => Program::factory()->create()->id]);
    //    $upcomingPayments = Payment::factory()->count(2)->state(['status' => 'Pending'])->create();

    $response->assertStatus(200);

})->skip();

it('processes a successful payment', function (): void {
    Http::fake([
        'https://api.stripe.com/*' => Http::response([
            'id' => 'pi_123',
            'status' => 'succeeded',
        ]),
    ]);

    $response = $this->post(route('payments.store'), [
        'student_name' => 'John Doe',
        'student_id' => $this->student->id,
        'amount' => 100.50,
        'payment_method_id' => 'pm_card_visa',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Payment successful!');
});

it('it correctly separates past and upcoming payments', function (): void {
    $student = Student::factory()->create();
    $user = User::factory()->create();
    // Create courses
    $course1 = Course::factory()->create();
    $course2 = Course::factory()->create();

    // Create payments
    Payment::factory()->create([
        'student_id' => $student->id,
        'course_id' => $course1->id,
        'payment_date' => now()->subDays(10), // Past payment
        'status' => 'Completed',
    ]);

    Payment::factory()->create([
        'student_id' => $student->id,
        'course_id' => $course2->id,
        'payment_date' => now()->addDays(10), // Future payment
        'status' => 'Pending',
    ]);

    // Fetch payments grouped by past and upcoming
    $pastPayments = (new App\Models\Payment)->where('payment_date', '<', now())->get();
    $upcomingPayments = (new App\Models\Payment)->where('payment_date', '>=', now())->get();

    // Assertions
    $this->assertCount(1, $pastPayments);
    $this->assertEquals('Completed', $pastPayments->first()->status);

    $this->assertCount(1, $upcomingPayments);
    $this->assertEquals('Pending', $upcomingPayments->first()->status);

    $response = $this->actingAs($user)->get('/payments');
    dump($response->headers->get('Location'));
    $response->assertStatus(200);
});

it('Successful payment handling', function (): void {
});

it('test it show the payment handling page', function (): void {
});
it('Payment cancellation', function (): void {
});
it('Payment creation', function (): void {
    todo('make payment');
});
it('handles a failed payment gracefully', function (): void {
    Http::fake([
        'https://api.stripe.com/*' => Http::response([
            'error' => ['message' => 'Your card was declined.'],
        ], 400),
    ]);

    $response = $this->post(route('payments.pay', '1234567890'), [
        'student_name' => 'John Doe',
        'student_id' => $this->student->id,
        'amount' => 100.50,
        'payment_method_id' => 'pm_card_visa',
    ]);
    //    dd($this);
    $response->assertRedirect();
    $response->assertSessionHasErrors(['error' => 'Your card was declined.']);
})->only();
