<?php

namespace App\Http\Controllers\Site;

use App\Contracts\CategoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $catgoryRepository;

    public function __construct(CategoryContract $catgoryRepository)
    {
        $this->catgoryRepository = $catgoryRepository;
    }


    public function show($slug){
        $category = $this->catgoryRepository->findBySlug($slug);

        dd($category);
        return view('site.pages.category', compact('category'));
    }
}
