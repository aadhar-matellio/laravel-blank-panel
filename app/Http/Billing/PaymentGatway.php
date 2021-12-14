<?php

namespace App\Http\Billing;

use Illuminate\Support\Str;

class PaymentGateway 
{

    public function index($var = null)
    {
        die('index');
    }

    public function charge($amount)
    {
        return [
            'amount' => $amount,
            'confirmation_number' => Str::random(),
        ];
    }


}
