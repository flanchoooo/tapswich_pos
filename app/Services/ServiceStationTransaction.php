<?php

namespace App\Services;


use App\Fleet;
use App\Order;
use App\User;
use Illuminate\Support\Facades\DB;


class ServiceStationTransaction
{
    public  static function transact($source,$destination,$amount){
        DB::beginTransaction();
        try {

            if($source == $destination){
                return array(
                    'code'            => '01',
                    'description'     => 'Transaction not permitted.'
                );
            }

            $source_account        = User::whereMobile($source)->lockForUpdate()->first();
            $destination_account   = User::whereId($destination)->lockForUpdate()->first();
            $fleet = Fleet::whereUserId($source_account->id)->first();
            if($destination_account->status != 'ACTIVE' ){
                return array(
                    'code'            => '01',
                    'description'     => 'Employee account is blocked, contact support for assistance'
                );
            }

            Fleet::whereUserId($source_account->id)->first();

            $source_account->balance -= $amount;
            $source_account->save();
            $destination_account->balance += $amount;
            $destination_account->save();


            $balance = $destination_account->balance;
            $new_balance = $destination_account->balance - $amount;
            $transaction = new Order();
            $transaction->company_id = $destination_account->company_id;
            $transaction->narration = 'FUEL DISBURSED';
            $transaction->account = $destination;
            $transaction->transaction_value = $amount;
            $transaction->transaction_status = 'COMPLETED';
            $transaction->fleet_id = $fleet->id;
            $transaction->balance_before = $balance;
            $transaction->balance_after = $new_balance;
            $transaction->save();


            $source_balance = $source_account->balance;
            $source_new_balance = $source_account->balance - $amount;
            $transaction = new Order();
            $transaction->company_id = $source_account->company_id;
            $transaction->narration = 'ORDER FULFILLED';
            $transaction->account =$source;
            $transaction->transaction_value = $amount;
            $transaction->fleet_id = $fleet->id;
            $transaction->transaction_status = 'COMPLETED';
            $transaction->balance_before = $source_balance;
            $transaction->balance_after = $source_new_balance;
            $transaction->save();


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
