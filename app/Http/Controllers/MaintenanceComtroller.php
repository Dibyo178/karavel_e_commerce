<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MaintenanceComtroller extends Controller
{
     function ClearAppCache(){

          Artisan::call('casche:clear');
          return 1;

     }
}
