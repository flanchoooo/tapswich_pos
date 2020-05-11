<?php

namespace App\Services;

use App\Access;
use App\Role_User;


class AccessControlService
{

    public  static function user($user_id,$actions){

        $results =  Access::whereUserTypeId($user_id)->first();
        $role_user = $results["$actions"];

        if($results->permissions_status != 1){
            return array(
                'code' => '02'
            );
        }

        if( $role_user != 'on'){
            return array(
                'code' => '01'
            );
        }

        return array(
            'code' => '00'
        );

    }


}
