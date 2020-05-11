<?php

namespace App\Services;

use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;


class basicAuthService
{

    public  static function credentials($username,$password){
        if($username != 'admin' || $password != 'admin') {
            $headers = array('WWW-Authenticate' => 'Basic');

          return  $return =  array(
                'code' => '01',
                'description' => 'Unauthorized',

            );

            return response($return , 401, $headers);

        }

        return   $return =  array(
            'code' => '00',
            'description' => 'Authorized',

        );

        return response($return , 200);

    }


}
