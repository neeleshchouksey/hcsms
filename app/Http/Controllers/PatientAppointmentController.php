<?php

namespace App\Http\Controllers;

use App\PatientAppointment;
use App\RemiderTime;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentRequest;

class PatientAppointmentController extends Controller
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
    public function store(AppointmentRequest $request)
    {
        //
        $appointment                =       new PatientAppointment;
        $appointment->appt_date     =       $request->appt_date;
        $appointment->appt_time     =       $request->appt_time;
        $appointment->location      =       $request->location;
        $appointment->with          =       $request->with;
        $appointment->map_link      =       $request->map;
        $appointment->patient_code  =       $request->patient_postcode;
        $appointment->location_code =       $request->location_postcode;
        $appointment->service_id    =       $request->service;
        $appointment->reminders     =       implode(',',$request->reminders);
        $appointment->patient_id    =       $request->patient;
        $appointment->save();          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientAppointment  $patientAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(PatientAppointment $patientAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientAppointment  $patientAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientAppointment $patientAppointment)
    {
        //
        $times  =   RemiderTime::all();
         return \Response::view('partials.ajax.appointmentEdit',compact('patientAppointment','times'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientAppointment  $patientAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, PatientAppointment $patientAppointment)
    {
        //
        $patientAppointment->appt_date     =       $request->appt_date;
        $patientAppointment->appt_time     =       $request->appt_time;
        $patientAppointment->location      =       $request->location;
        $patientAppointment->with          =       $request->with;
        $patientAppointment->map_link      =       $request->map;
        $patientAppointment->patient_code  =       $request->patient_postcode;
        $patientAppointment->location_code =       $request->location_postcode;
        
        $patientAppointment->reminders     =       implode(',',$request->reminders);
        
        $patientAppointment->save();       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientAppointment  $patientAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientAppointment $patientAppointment)
    {
        //
    }
}
