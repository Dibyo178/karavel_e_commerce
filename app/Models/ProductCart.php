<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    protected $fillable = ['user_id','product_id','color','size','qty','price'];
}
