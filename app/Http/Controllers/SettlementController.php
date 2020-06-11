<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class SettlementController extends Controller
{

    public function view(){
        return view('settlement.view');
    }

    public  function display(Request $request){
        session_start();
         if(!isset($_SESSION["token"])){
             return redirect('/login');
         }
        try {
            $client = new Client();
            $result = $client->post('http://144.91.64.119:9002/tapswitch/nettsettlement/period/v21', [
                'headers' => [
                    'Authorization' =>$_SESSION["token"],
                    'Content-type' => 'application/json',],
                'json' => [
                    'username'    =>  $_SESSION["username"],
                    'fromDate'    => $request->start_date,
                    'toDate'      => $request->end_date,
                    'page'        => 0,
                    'size'        => 1000000,
                ],
            ]);

            $records = $result->getBody()->getContents();
            $nullResponse = json_decode($records);
             if($nullResponse->numberOfElements == 0){
                session()->flash('acq_message', 'No search result');
                return redirect()->back();
             }
           return view('settlement.display')->with('records',$nullResponse->content);
        }catch (\Exception $exception){
             $message = "Please logout and try again. Error message :".$exception->getMessage();
             session()->flash('acq_message',$message);
             return redirect()->back();
        }


}

















}
