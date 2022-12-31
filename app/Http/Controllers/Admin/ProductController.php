<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Services\Brand\BrandService;
use App\Services\Product\ProductService;
use App\Services\ProductCategoryService\ProductCategoryService;
use App\Services\ProductDetails\ProductDetailsService;
use App\Services\ProductImage\ProductImageService;
use App\Ultities\Common;
use App\Ultities\Validation\FormValidationException;
use App\Ultities\Validation\ProductCreateForm;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;
use function Termwind\renderUsing;

class ProductController extends Controller
{
    private ProductService $productService;
    private BrandService $brandService;
    private ProductCategoryService $productCategoryService;
    private ProductDetailsService $productDetailsService;
    private ProductImageService $productImageService;

    protected ProductCreateForm $createForm;

    public function __construct(ProductService $productService,BrandService $brandService,
                                ProductCategoryService $productCategoryService,
                                ProductDetailsService $productDetailsService,
                                ProductImageService $productImageService,
                                ProductCreateForm $createForm)
    {
        $this->productService = $productService;
        $this->brandService = $brandService;
        $this->productCategoryService = $productCategoryService;
        $this->productDetailsService = $productDetailsService;
        $this->productImageService = $productImageService;

        $this->createForm = $createForm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productService->searchAndPaginate('name',$request->get('search'));
        return view('admin.Product.index',compact('products'));
    }

    public function imagesIndex($productId)
    {
        $product = $this->productService->Find($productId);
        $images = $product->productImages;
        return view('admin.Product.product-image',compact('product','images'));
    }

    public function imageList(Request $request)
    {
        if($request->ajax())
        {
            return $this->productService->Find($request->get('productId'))->productImages;
        }
        return back();


    }

    public function imageUpload(Request $request)
    {
        if($request->ajax())
        {
            if($_FILES['FileUpload'] != null)
            {
                $uploadFile = $_FILES['FileUpload'];

                $newFileName =  Common::getRandomFileName($uploadFile['name']);
                move_uploaded_file($_FILES['FileUpload']['tmp_name'],'front/img/products/'.$newFileName);

                $data['product_id'] = $request->get('id');
                $data['path'] = $newFileName;

                $this->productImageService->Create($data);

                return "success!";
            }
            return  "fail";
        }

    }

    public function imageDelete(Request $request)
    {
        if($request->ajax())
        {
            $product_image = $this->productImageService->Find($request->get('imageId'));
            $file_name ="front/img/products/".$product_image->path;

            $product_image->delete();

            if(file_exists($file_name))
            {
                unlink($file_name);
            }
            return "success!";
        }

        return "fail";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = $this->brandService->All();
        $categories = $this->productCategoryService->All();
        return view('admin.Product.create',compact('brands','categories'));
    }

    public function createDetails($productId)
    {
        $parentProduct = $this->productService->Find($productId);
        return view('admin.Product.details.create',compact('parentProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['qty'] = 0;
        try {
            $this->createForm->validate("data");
        }
        catch (FormValidationException $exception)
        {
            return back()->withInput()->withErrors($exception->getErrors());
        }
        $newProduct = $this->productService->Create($data);
        return redirect(route('ProductDetails',$newProduct->id))->with('notification','New product has created successful!') ;
    }

    public function storeDetails(Request $request,$productId)
    {
        $data = $request->validate([
            'color' =>  'required',
            'size'  =>  'required',
            'qty'   =>  'required|numeric'
        ]);
        $data['product_id'] = $productId;
        $this->productDetailsService->Create($data);
        return redirect(route('ProductDetailsManager',$productId))
                ->with('notification','New Product details has created successful!');
    }

    public function imagesStore(Request $request,$productId)
    {
        return  "$this->store()";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->Find($id);

        return view('admin.product.show',compact('product'));
    }

    public function showDetails($id)
    {
        $parentProduct = $this->productService->Find($id) ;
        $productDetails = $parentProduct->productDetails;
        return view('admin.Product.details.index',compact('parentProduct','productDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "edit worked!";
    }

    public function editDetails($id)
    {
        $productDetail = $this->productDetailsService->Find($id);

        $product = $productDetail->product;
        return view('admin.product.details.edit',compact('product','productDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return "update worked!";
    }
    public function updateDetails(Request $request,$id)
    {
        $data = $request->validate([
            'color' =>  'required',
            'size'  =>  'required',
            'qty'   =>  'required|numeric'
        ]);
        $parentProduct = $this->productDetailsService->Find($id)->product;
        $this->productDetailsService->Update($data,$id);

        return redirect(route('ProductDetailsManager',$parentProduct->id))
            ->with('notification','Product Details has updated successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // product_details table
        $product = $this->productService->Find($id);
        foreach($product->productDetails as $productDetail)
        {
            $productDetail->delete();
        }

        // product_images table
        foreach ($product->productImages as $productImage)
        {
            $imageFile ="front/img/products/".$productImage->path;
            if(file_exists($imageFile)){
                unlink($imageFile);
            }
            $productImage->delete();
        }

        //product table
        $product->delete();
    }

    public function destroyDetails($id)
    {
        $parentProduct = $this->productDetailsService->Find($id)->product;
        $this->productDetailsService->Delete($id);

        return redirect(route('ProductDetailsManager',$parentProduct->id))
            ->with('notification','Product Details has removed successful!');
    }
}
