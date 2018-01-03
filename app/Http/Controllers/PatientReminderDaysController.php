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
        
        /**
         * Find patient in database
         *
         * @var        <type>
         */
        $patient                    =       Patient::find($request->patient);

        /**
         * Find service in database
         *
         * @var        <type>
         */
        $service                    =       Service::find($request->service);

        /**
         * initial where array to find patient service
         * based on posted service id
         *
         * @var        array
         */
        $where2                     =       array('service_id'=>$request->service,'patient_id'=>$request->patient);

        /**
         * find patient service
         *
         * @var        <type>
         */
        $patientService             =       $patient->reminderService()->where($where2)->first();
        
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
         * then insert patient reminder days in db
         */
        if($request->action=='add'):

            /**
             * Check is post day object 
             * is array or not 
             */
            if(is_array($request->day)):

                /**
                 * if post day object is array 
                 * then insert all values in db 
                 * using foreach loop
                 */
                foreach ($request->day as $day) {

                    /**
                     * initialize where array to check 
                     * day id is exist in db or not
                     *
                     * @var        array
                     */
                    $where =    array('service_id'=>$request->service,'patient_id'=>$request->patient,'day_id'=>$day);

                    /**
                     * find day id in dabase respect to
                     * service_id,patient_id and day_id
                     *
                     * @var        <type>
                     */
                    $patientReminderDaysCheck    =   PatientReminderDays::where($where)->first();
                    
                    /**
                     * check if dayid not exist in database
                     * then insert in db
                     */
                    if(empty($patientReminderDaysCheck)):
                        
                        /**
                         * intialize patient reminder day object
                         * and assign service ,patient and patient service
                         * and day id to patientReminderDays object
                         * and save it
                         * @var        <type>
                         */
                        $patientReminderDays                =   New PatientReminderDays;
                        
                        $patientReminderDays->service_id    =   $request->service;
                        
                        $patientReminderDays->patient_id    =   $request->patient;
                        
                        $patientReminderDays->pat_ser_id    =   $patientService->id;
                        
                        $patientReminderDays->day_id        =   $day;
                        
                        $patientReminderDays->save();
                    
                    endif;
                }
            /**
             * if day object is not array
             * then save day object id in database
             */
            else:
                /**
                 * intialize patient reminder day object
                 * and assign service ,patient and patient service
                 * and day id to patientReminderDays object
                 * and save it
                 * @var        <type>
                 */
                $patientReminderDays                =   New PatientReminderDays;
                
                $patientReminderDays->service_id    =   $request->service;
                
                $patientReminderDays->patient_id    =   $request->patient;
                
                $patientReminderDays->pat_ser_id    =   $patientService->id;
                
                $patientReminderDays->day_id        =   $request->day;
                
                $patientReminderDays->save();
            
            endif;
        /**
         * if current action is not add
         * then delete day id from database
         */
        else:
            /**
             * if current posted day object 
             * array then delete all days id from database
             */
            if(is_array($request->day)):
                
                /**
                 * Pass day array in day loop
                 */
                foreach ($request->day as $day) {
                    
                    /**
                     * initialize where for service_id,patient_id and day_id
                     *
                     * @var        array
                     */
                    
                    $where =    array('service_id'=>$request->service,'patient_id'=>$request->patient,'day_id'=>$day);
                    
                    /**
                     * delete day id based on service_id,patient_id and day_id
                     *
                     * @var        <type>
                     */
                    $patientReminderDays    =   PatientReminderDays::where($where)->delete();
                }
            else:

                /**
                 * initialize where for service_id,patient_id and day_id
                 *
                 * @var        array
                 */
                $where      =       array('service_id'=>$request->service,'patient_id'=>$request->patient,'day_id'=>$request->day);

                /**
                 * delete day id based on service_id,patient_id and day_id
                 *
                 * @var        <type>
                 */
                $patientReminderDays    =   PatientReminderDays::where($where)->delete();

            endif;

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
