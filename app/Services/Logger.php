<?php

namespace App\Services;

use App\Access;
use App\Log;
use App\Role_User;
use App\Wallet;
use Illuminate\Support\Facades\DB;


class Logger
{
    public  static function save($action,$user){
        DB::beginTransaction();
        try {
           $log = new Log();
           $log->description = $action;
           $log->user = $user;
           $log->save();
           DB::commit();
        }catch (\Exception $exception){

        }
    }

}
