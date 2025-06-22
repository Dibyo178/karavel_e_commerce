<?php

namespace App\Helper;

use App\Models\Invoice;
// use App\Models\SslcommerzAccount;
use App\Models\SslcommerzeAccount;
use Exception;
use Illuminate\Support\Facades\Http;

class SSLCommerz
{

    static function InitiatePayment($Profile,$payable,$tran_id,$user_email)
    {
        try {
            $ssl=SslcommerzeAccount::first();
            $response=Http::asForm()->post( $ssl->init_url, [
                "store_id"=>$ssl->store_id,
                "store_passwd"=>$ssl->store_passwd,
                'total_amount'=>$payable,
                'currency'=>$ssl->currancy,
                'tran_id'=>$tran_id,
                'success_url'=>"$ssl->success_url?tran_id=$tran_id",
                'fail_url'=>"$ssl->fail_url?tran_id=$tran_id",
                'cancel_url'=>"$ssl->cancel_url?tran_id=$tran_id",
                'ipn_url'=>$ssl->ipn_url,
                'cus_name'=>$Profile->cus_name,
                'cus_email'=>$user_email,
                'cus_add1'=>$Profile->cus_add,
                'cus_add2'=>$Profile->cus_add,
                'cus_city'=>$Profile->cus_city,
                'cus_state'=>$Profile->cus_city,
                'cus_postcode'=>'3100',
                'cus_country'=>$Profile->cus_country,
                'cus_phone'=>$Profile->cus_phone,
                'cus_fax'=>$Profile->cus_phone,
                'shipping_method'=>'YES',
                'ship_name'=>$Profile->ship_name,
                'ship_add1'=>$Profile->ship_add,
                "ship_add2"=>$Profile->ship_add,
                "ship_city"=>$Profile->ship_city,
                "ship_state"=>$Profile->ship_city,
                "ship_country"=>$Profile->ship_country,
                "ship_postcode"=>"3100",
                "product_name"=>"Apple Shop Product",
                "product_category"=>"Apple Shop Category",
                "product_profile"=>"Apple Shop Profile",
                "product_amount"=>$payable
            ]);
            return $response->json('desc');

        }
        catch (Exception $e){
            return $e->getMessage();
        }

    }


    static function InitiateFail($tran_id)
    {
        try {
            Invoice::where(['tran_id'=>$tran_id,'val_id'=>0])->update(['payment_status'=>'fail']);
            return 1;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    static function InitiateSuccess($tran_id)
    {
        try {
            Invoice::where(['tran_id'=>$tran_id,'val_id'=>0])->update(['payment_status'=>'success']);
            return 1;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    static function InitiateCancel($tran_id)
    {
        try {
            Invoice::where(['tran_id'=>$tran_id,'val_id'=>0])->update(['payment_status'=>'cancel']);
            return 1;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
    static function InitiateIPN($tran_id,$status,$val_id){
        try {
            Invoice::where(['tran_id'=>$tran_id,'val_id'=>0])->update(['payment_status'=>$status,'val_id'=>$val_id]);
            return 1;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }



}
