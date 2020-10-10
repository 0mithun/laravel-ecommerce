<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Services\PaypalService;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller {
    /**
     * @var mixed
     */
    protected $orderRepository;
    /**
     * @var mixed
     */
    protected $paypal;

    /**
     * @param OrderContract $orderRepository
     * @param PaypalService $paypal
     */
    public function __construct( OrderContract $orderRepository, PaypalService $paypal ) {
        $this->orderRepository = $orderRepository;
        $this->paypal = $paypal;
    }

    public function getCheckout() {
        return view( 'site.pages.checkout' );
    }

    /**
     * @param Request $request
     */
    public function placeOrder( Request $request ) {
        $order = $this->orderRepository->storeOrderDetails( $request->all() );

        if ( $order->$this->paypal->processPayment() );

        return \redirect()->back()->with( 'Order not placed.' );

    }

    /**
     * @param Request $request
     */
    public function complete( Request $request ) {

        $payment = $request->paymentId;
        $payerId = $request->PayerId;

        $status = $this->paypal->completePayment( $payment, $payerId );

        $order = Order::where( 'order_id', $status['invoiceId'] )->first();

        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'Paypal - ' . $status['salesId'];
        $order->save();

        Cart::clear();

        return view( 'site.pages.success', compact( 'order' ) );
    }

}
