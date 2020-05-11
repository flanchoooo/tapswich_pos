<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
    {

        session_start();
        try {
            $client = new Client();
            $result = $client->post('http://144.91.64.119:9000/useroperations/login', [
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'username'    => $request->email,
                    'password'    => $request->password,
                ],
            ]);
            $records = $result->getBody()->getContents();
            $results = json_decode($records);
            $_SESSION["token"] = 'bearer '.$results->access_token;
            $_SESSION["username"] =$request->email;
           if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
          $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }catch (\Exception $exception){
            if($exception->getCode() == 500){
                session()->flash('login', 'Invalid login credentials');
                return redirect()->back();
            }
            session()->flash('login', 'Failed to process request please try again later.');
            return redirect()->back();
        }
    }
}
