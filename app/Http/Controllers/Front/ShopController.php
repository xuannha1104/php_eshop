<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Brand\BrandService;
use App\Services\Product\ProductService;
use App\Services\ProductCategoryService\ProductCategoryService;
use App\Services\ProductComment\ProductCommentService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private ProductService $productService;
    private ProductCommentService $productCommentService;
    private ProductCategoryService $productCategoryService;
    private BrandService $brandService;

    public function __construct(ProductService $productService,
                                ProductCommentService $productCommentService,
                                ProductCategoryService $productCategoryService,
                                BrandService $brandService)
    {
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
        $this->productCategoryService = $productCategoryService;
        $this->brandService = $brandService;
    }

    public function show($id)
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        $product = $this->productService->Find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        return view('front.shop.show',compact('product','relatedProducts','categories','brands'));
    }

    public function postComment(Request $request)
    {
        $this->productCommentService->Create($request->all());
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        $products = $this->productService->getProductOnIndex($request);
        return view('front.shop.index',compact('products','categories','brands'));
    }

    public function category(Request $request,string $categoryName)
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        $products = $this->productService->getProductByCategory($request,$categoryName);
        return view('front.shop.index',compact('products','categories','brands'));
    }
}
