<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;


 class ResponseHelper extends Controller{

     public  function BrandList(){

        $data = Brand::all();

        return  ResponseHelper:: Out('success',$data,200);

     }
 }


 ?>
