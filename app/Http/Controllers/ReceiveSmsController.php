<?php

namespace App\Http\Controllers;

use App\ReceiveSms;
use App\ReminderSms;
use Helper;
use Illuminate\Http\Request;

class ReceiveSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $originalMessage                    =       ReceiveSms::where('original_message_id','8E1646D9-2DAE-4D79-819E-27F73FD47108')->first();
        echo "<pre>";
        //print_r($originalMessage->remindMessage->parentService);
        $history         =    'average';
        // if($originalMessage->remindMessage->parentService->service_id==1)
        //   $parentService = $originalMessage->remindMessage->parentService;
        // else
        //     $parentService = $originalMessage->remindMessage->parentService->patient->reminderService->where('service_id',1)->first();
       // $parentService = \App\PatientService::find(5);
       // \Helper::sendSmsMessage($parentService,$history);
        //print_r($parentService->reminderMessage()->latest()->first());
       $tar_bg_number          =   $originalMessage->remindMessage->parentService->bg_number;
       $tar_sm_number          =   $originalMessage->remindMessage->parentService->sm_number;
      echo  $bpBigPercentage        =   (($originalMessage->bg_number-$tar_bg_number)/$tar_bg_number)*100;
      echo "<br>";
      echo  $bpSmPercentage        =   (($originalMessage->sm_number-$tar_sm_number)/$tar_sm_number)*100;
        
        $parentService          =$originalMessage->remindMessage->parentService;
        if($bpSmPercentage>$parentService->very_low_alert || $bpBigPercentage>$parentService->very_low_alert){
            echo "very alert high";
        }
        elseif($bpSmPercentage>$parentService->high_alert || $bpBigPercentage>$parentService->high_alert){
            echo "alert high";
        }
        if($bpSmPercentage<(-$parentService->very_high_alert) || $bpBigPercentage<(-$parentService->very_high_alert)){
            echo "very alert low";
        }
        elseif($bpSmPercentage<(-$parentService->low_alert) || $bpBigPercentage<(-$parentService->low_alert)){
            echo "alert low";
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $originalMessage    =       ReminderSms::where('message_id',$request->original_message_id)->first();
        $action            =       trim(strtolower($request->body));
        $service_id         =       1;
        switch ($action) {
            case 'history':
            case 'help':
            case 'average':
            case 'share':
              


                if($originalMessage->parentService->service_id==$service_id)
                    $parentService = $originalMessage->parentService;
                else
                    $parentService = $originalMessage->parentService->patient->reminderService->where('service_id',$service_id)->first();

                
                \Helper::sendSmsMessage($parentService,$action);
                $parentMessage = $parentService->reminderMessage()->latest()->first();
                $receiveSms                         =       new ReceiveSms;
                $receiveSms->sms_time               =       $request->timestamp;
                $receiveSms->to                     =       $request->to;
                $receiveSms->from                   =       $request->from;
                $receiveSms->body                   =       $request->body;
                
                $receiveSms->original_body          =       $request->original_body;
                $receiveSms->original_message_id    =       $parentMessage->message_id;
                $receiveSms->message_id             =       $request->message_id;
                $receiveSms->custom_string          =       $request->custom_string;
                $receiveSms->user_id                =       $request->user_id;
                $receiveSms->save();

            

            break;
            
        default: 

            
            $receiveSms                         =       new ReceiveSms;
            $receiveSms->sms_time               =       $request->timestamp;
            $receiveSms->to                     =       $request->to;
            $receiveSms->from                   =       $request->from;
            $receiveSms->body                   =       $request->body;

            if($originalMessage->parentService->service_id==$service_id):

                $reading     =  $request->body;
                $readingData =  array();
                
                if(strpos($reading, ' ')!='')
                    $readingData = explode(' ', $reading);
                elseif(strpos($reading,'/')!='')
                    $readingData = explode('/', $reading);

                $receiveSms->bg_number          =   $readingData[0];
                $receiveSms->sm_number          =   end($readingData);
                $receiveSms->patient_service_id =   $originalMessage->parentService->id;

            endif;

            $receiveSms->original_body          =       $request->original_body;
            $receiveSms->message_id             =       $request->message_id;
            $receiveSms->original_message_id    =       $request->original_message_id;
            $receiveSms->custom_string          =       $request->custom_string;
            $receiveSms->user_id                =       $request->user_id;
            $receiveSms->save();
            if($originalMessage->parentService->service_id==$service_id):
                $parentService          =$originalMessage->parentService;
                \Helper::sendSmsMessage($originalMessage->parentService,'reading-received',$receiveSms);
                $tar_bg_number          =   $parentService->bg_number;
                $tar_sm_number          =   $parentService->sm_number;
                $bpBigPercentage        =   (($originalMessage->bg_number-$tar_bg_number)/$tar_bg_number)*100;
                
                $bpSmPercentage        =   (($originalMessage->sm_number-$tar_sm_number)/$tar_sm_number)*100;
        
                

                if($bpSmPercentage>$parentService->very_low_alert || $bpBigPercentage>$parentService->very_low_alert){

                    \Helper::sendSmsMessage($originalMessage->parentService,'reading-high',$receiveSms);

                    //echo "very alert high";
                }
                elseif($bpSmPercentage>$parentService->high_alert || $bpBigPercentage>$parentService->high_alert){
                    \Helper::sendSmsMessage($originalMessage->parentService,'reading-very-high',$receiveSms);
                    //echo "alert high";
                }
                if($bpSmPercentage<(-$parentService->very_high_alert) || $bpBigPercentage<(-$parentService->very_high_alert)){
                    \Helper::sendSmsMessage($originalMessage->parentService,'reading-very-low',$receiveSms);
                    //echo "very alert low";
                }
                elseif($bpSmPercentage<(-$parentService->low_alert) || $bpBigPercentage<(-$parentService->low_alert)){
                    \Helper::sendSmsMessage($originalMessage->parentService,'reading-low',$receiveSms);
                    //echo "alert low";
                }
            endif;
            break;
        }
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReceiveSms  $receiveSms
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiveSms $receiveSms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReceiveSms  $receiveSms
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiveSms $receiveSms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReceiveSms  $receiveSms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceiveSms $receiveSms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReceiveSms  $receiveSms
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiveSms $receiveSms)
    {
        //
    }
    public function ajaxLoad(Request $request){

        $id                 =       $request->message_id;

        $replyMessages      =       ReceiveSms::where('original_message_id',$id)->get();

        return \Response::view('partials.ajax.replyMessage',compact('replyMessages'));

    }
    public function replyBpmHistory(Request $request){
        $receiveSms                         =       new ReceiveSms;
        $receiveSms->sms_time               =       $request->timestamp;
        $receiveSms->to                     =       $request->to;
        $receiveSms->from                   =       $request->from;
        $receiveSms->body                   =       $request->body;

        $receiveSms->original_body          =       $request->original_body;
        $receiveSms->original_message_id    =       $request->original_message_id;
        $receiveSms->message_id             =       $request->message_id;
        $receiveSms->custom_string          =       $request->custom_string;
        $receiveSms->user_id                =       $request->user_id;
        $receiveSms->save();
        die;
    }
}
