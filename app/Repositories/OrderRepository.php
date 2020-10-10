<?php

namespace App\Repositories;

use App\Model\Order;
use App\Contracts\OrderContract;

class OrderRepository extends BaseRepository implements OrderContract{



    public function __construct(Order $order){
        
        parent::__construct($order);

        $this->model = $order;
    }

    public function storeOrderDetails($params){
        
    }
}