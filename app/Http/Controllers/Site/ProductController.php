<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Contracts\AttributeContract;

class ProductController extends Controller
{
    
    protected $productRepository;
    protected $attrbuteRepository;


    public function __construct(ProductContract $productRepository, AttributeContract $attrbuteRepository){
        $this->productRepository = $productRepository;
        $this->attrbuteRepository = $attrbuteRepository;
    }



    public function show($slug){
        
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attrbuteRepository->listAttributes();

        // dd($product);

        return view('site.pages.product', compact('product','attributes'));
    }

    public function addToCart(Request $request){
        dd($request);
    }
}
