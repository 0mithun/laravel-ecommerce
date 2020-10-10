<?php

namespace App\Repositories;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Contracts\OrderContract;

class OrderRepository extends BaseRepository implements OrderContract {

    /**
     * @param Order $order
     */
    public function __construct( Order $order ) {

        parent::__construct( $order );

        $this->model = $order;
    }

    /**
     * @param  $params
     * @return mixed
     */
    public function storeOrderDetails( $params ) {
        $order = Order::create( [
            'order_number'   => 'ORD-' . \strtoupper( \uniqid() ),
            'user_id'        => \auth()->id(),
            'status'         => 'pending',
            'grand_total'    => Cart::getSubTotal(),
            'item_count'     => Cart::getTotalQuantity(),
            'payment_status' => 0,
            'payment_method' => null,
            'first_name'     => $params['first_name'],
            'last_name'      => $params['last_name'],
            'address'        => $params['address'],
            'city'           => $params['city'],
            'country'        => $params['country'],
            'post_code'      => $params['post_code'],
            'phone_number'   => $params['phone_number'],
            'notes'          => $params['notes'],
        ] );

        if ( $order ) {
            $items = Cart::getContent();

            foreach ( $items as $item ) {
                $product = Product::where( 'name', $item->name )->first();

                $orderItem = new OrderItem( [
                    'product_id' => $product->id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                ] );

                $order->items()->save( $orderItem );
            }

        }

        return $order;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array  $columns
     */
    public function listOrders( string $order = 'id', string $sort = 'DESC', array $columns = ['*'] ) {
        return $this->all( $columns, $order, $sort );
    }

    /**
     * @param $orderNumber
     */
    public function findOrderByNumber( $orderNumber ) {
        return Order::where( 'order_number', $orderNumber )->first();
    }

}
