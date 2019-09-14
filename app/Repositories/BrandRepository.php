<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Traits\UploadAble;
use App\Contracts\BrandContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

/**
 * class BrandRepository
 *
 * @package \App\Repository
 */

class BrandRepository extends BaseRepository implements BrandContract{
    use UploadAble;

    /**
     * BrandRepository constructor
     *@param Brand $model
     */

     public function __construct(Brand $model)
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

      public function listBrands(string $order = 'id', string $sort = 'DESC', array $columns = ['*'])
      {
          return $this->all($columns, $order, $sort);
      }

     /**
      * @param int $id
      * @return mixed
      * @throws ModelNotFoundException
      */

     public function findBrandById(int $id)
     {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
     }


     /**
      * @param array $columns
      * @return brand|mixed
      */

     public function createBrand(array $columns)
     {
         try {
             $collection = collect($columns);
             $logo = null;

             if($collection->has('logo') && ($columns['logo'] instanceof UploadedFile)){
                $logo = $this->uploadOne($columns['logo'],'brands');
             }

             $merge = $collection->merge(compact('logo'));

             $brand = new Brand($merge->all());
             $brand->save();
             return $brand;
         } catch (QueryException $e) {
             throw new InvalidArgumentException($e);
         }
     }


     /**
      * @param array $columns
      * @return mixed
      */

    public function updateBrand(array $columns)
    {
        $brand = $this->findBrandById($columns['id']);
        $collection = collect($columns->except('_token'));

        if($collection->has('logo') && ($columns['logo'] instanceof UploadedFile)){
            if($brand->logo != null){
                $this->deleteOne($brand->logo);
            }
            $logo = $this->uploadOne($columns['logo'],'brands');
        }

        $merge = $columns->merge(compact('logo'));

        $brand->update($merge->all());

        return $brand;


    }


    /**
     * @param int $id
     * @return bool|mixed
     */

    public function deleteBrand(int $id)
    {
        $brand = $this->findBrandById($id);
        if($brand->logo != null){
            $this->deleteOne($brand->logo);
        }

        $brand->delete();
        return $brand;
    }

}
