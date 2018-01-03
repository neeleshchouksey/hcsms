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
        /**
         * Find patient in database
         *
         * @var        <type>
         */
        $patient            =       Patient::find($request->patient);

        /**
         * Find service in database
         *
         * @var        <type>
         */
        $service            =       Service::find($request->service);

        /**
         * initial where array to find patient service
         * based on posted service id
         *
         * @var        array
         */
        $where2             =       array('service_id'=>$request->service,'patient_id'=>$request->patient);

         /**
         * find patient service
         *
         * @var        <type>
         */
        $patientService     =       $patient->reminderService()->where($where2)->first();

        
        /**
         * check current patient service 
         * active or not if action then 
         * change its is changed value
         */
        
        if($patientService->status==1):

            /**
             * Assign value one for ischanged object
             */
            $patientService->ischanged  =       1;

            /**
             * Save patient service
             */
            $patientService->save();

        endif;

        /**
         * check current action 
         * if current action is add
         * then insert patient reminder times in db
         */
        if($request->action=='add'):

            /**
             * intialize patient reminder time object
             * and assign service ,patient and patient service
             * and time id to patientReminderDays object
             * and save it
             * @var        <type>
             */
            $patientReminderTime                =   new PatientReminderTime;
            $patientReminderTime->service_id    =   $request->service;
            $patientReminderTime->patient_id    =   $request->patient;
            $patientReminderTime->pat_ser_id    =   $patientService->id;
            $patientReminderTime->time_id       =   $request->time_id;
            $patientReminderTime->save();
        else:

            /**
             * initialize where for service_id,patient_id and time_id
             *
             * @var        array
             */
            $where                  =   array('service_id'=>$request->service,'patient_id'=>$request->patient,'time_id'=>$request->time_id);
            
            /**
             * delete day id based on service_id,patient_id and time_id
             *
             * @var        <type>
             */
            
            $patientReminderTime    =   PatientReminderTime::where($where)->delete();  
        endif;
        
        /**
         * Pass pateient and service  object in 
         * service view and return view for ajax response
         */
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
