<?php

namespace App\Http\Controllers;
use App\ReminderDays;
use App\RemiderTime;
use App\RemindarDuration;
use App\Service;
use App\Patient;
use App\PatientService;
use App\PatientReminderDays;
use App\PatientReminderTime;
use Illuminate\Http\Request;

class PatientServiceController extends Controller
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
        // echo $request->service;
        // echo $request->patient;
        $where              =    array('patient_id'=>$request->patient,'service_id'=>$request->service);
        $patientService     =   PatientService::where($where)->first(); 
        $defaultDays        =   ReminderDays::where('isdefault',1)->pluck('id');
        $defaultTime        =   RemiderTime::where('isdefault',1)->pluck('id');

        if(count($patientService)==0):
            $duration           =   RemindarDuration::where('isdefault',1)->first();

            $patientService                 =       new PatientService;
            $patientService->service_id     =       $request->service;
            $patientService->patient_id     =       $request->patient;
            $patientService->status         =       $request->status;
            $patientService->period         =       6;
            $patientService->duration       =       $duration->id;
            $patientService->save();
            foreach ($defaultDays as $key => $value) {
                # code...
                $patientReminderDays                =       new PatientReminderDays;
                $patientReminderDays->service_id    =       $request->service;
                $patientReminderDays->patient_id    =       $request->patient;
                $patientReminderDays->pat_ser_id    =       $patientService->id;
                $patientReminderDays->day_id        =       $value;
                $patientReminderDays->save();

            }

            foreach ($defaultTime as $key => $value) {
                # code...
                $patientReminderTime                =       new PatientReminderTime;
                $patientReminderTime->service_id    =       $request->service;
                $patientReminderTime->patient_id    =       $request->patient;
                $patientReminderTime->pat_ser_id    =       $patientService->id;
                $patientReminderTime->time_id       =       $value;
                $patientReminderTime->save();

            }
        endif;
        if($request->action=='edit'):
           
            $patientGetServiceDays = PatientReminderDays::where($where)->pluck('day_id')->toArray();
           
            $patientGetServicetime = PatientReminderTime::where($where)->pluck('time_id')->toArray();

            return \Response::view('partials.ajax.reminder',compact('patientService','patientGetServiceDays','patientGetServicetime'));

        elseif($request->action=='update'):
   
            if(isset($request->duration)):
                $patientService->duration       =   $request->duration;
            elseif(isset($request->period)):
                $patientService->period         =   $request->period;
            elseif(isset($request->status)):
                $patientService->status         =   $request->status;
            elseif(isset($request->start)):
                $patientService->start_date     =   date('Y-m-d H:i:s');
            elseif(isset($request->stop)):
                $patientService->start_date     =   null;
            endif;
            $patientService->save(); 
            $patient =  $patientService->patient;
            $service =  Service::find($request->service);
            return \Response::view('partials.ajax.service',compact('patient','service'));
        else:
            return "add";
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientService  $patientService
     * @return \Illuminate\Http\Response
     */
    public function show(PatientService $patientService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientService  $patientService
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientService $patientService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientService  $patientService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientService $patientService)
    {
        //
        if(isset($request->duration)):
            $patientService->duration       =   $request->duration;
        elseif(isset($request->period)):
            $patientService->period         =   $request->period;
        elseif(isset($request->start)):
            $patientService->start_date     =   date('Y-m-d H:i:s');
        endif;
        $patientService->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientService  $patientService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientService $patientService)
    {
        //
    }
}
