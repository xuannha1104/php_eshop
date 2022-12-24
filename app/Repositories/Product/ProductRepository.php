<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }

    public function getRelatedProducts($product,int $limit = 4)
    {
        return $this->model->where('product_category_id',$product->product_category_id)
            ->where('tag',$product->tag)
            ->limit($limit)->get();
    }

    public function getFeaturedProductByCategory(int $categoryId)
    {
        return $this->model->where('featured',true)
                            ->where('product_category_id',$categoryId)
                            ->get();
    }

    public  function getProductOnIndex(Request $request)
    {
        $search = $request->search ?? '';

        $products = $this->model->where('name','like','%'.$search.'%');
        $products = $this->filter($products,$request);
        return $this->sortAndPagination($products,$request);
    }

    public  function getProductByCategory(Request $request, string $categoryName)
    {
        $products = ProductCategory::where('name',$categoryName)->first()->products();
        $products = $this->filter($products,$request);
        return $this->sortAndPagination($products,$request);
    }

    private function sortAndPagination($products,Request $request)
    {
        $perPage = $request->show ?? 3;
        $sortBy = $request->sort_by ?? 'latest';

        switch ($sortBy)
        {
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products = $products->orderByDesc('id');
                break;
            case 'name-ascending':
                $products = $products->orderBy('name');
                break;
            case 'name-descending':
                $products = $products->orderByDesc('name');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-descending':
                $products = $products->orderByDesc('price');
                break;
            Default:
                $products = $products->orderBy('id');
        }
        $products = $products->paginate($perPage);
        $products->appends(['sort_by' => $sortBy,'show' => $perPage]);

        return $products;
    }

    private  function filter($products,Request $request)
    {
        // Brands
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        if($brand_ids != null)
        {
            $products=$products->where('brand_id',$brand_ids);
        }

        // Price
        $price_min = Str_replace('$','',$request->price_min);
        $price_max = Str_replace('$','',$request->price_max);
        if($price_min != null && $price_max != null)
        {
            $products = $products->whereBetween('price',[$price_min,$price_max]);
        }

        // Color
        $color = $request->color ?? '';
        if($color != '')
        {
            $products=$products->whereHas('productDetails',function ($query) use ($color) {
                return $query->where('color',$color)->where('qty','>',0);
            });
        }

        // Size
        $size = $request->size ?? '';
        if($size != '')
        {
            $products=$products->whereHas('productDetails',function ($query) use ($size) {
                return $query->where('size',strtoupper($size));
            });
        }

        return $products;
    }
}
