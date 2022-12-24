<?php

namespace App\Repositories\ProductCategoryRepository;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface
{

    public function getModel()
    {
        return ProductCategory::class;
    }

//    public function getRelatedProducts($product,int $limit = 4)
//    {
//        return $this->model->where('product_category_id',$product->product_category_id)
//            ->where('tag',$product->tag)
//            ->limit($limit)->get();
//    }
//
//    public function getFeaturedProductByCategory(int $categoryId)
//    {
//        return $this->model->where('featured',true)
//                            ->where('product_category_id',$categoryId)
//                            ->get();
//    }
//
//    public  function getProductOnIndex(Request $request)
//    {
//        $prePage = $request->show ?? 3;
//        $sortBy = $request->sort_by ?? 'latest';
//        $search = $request->search ?? '';
//
//        $products = $this->model->where('name','like','%'.$search.'%');
//
//        switch ($sortBy)
//        {
//            case 'latest':
//                $products = $products->orderBy('id');
//                break;
//            case 'oldest':
//                $products = $products->orderByDesc('id');
//                break;
//            case 'name-ascending':
//                $products = $products->orderBy('name');
//                break;
//            case 'name-descending':
//                $products = $products->orderByDesc('name');
//                break;
//            case 'price-ascending':
//                $products = $products->orderBy('price');
//                break;
//            case 'price-descending':
//                $products = $products->orderByDesc('price');
//                break;
//            Default:
//                $products = $products->orderBy('id');
//        }
//        $products = $products->paginate($prePage);
//        $products->appends(['sort_by' => $sortBy,'show' => $prePage]);
//        return $products;
//    }
}
