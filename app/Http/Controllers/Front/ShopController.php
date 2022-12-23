<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use App\Services\ProductComment\ProductCommentService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private ProductService $productService;
    private ProductCommentService $productCommentService;

    public function __construct(ProductService        $productService,
                                ProductCommentService $productCommentService)
    {
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
    }

    public function show($id)
    {
        $product = $this->productService->Find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        return view('front.shop.show',compact('product','relatedProducts'));
    }

    public function postComment(Request $request)
    {
        $this->productCommentService->Create($request->all());
        return redirect()->back();
    }

    public function index()
    {
        $products = $this->productService->getProductOnIndex();
        return view('front.shop.index',compact('products'));
    }
}
