<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{

    public static function CreateToken($UserEmail, $userID)
    {

        $key = env('JWT_KEY');
        $playload = [
            'iss' => 'Laravel-Token',
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24 * 50,
            'UserEmail' => $UserEmail,
            'UserId' => $userID
        ];
        return JWT::encode($playload, $key, 'HS256');
    }

    public static function ReadToken($token)
    {


        try {

            if ($token == null) {

                return 'unauthorized';
            } else {


                $key = env('JWT_KEY');

                return JWT::decode($token, new Key($key, 'HS256'));
            }
        } catch (Exception $e) {

            return 'unauthorized';
        }





        //  public static function VerifyToken(){

        //  }
    }
}
