<?php

use App\Models\Course;
use App\Models\Payment;
use App\Models\Story;
use App\Models\StoryComment;
use App\Models\StoryTag;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->course = Course::factory()->create();
    $this->student = Student::factory()->create();
    $this->user = User::factory()->create();
    $this->story = Story::factory()->create([
        'student_id' => $this->student->id,
        'published' => true,
    ]);
    $this->tags = StoryTag::factory()->create();

    // Create courses
    $this->course1 = Course::factory()->create();
    $this->course2 = Course::factory()->create();

    // Create payments
    Payment::factory()->create([
        'student_id' => $this->student->id,
        'course_id' => $this->course1->id,
        'payment_date' => now()->subDays(10), // Past payment
        'status' => 'Completed',
    ]);

    Payment::factory()->create([
        'student_id' => $this->student->id,
        'course_id' => $this->course2->id,
        'payment_date' => now()->addDays(10), // Future payment
        'status' => 'Pending',
    ]);
});
test('test student can create story', function () {
    $this->actingAs($this->user)
        ->post('/stories', [
            'title' => 'Test story',
            'content' => 'Test content',
            'status' => 'draft',
            'image' => null,
            'published' => true,
            'student_id' => 1,
        ])
        ->assertRedirect('/stories')
        ->assertSessionHasNoErrors()
        ->assertSessionHas('message');
})->skip();
test('test student can update story', function () {
    $this->actingAs($this->user)
        ->put('/stories/' . $this->story->id, [
            'title' => 'Test story',
            'content' => 'Test content',
            'status' => 'draft',
            'image' => $this->story->image,
            'published' => true,
            'student_id' => 1,
        ])->assertRedirect('/stories')
        ->assertSessionHasNoErrors()
        ->assertSessionHas('message');
});
test('test student can delete his story', function () {
    $this->actingAs($this->user)
        ->delete('/stories/' . $this->story->id)
        ->assertRedirect('/stories')
        ->assertSessionHasNoErrors()
        ->assertSessionHas('message');
});
test('test student can write a comment on story', function () {

    $this->actingAs($this->user)
        ->post('/storyComment/' . $this->story->id . '/comments', [
            'content' => 'Test comment',
            'status' => 'draft',
            'parent_id' => null,
            'story_id' => $this->story->id,
            'student_id' => $this->student->id,
        ])
        ->assertSessionHas('message')
        ->assertSessionHasNoErrors();
});
test('test student can view all stories', function () {

    $res = $this->actingAs($this->user)->get('/stories');

    $res->assertStatus(200);
    $res->assertInertia(fn($page) => $page->component('Stories/Index')
        ->has('stories')
        ->has('tags')
    );
});
test('test student can view a story with its comments', function () {

    $comment = StoryComment::factory()->create([
        'story_id' => $this->story->id,
    ]);
    $this->story->comments()->save($comment);
    $this->actingAs($this->user)->get('/stories/' . $this->story->id)
        ->assertStatus(200)->assertInertia(fn($page) => $page->component('Stories/Show'));
    $this->assertDatabaseHas('story_comments', [
        'story_id' => $this->story->id,
        'parent_id' => null,
        'content' => $comment->content,
        'status' => $comment->status,
    ]);
});
test('test guest or unauthenticated users cannot access stories', function () {
    $this->get('/stories')->assertRedirect('login');
});
test('test student cannot create story with invalid data', function () {
    $this->actingAs($this->user)
        ->post('/stories', [
            'title' => '',
            'content' => '',
        ])
        ->assertSessionHasErrors(['title', 'content']);
});
test('test student cannot delete another student\'s story', function () {
    $anotherStory = Story::factory()->create();
    $this->actingAs($this->user)
        ->delete('/stories/' . $anotherStory->id)
        ->assertstatus(302)
        ->assertSessionHas('message')
        ->assertRedirect('/stories');
});
test('test student cannot view draft stories', function () {
    $draftStory = Story::factory()->create(['status' => 'draft']);
    $this->actingAs($this->user)
        ->get('/stories/' . $draftStory->id)
        ->assertstatus(302)
        ->assertSessionHas('message')
        ->assertRedirect('/stories');
})
    ->todo('check the status');
