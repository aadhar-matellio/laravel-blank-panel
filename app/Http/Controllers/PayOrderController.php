<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Classes\PricesClass;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store()
    {
        // die('here');
        $paymentGateway = new PaymentGateway();
        dd($paymentGateway);
    }

    public function getHome()
    {
        $pricesClass = new PricesClass();
        $prices = $pricesClass->getPrices();
        return view('pages.home', compact('prices'));
    }
}
