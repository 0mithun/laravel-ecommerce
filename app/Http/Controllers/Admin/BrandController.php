<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    /**
     * @var BarndContract
     */

    protected $brandRepository;


    /**
     * BrandController construct
     * @param BrandContract $brandRepository
     */

     public function __construct(BrandContract $brandRepository)
     {
        $this->brandRepository = $brandRepository;
     }


     /**
      * @return \Illuminate\Contracts\View\Factory\Illuminate\View\View
      */

      public function index(){
          $brands = $this->brandRepository->listBrands();

          $this->setPageTitle('Brands','List of all brands');

          return view('admin.brands.index', compact('brands'));
      }


      /**
       * @return \Illuminate\Contracts\View\Factory\Illuminate\View\View
       */

       public function create(){
           $this->setPageTitle('Brands','Create Brand');
           return view('admin.brands.create');
       }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws  \Illuminate\Validation\ValidationException
     */

       public function store(Request $request){
            $this->validate($request,[
                'name'          =>  'required|max:191',
                'logo'          =>  'mimes:png,jpg,jpeg|max:1000'
            ]);

            $params = $request->except('_token');

            $brand = $this->brandRepository->createBrand($params);

            if(!$brand){
                return $this->responseRedirectBack('Error occurred while createing brand.', 'error', true, true);
            }

            return $this->responseRedirect('admin.brands.index', 'Brand added successfully', 'success', false, false);
       }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory\Illuminate\View\View
     */

     public function edit($id){
         $brand = $this->brandRepository->findBrandById($id);
         $this->setPageTitle('Brand', 'Edit brand : '.$brand->name);
         return view('admin.brands.edit', compact('brand'));
     }


     /**
      * @param Request $request
      * @return \Illuminate\Http\RedriectResponse
      * @throws \Illuminate\Validation\ValidationException
      */

     public function update(Request $request){
        $this->validate($request,[
            'name'          =>  'required|max:191',
            'logo'          =>  'mimes:png,jpg,jpeg|max:1000'
        ]);

        $params = $request->except('_token');

        $brand = $this->brandRepository->updateBrand($params);

        if(!$brand){
            return $this->responseRedirectBack('Error occurred while updating brand.', 'error', true, true);
        }

        return $this->responseRedirectBack('Brand updated successfully', 'success', false, false);
     }


     /**
      * @param int $id
      * @return \Illuminate\Http\RedirectResponse
      */

      public function destroy($id){
        $brand = $this->brandRepository->deleteBrand($id);

        if(!$brand){
            return $this->responseRedirectBack('Error occurred while deleting brand', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index','Brand deleted successfully', 'success', false, false);
      }
}
