<?php

namespace App\Http\Controllers\Admin;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsCostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
      
        return view('admin.smsCosting.index');
    }

    public function ajaxLoad(){
         /**
         * initialize empty array records
         *
         * @var        array
         */
        $records    =   array();

        /**
         * initialize $i with value zero
         *
         * @var        integer
         */
        $i          =   0;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://rest.clicksend.com/v3/countries");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
         
        foreach ($response->data as $country) {
            # code...
            $ch2 = curl_init();

            curl_setopt($ch2, CURLOPT_URL, "https://rest.clicksend.com/v3/pricing/".$country->code);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch2, CURLOPT_HEADER, FALSE);

            $response2 = curl_exec($ch2);
            curl_close($ch2);
            $response2 = json_decode($response2);
            if(isset($response2->data) && !empty($response2->data)):
                $smscost   = $response2->data->sms->price_rate_0;
                $smsFees   = $smscost*2;  
            else:
                $smscost   =     'Not available';
                $smsFees   =    'Not available';
            endif;
            $records[$i]['country']     =   $country->value;
            $records[$i]['smscost']     =   '$ '.$smscost;
            $records[$i]['smsfee']      =   '$ '.$smsFees;
            $i++;
        }
         /**
         * Return json response of customer records
         */
        return \Response::json($records);

    }

}
