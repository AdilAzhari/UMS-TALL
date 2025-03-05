<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Notifications\PaymentFailedNotification;
use App\Notifications\PaymentSuccessNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use LaravelIdea\Helper\App\Models\_IH_Payment_C;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function __construct(public StripeClient $stripe)
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

        return $studentPayment->status == 'paid'
            ? back()->with('error', 'Payment already made')
            : redirect($this->getSession($studentPayment)->url);
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
                'payment_intent' => $payment->payment_intent,
            ]);

            // Update payment status
            $payment->status = 'Refunded';
            $payment->refund_id = $refund->id;
            $payment->save();

            Mail::to($$payment->student->email)->send(new PaymentStatusChanged($payment));

            return redirect()->route('payments.index')->with('success', 'Payment refunded successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Refund failed: '.$e->getMessage());
        }
    }

    /**
     * @throws ApiErrorException
     */
    public function getSession(Payment|_IH_Payment_C|array $studentPayment): \Stripe\Checkout\Session
    {
        return $this->stripe->checkout->sessions->create([
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
    }
}
