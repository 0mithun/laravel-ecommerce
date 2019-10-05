<?php

namespace App\Http\Controllers\Site;

use App\Contracts\ProductContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function show($slug){
        $product = $this->productRepository->findProductBySlug($slug);

        dd($product);
        return view('site.product.show');
    }
}
