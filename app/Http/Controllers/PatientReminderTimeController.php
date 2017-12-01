<?php

namespace App\Http\Controllers;

use App\PatientReminderTime;
use App\Patient;
use App\Service;
use Illuminate\Http\Request;

class PatientReminderTimeController extends Controller
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
        $patient            =       Patient::find($request->patient);
        $service            =       Service::find($request->service);

        $where2             =       array('service_id'=>$request->service,'patient_id'=>$request->patient);
        $patientService     =       $patient->reminderService()->where($where2)->first();
        if($request->action=='add'):
            $patientReminderTime                =   new PatientReminderTime;
            $patientReminderTime->service_id    =   $request->service;
            $patientReminderTime->patient_id    =   $request->patient;
            $patientReminderTime->pat_ser_id    =   $patientService->id;
            $patientReminderTime->time_id       =   $request->time_id;
            $patientReminderTime->save();
        else:
            $where                  =   array('service_id'=>$request->service,'patient_id'=>$request->patient,'time_id'=>$request->time_id);
            $patientReminderTime    =   PatientReminderTime::where($where)->delete();  
        endif;
               return \Response::view('partials.ajax.service',compact('patient','service'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientReminderTime  $patientReminderTime
     * @return \Illuminate\Http\Response
     */
    public function show(PatientReminderTime $patientReminderTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientReminderTime  $patientReminderTime
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientReminderTime $patientReminderTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientReminderTime  $patientReminderTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientReminderTime $patientReminderTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientReminderTime  $patientReminderTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientReminderTime $patientReminderTime)
    {
        //
    }
}
