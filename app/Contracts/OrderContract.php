<?php

namespace App\Contracts;

interface OrderContract {

    /**
     * @param $params
     */
    public function storeOrderDetails( $params );

    /**
     * @param string $order
     * @param string $sort
     * @param array  $columns
     */
    public function listOrders( string $order = 'id', string $sort = 'DESC', array $columns = ['*'] );

    /**
     * @param $orderNumber
     */
    public function findOrderByNumber( $orderNumber );
}
