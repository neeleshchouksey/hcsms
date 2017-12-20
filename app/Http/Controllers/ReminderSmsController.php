<?php

namespace App\Http\Controllers;

use App\ReminderSms;
use App\PatientService;
use Illuminate\Http\Request;
use Helper;

class ReminderSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        echo $id;
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
         $patientService     =   PatientService::find($request->patient_service_id);

       \Helper::sendSmsMessage($patientService,'test');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReminderSms  $reminderSms
     * @return \Illuminate\Http\Response
     */
    public function show(ReminderSms $reminderSms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReminderSms  $reminderSms
     * @return \Illuminate\Http\Response
     */
    public function edit(ReminderSms $reminderSms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReminderSms  $reminderSms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReminderSms $reminderSms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReminderSms  $reminderSms
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReminderSms $reminderSms)
    {
        //
    }
    public function ajaxLoad($id){
        //echo $id;
        $ReceiveSms        =      \App\ReceiveSms::select('created_at','to','from','body','original_message_id as message_id')->whereHas('remindMessage',function($q) use($id){
                                        $q->whereHas('parentService',
                                            function($q1) use($id){
                                                $q1->whereHas('patient',
                                                    function($q2) use($id){
                                                        $q2->where('id',$id);
                                                    });
                                            });

                                        }
                                    )->with('remiderMessage.parentService.serviceData');
        $reminderSms        =       ReminderSms::select('created_at','to','from','body','message_id')->whereHas('parentService',
                                        function($q1) use($id){
                                            $q1->whereHas('patient',
                                                function($q2) use($id){
                                                    $q2->where('id',$id);
                                                });

                                        }
                                    )->with('parentService.serviceData')
                                    ->union($ReceiveSms)
                                    ->orderBy('created_at', 'DESC')->get();
       /* echo "<pre>";
        print_r($reminderSms);die;*/

        $records            =       array();

        $i = 0;

        foreach ($reminderSms as $sms) {
            
            // $records[$i]['day']         =       date('Y-m-d',strtotime($sms->sms_time));
            // $records[$i]['time']        =       date('H:i:s',strtotime($sms->sms_time));
            $records[$i]['day']         =       $sms->created_at->format('H:i d/m/Y').' '. $sms->created_at->format('D');;
                 
            $records[$i]['to']          =       $sms->to;
            $records[$i]['from']        =       $sms->from;
            $records[$i]['message']     =       $sms->body;
            $records[$i]['service']     =       $sms->message_id;//$sms->parentService->serviceData->name;
            $i++;
        }
        return \Response::json(compact('records','columns'));
    }
}
