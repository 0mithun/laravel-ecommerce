<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\UploadAble;
use App\Contracts\ProductContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

/**
 * class ProductRepository
 *
 * @package \App\Repository
 */

 class ProductRepository extends BaseRepository implements ProductContract{
    use UploadAble;

    /**
     * ProductRepository constructor
     * @param Product $model
     */

     public function __construct(Product $model)
     {
         parent::__construct($model);
         $this->model = $model;
     }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */

    public function listProducts(string $order = 'id', string $sort = 'DESC', array $columns = ['*'])
    {
        return $this->model->all($columns, $order, $sort);
    }


    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */

    public function findProductById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }



    /**
     * @param array $columns
     * @return Product|mixed
     */

     public function createProduct(array $columns)
     {
         try {
             $collection = collect($columns);

            $featured = $collection->has('featured') ? 1 : 0;
            $status = $collection->has('status') ? 1 : 0;

            $merge = $collection->merge(compact('featured','status'));

            $product = new Product($merge->all());

            $product->save();

            if($collection->has('categories')){
                $product->categories()->sync($columns['categories']);
            }

            return $product;

         } catch (QueryException $e) {
             throw new InvalidArgumentException($e->getMessage());
         }
     }


    /**
     * @param array $columns
     * @return mixed
     */

     public function updateProduct(array $columns)
     {
         $product= $this->findProductById($columns['product_id']);

         $collection = collect($columns)->except('_token');

         $featured = $collection->has('featured') ? 1 : 0;
         $status = $collection->has('status') ? 1 : 0;

         $merge = $collection->merge(compact('featured','status'));

         $product->update($merge->all());

         if($collection->has('categories')){
             $product->categories()->sync($columns['categories']);
         }

         return $product;
     }


     /**
      * @param int $id
      * @return bool|mixed
      */

     public function deleteProduct(int $id)
     {
         $product = $this->findProductById($id);
         $product->delete();

         return $product;
     }


 }
