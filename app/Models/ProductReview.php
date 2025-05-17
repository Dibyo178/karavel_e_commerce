<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{

     public function profile():BelongsTo{

         return $this->belongsTo(CustomrProfile::class,'customer_id');
     }

     protected $fillable = ['descroption','rating','customer_id','product_id'];
}
