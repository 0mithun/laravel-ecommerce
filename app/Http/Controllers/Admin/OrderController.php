<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\OrderContract;
use App\Http\Controllers\BaseController;

class OrderController extends BaseController {

    /**
     * @var mixed
     */
    protected $orderRepository;

    /**
     * @param OrderContract $orderRepository
     */
    public function __construct( OrderContract $orderRepository ) {
        $this->orderRepository = $orderRepository;
    }

    public function index() {
        $orders = $this->orderRepository->listOrders();
        $this->setPageTitle( 'Orders', 'List of all orders' );

        return view( 'admin.orders.index', compact( 'orders' ) );
    }

    /**
     * @param $orderNumber
     */
    public function show( $orderNumber ) {
        $order = $this->orderRepository->findOrderByNumber( $orderNumber );
        $this->setPageTitle( 'Order Details', $orderNumber );

        return view( 'admin.orders.show', compact( 'order' ) );
    }
}
