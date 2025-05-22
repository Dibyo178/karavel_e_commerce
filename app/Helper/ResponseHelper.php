<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;


 class ResponseHelper{

    public static function Out($msg,$data,$code){
        return response()->json(['msg'=>$msg,'data'=>$data],$code);
    }

 }


 ?>
