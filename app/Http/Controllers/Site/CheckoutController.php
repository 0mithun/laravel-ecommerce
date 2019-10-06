<?php

namespace App\Http\Controllers\Site;

use App\Contracts\OrderContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout(){
        return view('site.pages.checkout');
    }

    public function placeOrder(Request $request){
        $order = $this->orderRepository->storeOrderDetails($request->all());

        dd($order);
    }
}
