<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Notifications\PaymentFailedNotification;
use App\Notifications\PaymentSuccessNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(
            config('services.stripe.secret')
        );
    }

    /**
     * @throws ApiErrorException
     */
    public function pay(request $request)
    {
        if (! $request->has('id') || ! is_numeric($request->id)) {
            return redirect()->back()->with('error', 'Invalid payment ID');
        }

        $studentPayment = Payment::findOrFail($request->id);

        if ($studentPayment->status == 'paid') {
            return redirect()->back()->with('error', 'Payment already made');
        }

        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $studentPayment->course->name,
                    ],
                    'unit_amount' => $studentPayment->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payments.success', ['paymentId' => $studentPayment->id]),
            'cancel_url' => route('payments.cancel', ['paymentId' => $studentPayment->id]),
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess($paymentId)
    {
        $payment = Payment::findOrFail($paymentId)->load('student.user');
        $payment->status = 'Completed';
        $payment->payment_date = now();
        $payment->save();

        if ($payment->student && $payment->student->user) {
            Notification::send($payment->student->user, new PaymentSuccessNotification($payment));
        }

        return redirect()->route('payments.index')->with('success', 'Payment successful');
    }

    public function paymentCancel($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->status = 'Cancelled';
        $payment->save();

        Notification::send($payment->student->user, new PaymentFailedNotification($payment));

        return redirect()->route('payments.index')->with('error', 'Payment cancelled');
    }

    public function refund($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // Only refund if the payment is already marked as paid
        if ($payment->status !== 'paid') {
            return redirect()->back()->with('error', 'Cannot refund an unpaid payment.');
        }

        // Refund through Stripe
        try {
            $refund = $this->stripe->refunds->create([
                'payment_intent' => $payment->payment_intent, // Store `payment_intent` from Stripe in your Payment model
            ]);

            // Update payment status
            $payment->status = 'Refunded';
            $payment->refund_id = $refund->id; // Store the refund ID for tracking
            $payment->save();

            Mail::to($$payment->student->email)->send(new PaymentStatusChanged($payment));

            return redirect()->route('payments.index')->with('success', 'Payment refunded successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Refund failed: '.$e->getMessage());
        }
    }
}
