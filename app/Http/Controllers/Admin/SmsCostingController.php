<?php

namespace App\Http\Controllers\Admin;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SmsCostCharges;
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

        $costPrices     =   SmsCostCharges::all();
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

        foreach ($costPrices as $costprice) {

          
          
            $records[$i]['country']         =       $costprice->country;
            
            $records[$i]['ccode']           =       $costprice->country_code;
           
            $records[$i]['currencyname']    =       $costprice->getCurrency->actCurrency->currency_name;
           
            $records[$i]['currency']        =       $costprice->getCurrency->code;

            if($costprice->cost!=null){

                $records[$i]['smscost']     =       $costprice->cost;
               
                $records[$i]['smsfee']      =       $costprice->cost*2;
            }
            else{
                $records[$i]['smscost']     =      'Not available';               
                $records[$i]['smsfee']      =      'Not available'; 
            }
           
           
            $i++;
        }
        /**
         * Return json response of customer records
         */
        return \Response::json($records);


    }
    public function exportCsv(){
        $csvExporter = new \Laracsv\Export();
        $users = SmsCostCharges::all();

        

        $csvExporter->build($users, ['country', 'cost']);
        $csvExporter->download();
    }

}
