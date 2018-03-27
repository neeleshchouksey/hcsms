<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SimpleMessageRequest;
use Helper;
use App\Patient;
class SendSimpleMessageContoller extends Controller
{
    //
    public function index(SimpleMessageRequest $request){

    	$patient 	=	Patient::find($request->patient_id);
    	Helper::sendSimpleSmsMessage($request->message,$request->sendto,$patient);

    }
}
