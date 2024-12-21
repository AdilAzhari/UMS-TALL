<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\Factory as Queue;
use LaravelIdea\Helper\App\Models\_IH_Payment_C;

class PaymentStatusChanged implements Mailable
{
    /**
     * @param _IH_Payment_C|Payment|Payment[] $payment
     */
    public function __construct(Payment|array|_IH_Payment_C $payment)
    {
    }

    public function build()
    {
    }

    public function send($mailer)
    {
        // TODO: Implement send() method.
    }

    public function queue(Queue $queue)
    {
        // TODO: Implement queue() method.
    }

    public function later($delay, Queue $queue)
    {
        // TODO: Implement later() method.
    }

    public function cc($address, $name = null)
    {
        // TODO: Implement cc() method.
    }

    public function bcc($address, $name = null)
    {
        // TODO: Implement bcc() method.
    }

    public function to($address, $name = null)
    {
        // TODO: Implement to() method.
    }

    public function locale($locale)
    {
        // TODO: Implement locale() method.
    }

    public function mailer($mailer)
    {
        // TODO: Implement mailer() method.
    }
}
