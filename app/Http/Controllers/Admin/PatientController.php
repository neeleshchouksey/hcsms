<?php

namespace App\Http\Controllers\Admin;

use Response;
use Helper;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public $slug   =   'patients';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

         if(\Auth::guard('admin')->user()->role==2 && !\Auth::guard('admin')->user()->checkPer($this->slug)){
            //die;
          return redirect()->to('admin/dashboard');
        }
        return view('admin.patients.index');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
        return Response::view('admin.partials.ajax.patient.patient',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ajaxLoad(){

       
        $query = request()->query();
        
        /**
         * get all patients from database
         *
         * @var        <type>
         */

        $patients      =   Patient::where(
                                function($q) use($query){
                                    if(!empty($query)){
                                        if(isset($query['languages']) && !empty($query['languages'])){
                                            $q->where('language_id',$query['languages']);
                                        }
                                        if(isset($query['practices']) && !empty($query['practices'])){
                                            $q->where('user_id',$query['practices']);
                                        }
                                        if(isset($query['activeReminder'])){
                                            $q->whereHas('reminderService',function($q2){
                                                $q2->where('status',1);
                                            });
                                            $q->orWhereHas('appointments',function($q2){
                                                $q2->where('status',1);
                                            });
                                        }
                                        if(isset($query['languages']) && !empty($query['languages'])){
                                            $q->where('language_id',$query['languages']);
                                        }
                                        if(isset($query['practices']) && !empty($query['practices'])){
                                            $q->where('user_id',$query['practices']);
                                        }
                                    }

                                })
                            ->get();

        /**
         * initialize empty array records
         *
         * @var        array
         */
        $records    =   array();

        /**
         * initialize $i with value zero
         *
         * @var        integer
         */
        $i          =   0;

        foreach ($patients as $patient) {

            /**
             * call helper function for find total messages sent
             *
             * @var        <type>
             */
            $totalreminderSms           =   Helper::totalMessageSent($patient);

            /**
             * call helper function for find last message sent
             *
             * @var        <type>
             */
            $lastMessage                =   Helper::lastMessageSend($patient);

            /**
             * call helper function for find all active reminders
             *
             * @var        <type>
             */
            $activeReminders            =       Helper::getActiveReminders($patient);

            /**
             * initialize lastMessageSendDate variable
             *
             * @var        string
             */
            $lastMessageSendDate= "";

            /**
             * check lastMessage varible is empty 
             * or not
             */
            if(!empty($lastMessage))
                /**
                 * if lastMessage is not empty
                 * then assign it lastmessage 
                 * create date fof lastMessageSentDate
                 *
                 * @var        <type>
                 */
                $lastMessageSendDate    =   $lastMessage->created_at->format('d-m-Y');

            /**
             * assigning values for record array
             */
            $records[$i]['name']        =   $patient->name;
            
            $records[$i]['phone']       =   $patient->mobile;
           
            $records[$i]['language']    =   $patient->language->title;
           
            $records[$i]['practice']    =   $patient->doctor->name;
           
            $records[$i]['reminders']    =   $activeReminders;
           
            $records[$i]['lastMessage']  =   $lastMessageSendDate;
           
            $records[$i]['nextMessage']  =   0;
          
            $records[$i]['totalMessage'] =   $totalreminderSms;
          
            $records[$i]['action']       =   "<a href='javascript:void(0);' class='profile-popup' data-user='".route('patients.show',$patient->id)."'>Profile</a>";
            
            $i++;
        }
        /**
         * Return json response of customer records
         */
        return \Response::json($records);

    }
}
