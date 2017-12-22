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
        $originalMessage                    =       ReceiveSms::where('original_message_id','8FE46E1D-A2C1-4D36-9F01-33068B0522D2')->first();
        echo "<pre>";
        print_r($originalMessage->remindMessage->parentService);
        if($originalMessage->remindMessage->parentService->service_id==1)
           \Helper::sendSmsMessage($originalMessage->remindMessage->parentService,'reading-received',$originalMessage);

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
        $receiveSms                         =       new ReceiveSms;
        $receiveSms->sms_time               =       $request->timestamp;
        $receiveSms->to                     =       $request->to;
        $receiveSms->from                   =       $request->from;
        $receiveSms->body                   =       $request->body;
        $receiveSms->original_body          =       $request->original_body;
        $receiveSms->original_message_id    =       $request->original_message_id;
        $receiveSms->custom_string          =       $request->custom_string;
        $receiveSms->user_id                =       $request->user_id;
        $receiveSms->save();
        
        $originalMessage                    =       ReminderSms::where('message_id',$request->original_message_id)->first();
        if($originalMessage->parentService->serviceData->is_remindar==2)
            echo 'test';


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
}
