<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SslcommerzeAccount extends Model
{

   
     protected $fillable = [
        'store_id',
        'store_passwd',
        'init_url',
        'success_url',
        'fail_url',
        'cancel_url',
        'ipn_url',
        'currancy'
    ];


}
