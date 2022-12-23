<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Blog\BlogService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private ProductService $productService;
    private BlogService $blogService;

    public function __construct(ProductService $productService,
                                BlogService $blogService)
    {
        $this->productService=$productService;
        $this->blogService = $blogService;
    }

    public function index()
    {
        $featuredProducts = $this->productService->getFeaturedProducts();
        $latestBlogs = $this->blogService->getLatestBlogs();
        return view('front.index',compact('featuredProducts','latestBlogs'));
    }
}
