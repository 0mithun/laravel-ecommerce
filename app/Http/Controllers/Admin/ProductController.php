<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreProductFormRequest;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected $brandRepository;

    protected $categoryRepository;

    protected $productRepository;

    public function __construct(BrandContract $brandRepository, CategoryContract $categoryRepository, ProductContract $productRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }



    public function index(){
        $products = $this->productRepository->listProducts();

        $this->setPageTitle('Products','Products List');
        return view('admin.products.index', compact('products'));
    }


    public function create(){
        $brands = $this->brandRepository->listBrands('name','asc');

        $categories = $this->categoryRepository->listCategories('name','asc');

        $this->setPageTitle('Products','Create Product');

        return view('admin.products.create', compact('brands','categories'));
    }


    public function store(StoreProductFormRequest $request){
        $columns = $request->except('_token');

        $product = $this->productRepository->createProduct($columns);

        if(!$product){
            return $this->responseRedirectBack('Error occurred while creating product', 'error', true, true);
        }

        return $this->responseRedirect('admin.products.index','Producdt added successfully','success',false, false);
    }



    public function edit($id){
        $product = $this->productRepository->findProductById($id);

        $brands = $this->brandRepository->listBrands('name','asc');
        $categories= $this->categoryRepository->listCategories('name','asc');

        $this->setPageTitle('Products','Edit Product : '.$product->name);

        return view('admin.products.edit', compact('product','brands','categories'));
    }

    public function update(StoreProductFormRequest $request){
        $columns = $request->except('_token');
        $product = $this->productRepository->updateProduct($columns);

        if(!$product){
            return $this->responseRedirectBack('Error occurred while updating product','error', true, true);
        }

        return $this->responseRedirect('admin.products.index','Product update successfully', 'success', false, false);
    }
}
