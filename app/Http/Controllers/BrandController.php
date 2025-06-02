<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    public function BrandList(){

    //    return Cache::remember('BrandList',3600,function(){

    //          return Brand::all();
    //     });

    $data= Brand::all();

    return ResponseHelper::Out('success',$data,200);
    }

}
