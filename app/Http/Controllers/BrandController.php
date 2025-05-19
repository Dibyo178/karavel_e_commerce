<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    public function BrandList(){

       return Cache::remember('BrandList',3600,function(){

             return Brand::all();
        });
    }

}
