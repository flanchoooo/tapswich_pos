<?php

namespace App\Services;

use App\Access;
use App\Order;
use App\Role_User;
use App\User;
use App\Wallet;
use Illuminate\Support\Facades\DB;


class AdjustService
{
    public  static function transact($destination,$amount,$id){
        DB::beginTransaction();
        try {
            $destination_account   = User::whereMobile($destination)->lockForUpdate()->first();
            if($destination_account->status != 'ACTIVE' ){
                return array(
                    'code'            => '01',
                    'description'     => 'Account account is blocked, contact support for assistance'
                );
            }
            $balance = $destination_account->balance;
            $new_balance = $destination_account->balance - $amount;

            if($new_balance < 0 ){
                return array(
                    'code'            => '01',
                    'description'     => 'Invalid transaction amount'
                );
            }

            $destination_account->balance -= $amount;
            $destination_account->save();

            $transaction = new Order();
            $transaction->company_id = $destination_account->company_id;
            $transaction->narration = 'ADJUST';
            $transaction->account =$destination;
            $transaction->transaction_value = $amount;
            $transaction->initiated_by = $id;
            $transaction->authorized_by = $id;
            $transaction->transaction_status = 'COMPLETED';
            $transaction->balance_before = $balance;
            $transaction->balance_after = $new_balance;
            $transaction->save();

            DB::commit();
            return array(
                'code'            => '00',
                'description'     => 'Transaction successfully processed',
                'company_id'      => $destination_account->company_id,
                'balance_before'  => $balance,
                'balance_after'   => $new_balance

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
