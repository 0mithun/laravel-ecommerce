<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Services\PaypalService;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    protected $orderRepository;
    protected $payPal;

    public function __construct(OrderContract $orderRepository, PaypalService $payPal)
    {
        $this->orderRepository = $orderRepository;
        $this->payPal = $payPal;
    }

    public function getCheckout(){
        return view('site.pages.checkout');
    }

    public function placeOrder(Request $request){
        $order = $this->orderRepository->storeOrderDetails($request->all());

        if($order){
            $this->payPal->processPayment($order);
        }

        return \redirect()->back()->with('message','Order not placed');
    }


    public function complete(Request $request){
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerId');

        $status = $this->payPal->completePayment($paymentId, $payerId);
        $order = Order::where('order_number',$status['invoiceId']->first());
        $order->status = 'processing';

        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        Cart::clear();
        return view('site.pages.success', compact($order));
    }
}
