<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $fillable=[

     'cus_name',
     'cus_add',
     'cus_city',
     'cus_state',
     'cus_postcode',
     'cus_country',
     'cus_phone',
     'cus_fax',
     'ship_name',
     'ship_city',
     'ship_state',
     'ship_postcode',
     'ship_country',
     'ship_phone',
     'ship_add',
     'user_id',

   ];

   public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


}
