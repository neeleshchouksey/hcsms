<?php

namespace App\Http\Controllers;

use App\PatientReminderDays;
use App\Patient;
use App\Service;
use Illuminate\Http\Request;

class PatientReminderDaysController extends Controller
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
            $patientReminderDays                =   New PatientReminderDays;
            $patientReminderDays->service_id    =   $request->service;
            $patientReminderDays->patient_id    =   $request->patient;
            $patientReminderDays->pat_ser_id    =   $patientService->id;
            $patientReminderDays->day_id        =   $request->day;
            $patientReminderDays->save();
            //return $patientReminderDays->id;
        else:
            $where =    array('service_id'=>$request->service,'patient_id'=>$request->patient,'day_id'=>$request->day);
            $patientReminderDays    =   PatientReminderDays::where($where)->delete();
        endif;   
        return \Response::view('partials.ajax.service',compact('patient','service'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientReminderDays  $patientReminderDays
     * @return \Illuminate\Http\Response
     */
    public function show(PatientReminderDays $patientReminderDays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientReminderDays  $patientReminderDays
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientReminderDays $patientReminderDays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientReminderDays  $patientReminderDays
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientReminderDays $patientReminderDays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientReminderDays  $patientReminderDays
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientReminderDays $patientReminderDays)
    {
        //
    }
}
