<?php

namespace App\Http\Controllers\Admin;

use Response;
use App\ReminderSms;
use Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveRemindersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.reminders.index');
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
    public function show($id)
    {
        //
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

        /**
         * get all messages from database
         *
         * @var        <type>
         */
        $messages     =   Helper::getAllMessageLogs();

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

        foreach ($messages as $message) {

            $getmessage                    =       Helper::getOriginalMessage($message->message_id);

            $patient    =   '';

            $practice   =   '';

            $language   =   '';

            if($getmessage->parentService){

                $patient    =     $getmessage->parentService->patient->name;

                $practice   =     $getmessage->parentService->patient->doctor->name;

                $language   =     $getmessage->parentService->patient->language->title;
            }
            elseif($getmessage->parentAppt){

                $patient    =     $getmessage->parentAppt->patient->name;

                $practice   =     $getmessage->parentAppt->patient->doctor->name;

                $language   =     $getmessage->parentAppt->patient->language->title;
            }

            /**
             * assigning values for record array
             */
            $records[$i]['date']        =   $message->created_at->format('d-m-Y');
            
            $records[$i]['time']        =   $message->created_at->format('H:i');

            $records[$i]['patient']     =   $patient;

            $records[$i]['practice']    =   $practice;

            $records[$i]['status']      =   $message->type;

           
            $records[$i]['language']    =   $language;
    
            $records[$i]['message']     =   $message->body;
          
            $records[$i]['action']      =   "<a href='javascript:void(0);' class='profile-popup' data-user='".route('messages-log.show',$getmessage->id)."'>Profile</a>";
            
            $i++;
        }
        /**
         * Return json response of customer records
         */
        return Response::json($records);

    }

}
