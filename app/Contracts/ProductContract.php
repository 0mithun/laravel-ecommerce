<?php

namespace App\Contracts;

/**
 * Interface ProductContract
 * @package App\Contracts
 */

interface ProductContract{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */

    public function listProducts(string $order = 'id', string $sort='DESC', array $columns = ['*']);



    /**
     * @param int $id
     * @return mixed
     */

    public function findProductById(int $id);



    /**
     * @params array $columns
     * @return mixed
     */

     public function createProduct(array $columns);


     /**
      * @param array columns
      * @return mixed
      */

    public function updateProduct(array $columns);



    /**
     * @param int $id
     * @return bool
     */

    public function deleteProduct(int $id);
}
