<?php

namespace App\Services;

use App\Access;
use App\Role_User;
use App\Wallet;
use Illuminate\Support\Facades\DB;


class PushPaymentService
{
    public  static function transact($source,$amount){

        DB::beginTransaction();
        try {
            $source_account        = Wallet::whereMobile($source)->lockForUpdate()->first();
            if($source_account->state != 1 ){
                return array(
                    'code'            => '01',
                    'description'     => 'Account is blocked, contact support for assistance'
                );
            }
            $source_account->balance -= $amount;
            $source_account->amount_due += $amount;
            $source_account->save();
            DB::commit();
            return array(
                'code'            => '00',
                'description'     => 'Transaction successfully processed'
            );

        }catch (\Exception $exception){
            DB::rollBack();
            return array(
                'code'            => '01',
                'description'     => $exception->getMessage()
            );
        }


    }

}
