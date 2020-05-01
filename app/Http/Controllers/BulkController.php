<?php

namespace App\Http\Controllers;

use App\Bulk;
use App\Companies;
use App\Order;
use App\Permissions;
use App\Services\AccessControlService;
use App\Services\BillPaymentService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BulkController extends Controller
{
    public function  display(){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        $records = Bulk::whereCompanyId($user->company_id)
                        ->whereNotIn('bulk_status', ['APPROVED','DECLINED'])
                        ->get();
        return view('bulk.display')->with('records', $records);

    }


    public function  upload_view(){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        return view('bulk.view');
    }


    public function  upload(Request $request){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        set_time_limit(1000000);
        $number_of_rows = count(file($request->csvfile));
        if ($number_of_rows > 100) {
            session()->flash('upload_error', 'CSV File is too big, number of rows should not exceed 100');
            return redirect('/bulk/display');
        }


        $read = fopen($request->csvfile, "r");
        while (($fileopen = fgetcsv($read, 1000, ",")) !== false) {
            $empty_filesop = array_filter( array_map('trim', $fileopen));
            if(!empty( $empty_filesop )) {

                if (isset($fileopen[0])) {
                    $mobile = $fileopen[0];
                }

                if (isset($fileopen[1])) {
                    $amount = $fileopen[1];
                }

                if (isset($fileopen[2])) {
                    $bulk_reference = $fileopen[2];
                }

                $isValid = User::whereMobile($mobile)->first();
                if (!isset($isValid)) {
                    Bulk::create([
                        'company_id'        => $user->company_id,
                        'initiated_by'      => $user->id,
                        'mobile'            => $mobile,
                        'amount'            => $amount,
                        'bulk_reference'    => $bulk_reference,
                        'bulk_status'       => 'FAILED',
                        'narration'         => 'Mobile account is not registered'
                    ]);

                    continue;

                }

                if($isValid->company_id != $user->company_id){
                    Bulk::create([
                        'company_id'        => $user->company_id,
                        'initiated_by'      => $user->id,
                        'mobile'            => $mobile,
                        'amount'            => $amount,
                        'bulk_reference'    => $bulk_reference,
                        'bulk_status'       => 'FAILED',
                        'narration'         => 'This company account cannot disburse into this mobile.'
                    ]);

                    continue;

                }

                $duplicateCheck = Bulk::whereMobile($mobile)
                                    ->whereBulkStatus('PENDING APPROVAL')
                                    ->count();

                if($duplicateCheck > 0){
                    Bulk::create([
                        'company_id'        => $user->company_id,
                        'initiated_by'      => $user->id,
                        'mobile'            => $mobile,
                        'amount'            => $amount,
                        'bulk_reference'    => $bulk_reference,
                        'bulk_status'       => 'FAILED',
                        'narration'         => "Duplicate upload for mobile:$mobile"
                    ]);

                    continue;

                }

                Bulk::create([
                    'company_id'        => $user->company_id,
                    'initiated_by'      => $user->id,
                    'mobile'            => $mobile,
                    'amount'            => $amount,
                    'bulk_reference'    => $bulk_reference,
                    'bulk_status'       => 'PENDING APPROVAL',
                    'narration'         => "Transaction is pending approval"
                ]);
            }

        }

        return redirect('/bulk/display');
    }

    public function reports(){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        return view('bulk.reports');
    }

    public function search(Request $request){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        $records = Bulk::whereCompanyId($user->company_id)
            ->whereBetween('created_at',array($request->start_date, $request->end_date))
            ->get();
        return view('bulk.displays')->with('records',$records);
    }

    public function  decline(Request $request){

        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        $declineRecord = Bulk::find($request->id);
        $declineRecord->bulk_status = "DECLINED";
        $declineRecord->authorized_by = $user->id;
        $declineRecord->save();
        return redirect('/bulk/display');
    }

    public function  authorize_transaction(Request $request){

        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }


        $authRecord = Bulk::find($request->id);
        $source_account = Companies::whereId($authRecord->company_id)->first();
        if(!isset($source_account)){
            session()->flash('upload_error', 'Invalid company account, contact system administrator for assistance');
            return redirect('/bulk/display');
        }

        $balance = User::whereMobile($source_account->external_reference)->first();
        if(!isset($balance)){
            session()->flash('upload_error', 'Company account is not registered, please contact system administrator for assistance');
            return redirect('/bulk/display');
        }

        if($balance->balance < $authRecord->amount){
            session()->flash('upload_error', "Insufficient funds, your available balance is: $balance->balance ");
            return redirect('/bulk/display');
        }

        $disbursement_instruction = BillPaymentService::transact($source_account->external_reference,$authRecord->mobile,$authRecord->amount);
        if($disbursement_instruction["code"] != '00'){
            session()->flash('upload_error',$disbursement_instruction["description"]);
            return redirect('/bulk/display');
        }

        $authRecord->bulk_status = "APPROVED";
        $authRecord->authorized_by = $user->id;
        $authRecord->narration = "Transaction successfully processed.";
        $authRecord->save();
        return redirect('/bulk/display');
    }

    public function employee(){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        $transactions =  DB::select(DB::raw("SELECT account, sum(transaction_value) as total
                                    FROM transactions where owings is null and  company_id = $user->company_id and
                                    narration='CREDIT' GROUP BY account;"));

        return view('bulk.employee')->with('records',$transactions);

    }

    public function settle(Request $request){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        Order::whereAccount($request->account)
        ->whereNull('owings')->update([
           'owings' => 'SETTLED',

       ]);

        return redirect()->back();

    }
}
