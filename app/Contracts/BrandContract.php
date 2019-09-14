<?php

namespace App\Contracts;


/**
 * Interface BrandContract
 * @package App\Contracts
 */

interface BrandContract{
/**
 * @param string $order
 * @param strig $sort
 * @param array $columns
 * @return mixed
 */

    public function listBrands(string $order ='id', string $sort ='DESC', array $columns =['*']);


    /**
     * @param int $id
     * @return mixed
     */

    public function findBrandById(int $id);

    /**
     * @param array $columns
     * @return mixed
     */

    public function createBrand(array $columns);


    /**
     * @params array $columns
     * @return mixed
     */

     public function updateBrand(array $columns);


     /**
      * @params int id
      * @return bool
      */

    public function deleteBrand(int $id);


}
