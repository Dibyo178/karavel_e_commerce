<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
     $token = $request->cookie('token');
     $result = JWTToken::ReadToken($token);

     if($result == "unauthorized"){

         return redirect("/UserLogin");
     }
     else {

        $request->headers->set("email",$request->UserEmail);
        $request->headers->set("id",$request->UserId);
         return $next($request);

     }

    }
}
