<?php

namespace App\Http\Controllers;

use App\Models\CustomerProfile;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

     function IncoiceCreate(Request $request){

         DB::beginTransaction();

         try{

         $user_id = $request->header('id');
         $user_email = $request->header('email');

         $tran_id=uniqid();
         $delivery_status='Pending';
         $payment_status='Pending';

         $Profile = CustomerProfile::where('user_id','=',$user_id)->first();

         $cus_details = "Name:$Profile->cus_name,Address:$Profile->cus_add,City:$Profile->cus_city,Phone:$Profile->cus_phone";

         $ship_details = "Name:$Profile->ship_name,Address:$Profile->ship_add,City:$Profile->ship_city,Phone:$Profile->cus_phone";

        //  payable calculation

        $total = 0;

        $cartlist = ProductCart::where('user_id',operator: '=',$user_id)->get();

         foreach($cartlist as $cartItem){

            $total= $total*$cartItem->price;

         }

         }
     }

}
