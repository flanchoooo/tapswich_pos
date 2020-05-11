<?php

namespace App\Services;

use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;


class uniqueIdGenerator
{

    public  static function genRandomNumber($length = 10, $formatted = false){
        $nums = '0123456789';

        // First number shouldn't be zero
        $out = $nums[ mt_rand(1, strlen($nums) - 1) ];

        // Add random numbers to your string
        for ($p = 0; $p < $length - 1; $p++)
            $out .= $nums[ mt_rand(0, strlen($nums) - 1) ];

        // Format the output with commas if needed, otherwise plain output
        if ($formatted)
            return number_format($out);

        return $out;
    }


}
