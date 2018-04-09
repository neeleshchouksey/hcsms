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
        $query = request()->query();
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

        $j          =   0;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://rest.clicksend.com/v3/countries");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        $pageCount  = $query['draw']*$query['length'];
        $prepageCount  = ($query['draw']-1)*$query['length'];
        foreach ($response->data as $country) {
            # code...
            if($query['draw']==1){
            if($i!=0 && $i<=$prepageCount || $i>=$pageCount){
                $i++;
                $j=0;
                // echo "$i";
                // echo "<br>";
                continue;
            }}
            else{
                if($i<=$prepageCount || $i>=$pageCount){
                $i++;
                $j=0;
                // echo "$i";
                // echo "<br>";
                continue;
            }
            }
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
                $smscost   = '$ '.$smscost;
                $smsFees   = '$ '.$smsFees; 
            else:
                $smscost   =     'Not available';
                $smsFees   =    'Not available';
            endif;
            $records[$j]['country']     =   $country->value;
            $records[$j]['smscost']     =   $smscost;
            $records[$j]['smsfee']      =   $smsFees;
            $i++;
            $j++;
        }
         /**
         * Return json response of customer records
         */
         $totalData     = count($response->data);
        $json_data = array(
            "draw"            => intval( $query['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalData ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $records   // total data array
            );

        return \Response::json($json_data);


    }

}
