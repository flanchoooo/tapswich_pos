<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class AcquiredTransactionsController extends Controller
{

    public function view(){
        return view('acquired.view');
    }

    public  function display(Request $request){
        try {
            $client = new Client();
            $result = $client->post('http://144.91.64.119:9000/tapswitch/acquirer/period', [
                'headers' => ['Content-type' => 'application/json',],
                'json' => [
                    'username'    => "CBZ",
                    'fromDate'    => $request->start_date,
                    'toDate'      => $request->end_date,
                    'page'        => "1",
                    'size'        => "10",
                ],
            ]);

            $records = $result->getBody()->getContents();
            $nullResponse = json_decode($records);
             if($nullResponse->numberOfElements == 0){
                session()->flash('acq_message', 'No search result');
                return redirect()->back();
             }


           return view('acquired.display')->with('records',$nullResponse->content);
        }catch (\Exception $exception){
            return $exception;
            session()->flash('acq_message', 'Failed to process request please contact system administrator.');
            return redirect()->back();
        }


}

















}
