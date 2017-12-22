<?php

namespace App\Http\Controllers\Admin;

use App\ServiceSmsTypes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceSmsTypesController extends Controller
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
        $serviceSmsTypes    =       ServiceSmsTypes::where('service_id',$request->service)->get();
        
        $language           =       \App\Language::find($request->language);

        $service            =       $request->service;

        if(!$serviceSmsTypes->isEmpty())
        return \Response::view('admin.partials.ajax.smsMessage',compact('serviceSmsTypes','language','service'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceSmsTypes  $serviceSmsTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceSmsTypes $serviceSmsTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceSmsTypes  $serviceSmsTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceSmsTypes $serviceSmsTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceSmsTypes  $serviceSmsTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceSmsTypes $serviceSmsTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceSmsTypes  $serviceSmsTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceSmsTypes $serviceSmsTypes)
    {
        //
    }
}
