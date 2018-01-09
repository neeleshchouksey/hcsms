<?php

namespace App\Http\Controllers;

use App\PatientAppointment;
use App\PatientAppointmentReminders;
use App\Service;
use App\Patient;
use App\RemiderTime;
use Helper;
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

        /**
         * Here Is initialize patient appointment object
         * to store patient appointment in db
         * here 
         *
         * @var        PatientAppointment
         */
        $appointment                =       new PatientAppointment;
      
        /**
         * Assingn appointment date for paient appointment object
         */
        $appointment->appt_date     =       $request->appt_date;
       
       /**
        * Assig appointment time for patient object
        */
        $appointment->appt_time     =       $request->appt_time;
       
       /**
        * Assign appointment location for patient object
        */
        $appointment->location      =       $request->location;
       
       /**
        * Assign appointment with patient appointment object
        */
        $appointment->with          =       $request->with;
      

       /**
        * Assign appointment map link for patient appointment object
        */
        $appointment->map_link      =       $request->map;
      
       /**
        * Assign appointment  patient code for patient appointment object
        */

        $appointment->patient_code  =       $request->patient_postcode;
        
         /**
        * Assign appointment location for patient appointment object
        */

        $appointment->location_code =       $request->location_postcode;
        
         /**
        * Assign appointment  service id for patient appointment object
        */

        $appointment->service_id    =       $request->service;
      
         /**
        * Assign appointment reminders for patient appointment object
        */

        $appointment->reminders     =       implode(',',$request->reminders);
      
         /**
        * Assign appointment  patient id for patient appointment object
        */

        $appointment->patient_id    =       $request->patient;
        
        /**
         * save patient object
         */
        $appointment->save();  

        /**
         * Assign patient reminder for get reminders variable
         *
         * @var        <type>
         */

        $getReminders     =       $request->reminders;

        /**
         *  get all service sms reminder types 
         *  and insert all reminder sms types
         *  in patient appoinment remider db
         */
        foreach ($appointment->serviceData->smsTypes()->where('is_reminder',1)->get() as $smsTypes) {
            /**
             * Initalize patient appointment reminder object
             *
             * @var        PatientAppointmentReminders
             */
            $reminders                  =   new PatientAppointmentReminders;
            
            /**
             * assingn patient appointment id to  patient appointment reminder object
             */
            $reminders->appointment_id  =   $appointment->id;
            
            /**
             * assingn rrminfrt id to  patient appointment reminder object
             */
            $reminders->reminder_id     =   $smsTypes->id;

            /**
             * Check startup message id is in array
             * then sent startup sms and save it status 
             * as sent
             */
             if($smsTypes->id==34 && in_array($smsTypes->id,$getReminders)):

                /**
                 * set appointment reminder as sent
                 */
                $reminders->status          =   3;

                /**
                 * call helper function for sent sms
                 */
                Helper:: sendSmsMessage($appointment,'start','appointment');

            /**
             * check reminder id in get reminder array or not
             * it it is in arrray then save it status
             * as 2
             */
            elseif(in_array($smsTypes->id,$getReminders)):

                /**
                 * assign status value 1 to patient appointment reminder object
                 */
                $reminders->status          =   1;
            else:

                /**
                 * assign status value 2 to patient appointment reminder object
                 */
                $reminders->status          =   2;

            endif;

            /**
             * save patient reminder object
             */
            $reminders->save();   

        }      
        
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
        return \Response::view('partials.ajax.viewApptMessageEdit',compact('patientAppointment'));
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

        $oldApptDate                       =       $patientAppointment->appt_date;
        $oldApptTime                       =       $patientAppointment->appt_time;

        $patientAppointment->appt_date     =       $request->appt_date;
        $patientAppointment->appt_time     =       $request->appt_time;
        $patientAppointment->location      =       $request->location;
        $patientAppointment->with          =       $request->with;
        $patientAppointment->map_link      =       $request->map;
        $patientAppointment->patient_code  =       $request->patient_postcode;
        $patientAppointment->location_code =       $request->location_postcode;
        $patientAppointment->reminders     =       implode(',',$request->reminders);
        $patientAppointment->save();

        $getReminders     =       $request->reminders;

        foreach ($patientAppointment->serviceData->smsTypes()->where('is_reminder',1)->get() as $smsTypes) {

            $reminders      =  PatientAppointmentReminders::where('appointment_id',$patientAppointment->id)->where('reminder_id',$smsTypes->id)->first();

            if(count($reminders)==0):

                $reminders                  =   new PatientAppointmentReminders;

                $reminders->appointment_id  =   $patientAppointment->id;

                $reminders->reminder_id     =   $smsTypes->id;

            endif;
            if($reminders->status!=3){

            
                if(in_array($smsTypes->id,$getReminders)){

                    $reminders->status          =   1;
                    
                }
                else {

                    $reminders->status          =   2;
                }

                $reminders->save();   
            }

        }      
        if($oldApptDate!=$request->appt_date || $oldApptTime!=$request->appt_time)
            Helper:: sendSmsMessage($patientAppointment,'changed','appointment'); 
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
    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request             The request
     * @param      \App\PatientAppointment   $patientAppointment  The patient appointment
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function updatePartial(Request $request, PatientAppointment $patientAppointment)
    {
        if($request->action == 'getapptlog'):

            return \Response::view('partials.ajax.viewApptLog',compact('patientAppointment'));
            
        else:

            if($patientAppointment->status==1){

                $patientAppointment->status     =   0;

                if($request->confirm==1)

                Helper::sendSmsMessage($patientAppointment,'stop','appointment');

            }
            /**
             * 
             * { item_description }
             */
            else
                $patientAppointment->status=1;

            $patientAppointment->save();

            $patient    =   $patientAppointment->patient;
            $service    =   $patientAppointment->serviceData;
            $view       =   view('partials.ajax.service',compact('patient','service'));
            $view       =   $view->render();
            $service_id =   $service->id;
            return \Response::json(compact('service_id','view'));
        endif;
    }
    public function getReminderServiceMessages(Service $service,Patient $patient){

        $reminderServices   =   $service->smsTypes()->where('is_sender',1)->get();

        $language           =   $patient->language;

        return \Response::view('partials.ajax.viewApptMessage',compact('reminderServices','language'));
    }
}
