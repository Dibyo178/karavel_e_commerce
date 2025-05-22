<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PolicyController extends Controller
{
    public function PolicyByType(Request $request)
    {
        $type = $request->type;


        return Cache::remember('PolicyByType'.$type, 3600, function () use ($type) {

            return Policy::where('type', '=', $type)->first();
        });
    }
}
