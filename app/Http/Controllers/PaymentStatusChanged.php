<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Mail\Mailable;
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
}
