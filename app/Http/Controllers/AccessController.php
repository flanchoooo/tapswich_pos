<?php

namespace App\Http\Controllers;

use App\Access;
use App\Permissions;
use App\Role;
use App\Services\AccessControlService;
use App\Services\Logger;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller{
    public function display(){
        $result = AccessControlService::user(Auth::user()->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }
        $results = Access::all();
        return view('access.display')->with('records', $results);
    }

    public  function view(){
        $result = AccessControlService::user(Auth::user()->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        $results = Permissions::all();
        return view('access.create')->with('records', $results);
    }

    public function creates(Request $request){
        $user =  Auth::user();
        $usderType = Permissions::find($request->user_type_id)->user_type_name;
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        try {
            Access::create([
                'user_type_id'       => $request->user_type_id,
                'system_owner'       => $request->system_owner,
                'dealer'             => $request->dealer,
                'authorization'      => $request->hr_access,
                'employee'           => $request->employee,
            ]);
            Logger::save("Created $usderType access profile profile.",$user->name);
            return redirect('/access/display');
        }catch (QueryException $queryException){
            session()->flash('error','Please contact system administrator for assistance');
            return redirect()->back();
        }

    }

    public function edit (Request $request){
        $result = AccessControlService::user(Auth::user()->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        $records = Access::whereId($request->id)->first();
        return view('access.update')->with(['records' => $records]);
    }

    public function update(Request $request){
        $user =  Auth::user();
        $usderType = Permissions::find($request->user_type_id)->user_type_name;
        $result = AccessControlService::user($user->user_type_id, 'system_owner');
        if($result["code"] != '00'){
            if($result["code"] == '02'){
                return view('page_errors.inactive');
            }
            return view('page_errors.permissions');
        }

        Access::where('user_type_id', $request->user_type_id)->update([
            'system_owner'       => $request->system_owner,
            'dealer'             => $request->dealer,
            'authorization'      => $request->authorization,
            'employee'           => $request->employee,
        ]);

        Logger::save("Updated $usderType access profile profile.",$user->name);
        return redirect('/access/display');
    }

}

