<?php

namespace App\Http\Controllers\Admin;

use App\LanguageSmsMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageSmsMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $where   =   array('language_id'=>$request->language,'sms_type_id'=>$request->smsType);  

        $languageSmsMessage     =  LanguageSmsMessage::where($where)->first();
        if(empty($languageSmsMessage)){

            $languageSmsMessage                 =       new LanguageSmsMessage;
            $languageSmsMessage->service_id     =       $request->service;
            $languageSmsMessage->language_id    =       $request->language;
            $languageSmsMessage->sms_type_id    =       $request->smsType;
            $languageSmsMessage->message        =       $request->message;
            $languageSmsMessage->save();
        }
        else{
            $languageSmsMessage->message        =       $request->message;
            $languageSmsMessage->save();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LanguageSmsMessage  $languageSmsMessage
     * @return \Illuminate\Http\Response
     */
    public function show(LanguageSmsMessage $languageSmsMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LanguageSmsMessage  $languageSmsMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(LanguageSmsMessage $languageSmsMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LanguageSmsMessage  $languageSmsMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $languageSmsMessage     =   LanguageSmsMessage::find($id);
       
        $languageSmsMessage->status     = 1;
        $languageSmsMessage->verified_by  =   \Auth::guard('admin')->user()->id;
        $languageSmsMessage->save();
        echo 'Verified by :'.\Auth::guard('admin')->user()->name;
        die;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LanguageSmsMessage  $languageSmsMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(LanguageSmsMessage $languageSmsMessage)
    {
        //
    }
}
