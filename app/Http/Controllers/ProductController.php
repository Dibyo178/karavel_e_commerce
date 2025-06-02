<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Product;

use App\Models\ProductDetails;
use App\Models\ProductReview;
use App\Models\ProductSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function ListProductByCategory(Request $request)
    {

        $id = $request->id;
        // return  Cache::remember('ListProductByCategory' . $id, 3600, function () use ($id) {

        //     return Product::where('category_id', $id)->with('brand', 'category')->get();
        // });

         $data = Product::where('category_id', $id)->with('brand', 'category')->get();

        return ResponseHelper::Out('success',$data,200);
    }


    public function ListProductByRemark(Request $request)
    {

        $remark = $request->remark;
        // return  Cache::remember('ListProductByRemark' . $remark, 3600, function () use ($remark) {

        //     return Product::where('remark', $remark)->with('brand', 'category')->get();
        // });

         $data = Product::where('remark', $remark)->with('brand', 'category')->get();

         return ResponseHelper::Out('success',$data,200);

    }

    public function ListProductByBrand(Request $request)
    {

        $id = $request->id;
        // return  Cache::remember('ListProductByBrand' . $id, 3600, function () use ($id) {

        //     return Product::where('brand_id', $id)->with('brand', 'category')->get();
        // });

        $data = Product::where('brand_id', $id)->with('brand', 'category')->get();

        return ResponseHelper::Out('success',$data,200);
    }

    public function ListProductBySlider(Request $request)
    {

        // return Cache::remember('ListProductBySlider', 3600, function () {

        //     return ProductSlider::all();
        // });
        $data = ProductSlider::all();
         return ResponseHelper::Out('success',$data,200);
    }


    public function ProductDetailsById(Request $request)
    {

         $product_id = $request->id;

        // return  Cache::remember('ProductDetailsById' . $id, 3600, function () use ($id) {

        //     return ProductDetails::where('product_id', $id)->with('product','product.brand','product.category')->get();
        // });

         $data = ProductDetails::where('product_id', $product_id)->with('product','product.brand','product.category')->get();

         return ResponseHelper::Out('success',$data,200);
    }

         public function ListReviewByProduct(Request $request)
    {

         $product_id = $request->product_id;

         $data =ProductReview::where('product_id', $product_id)->with(['profile'=>function($query){
            $query->select('id','cus_name');
         }])->get();

         return ResponseHelper::Out('success',$data,200);
    }

}
