<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use App\Models\Product;

use App\Models\ProductDetails;
use App\Models\ProductReview;
use App\Models\ProductSlider;
use App\Models\ProductWish;
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

        return ResponseHelper::Out('success', $data, 200);
    }


    public function ListProductByRemark(Request $request)
    {

        $remark = $request->remark;
        // return  Cache::remember('ListProductByRemark' . $remark, 3600, function () use ($remark) {

        //     return Product::where('remark', $remark)->with('brand', 'category')->get();
        // });

        $data = Product::where('remark', $remark)->with('brand', 'category')->get();

        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListProductByBrand(Request $request)
    {

        $id = $request->id;
        // return  Cache::remember('ListProductByBrand' . $id, 3600, function () use ($id) {

        //     return Product::where('brand_id', $id)->with('brand', 'category')->get();
        // });

        $data = Product::where('brand_id', $id)->with('brand', 'category')->get();

        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListProductBySlider(Request $request)
    {

        // return Cache::remember('ListProductBySlider', 3600, function () {

        //     return ProductSlider::all();
        // });
        $data = ProductSlider::all();
        return ResponseHelper::Out('success', $data, 200);
    }


    public function ProductDetailsById(Request $request)
    {

        $product_id = $request->id;

        // return  Cache::remember('ProductDetailsById' . $id, 3600, function () use ($id) {

        //     return ProductDetails::where('product_id', $id)->with('product','product.brand','product.category')->get();
        // });

        $data = ProductDetails::where('product_id', $product_id)->with('product', 'product.brand', 'product.category')->get();

        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListReviewByProduct(Request $request)
    {

        $product_id = $request->product_id;

        $data = ProductReview::where('product_id', $product_id)->with(['profile' => function ($query) {
            $query->select('id', 'cus_name');
        }])->get();

        return ResponseHelper::Out('success', $data, 200);
    }





    public function CreateProductReview(request $request)
    {

        $user_id = $request->header('id');

        $profile = CustomerProfile::where('user_id', $user_id)->first();

        if ($profile) {

            $request->merge(['customer_id' => $profile->id]);

            $data = ProductReview::updateOrCreate(

                ['customer_id' => $profile->id, 'product_id' => $request->input('product_id')],
                $request->input()
            );

            return ResponseHelper::Out('success', $data, 200);
        } else {

            return ResponseHelper::Out('fail', 'customer profile not exists', 200);
        }
    }

    //  wishlist

  public function ProductWishList(Request $request)
    {
        $user_id = $request->header('id');
        $data = ProductWish::where('user_id',$user_id)->with('product')->get();
        return ResponseHelper::Out('success', $data, 200);
    }




    public function CreateWishList(Request $request)
    {
        $user_id = $request->header('id');
        $data = ProductWish::updateOrCreate(

            ['user_id' => $user_id, 'product_id' => $request->product_id],
            ['user_id' => $user_id, 'product_id' => $request->product_id],
        );

        return ResponseHelper::Out('success', $data, 200);
    }


      public function RemoveWishList(Request $request)
    {
        $user_id = $request->header('id');
        $data = ProductWish::where(['user_id'=>$user_id,'product_id'=>$request->product_id])->delete();
        return ResponseHelper::Out('success', $data, 200);
    }


}
