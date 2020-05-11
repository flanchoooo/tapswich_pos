<?php

namespace App\Http\Controllers;

use App\CompanyUsers;
use App\Employee;
use App\Mail\SendMailable;
use App\Permissions;
use App\Services\AccessControlService;
use App\Services\Logger;
use App\Wallet;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmployeesController extends Controller
{



    public function display(Request $request){
        $result = AccessControlService::user(Auth::user()->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }
        $employee = Employee::where('company_id',$request->id)->get();
        return view('employees.display')->with('records',$employee);

    }


    public function view(Request $request){
        $result = AccessControlService::user(Auth::user()->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        $rec = Permissions::all();
        $records = Employee::where('id',$request->id)->first();
        return view('employees.update')->with(['records' => $records])
                                        ->with('rec', $rec);
    }

    public function creates_(Request $request){
        $result = AccessControlService::user(Auth::user()->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        session()->flash('company_id', $request->id);
        $rec = Permissions::all();
        return view('employees.create')->with('records', $rec);
    }

    public function creates(Request $request){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

         $password = Str::random(32);
         $mobile_pin = rand(0000,9999);
         $name = $request->first_name.' '. $request->last_name;


       $data =[
           'name'       => $name,
           'password'   => $password,
           'pin'        => $mobile_pin,
           'email'      => $request->email
       ];


        DB::beginTransaction();
        try {

            $employee_registration              = new Employee();
            $employee_registration->email       = $request->email;
            $employee_registration->name        = $name;
            $employee_registration->mobile      = $request->telephone;
            $employee_registration->company_id  = $request->company_id;
            $employee_registration->user_type_id  = $request->user_type_id;
            $employee_registration->status      = 'IN-ACTIVE';
            $employee_registration->mobile_auth =  Hash::make($mobile_pin);
            $employee_registration->password    =  Hash::make($password);
            $employee_registration->save();

            $companyUsers        = new CompanyUsers();
            $companyUsers->company_id =  $request->company_id;
            $companyUsers->user_id    =  $request->user_type_id;
            $companyUsers->save();
            DB::commit();


            session()->flash('reg_notification', 'Employee successfully created');
            Logger::save("Created $request->first_name.' '. $request->last_name user profile.",$user->name);
            Mail::send('email.create', $data, function($message) use ($name, $request) {
                $message->to($request->email,$name)->subject('Vina Registration');
                $message->from('vinalabs@gmail.com','Vina Services Application');
            });
            return redirect('/companies/display');

        }catch (QueryException $queryException){
           // $response = $queryException->getMessage();
            session()->flash('reg_notification_error','Please provide unique credentials for new employee.');
            return redirect('/companies/display');
        }

    }



    public function update(Request $request){
        $user =  Auth::user();
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        try {

            Employee::whereId($request->id)->update([
                'name'      => $request->first_name,
                'mobile'    => $request->telephone,
                'email'     => $request->email,
                'user_type_id' => $request->user_type_id,
                'status'    => $request->status,
            ]);

            Logger::save("Updated $request->first_name user profile. Mobile:$request->telephone, Status:$request->status",$user->name);
            return redirect('/companies/display');

        }catch (QueryException $queryException){
            $response = $queryException->getMessage();
            session()->flash('notification',$response);
            return redirect('/companies/display');

        }

    }

    public function register_employee($telephone,$first_name,$last_name,$pin){


        DB::beginTransaction();
        try {

            $wallet                     = new Wallet();
            $wallet->mobile             = $telephone;
            $wallet->account_number     = $telephone;
            $wallet->first_name         = $first_name;
            $wallet->last_name          = $last_name;
            $wallet->gender             = 'W';
            $wallet->dob                = '00-00-00';
            $wallet->national_id        = '0000000000A1';
            $wallet->state              = 1;
            $wallet->wallet_cos_id      = 1;
            $wallet->auth_attempts      = 0;
            $wallet->pin                = Hash::make($pin);
            $wallet->save();

            DB::commit();
            return array(
                'code'              => '00',
                'description'       => 'User successfully registered.'
            );

        }catch (\Exception $exception){
            DB::rollback();
            return array(
                'code'              => '01',
                'description'       => 'Failed to register please contact system administrator'
            );
        }

    }

}
