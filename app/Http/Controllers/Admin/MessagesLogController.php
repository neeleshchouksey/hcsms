<?php

namespace App\Http\Controllers\Admin;

use Response;
use App\ReminderSms;
use Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         return view('admin.messages.index');
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

            /**
             * call helper fuction to get 
             * original Message
             *
             * @var        <type>
             */
            $getmessage                    =       Helper::getOriginalMessage($message->message_id);

            /**
             * intialize patient variable
             *
             * @var        string
             */
            $patient    =   '';

            $patientid  =   '';

            /**
             * initialize practice variable
             *
             * @var        string
             */

            $practice   =   '';

            /**
             * initialize  language varible
             *
             * @var        string
             */

            $language   =   '';

            /**
             * check if parent service is exist 
             * or original messge or not
             */

            if($getmessage->parentService){

                /**
                 * check patient service's patient is exist 
                 * or not 
                 */

                if($getmessage->parentService->patient):

                    /**
                     * assign patient id to patientid varible
                     *
                     * @var        <type>
                     */
                    $patientid    =     $getmessage->parentService->patient->id;

                    /**
                     * assign patient name to patient varible
                     *
                     * @var        <type>
                     */
                    $patient    =     $getmessage->parentService->patient->name;

                    /**
                     * assign patient's doctor name as practice name
                     *
                     * @var        <type>
                     */

                    $practice   =     $getmessage->parentService->patient->doctor->name;

                    /**
                     * assign patient's language  to language variable
                     *
                     * @var        <type>
                     */
                    $language   =     $getmessage->parentService->patient->language->title;

                endif;
            }

            /**
             * check if parent appointment is exist 
             * or original messge or not
             */
            elseif($getmessage->parentAppt){

                /**
                 * check patient appointment's patient is exist 
                 * or not 
                 */
                if($getmessage->parentAppt->patient):
                    /**
                     * assign patient id to patientid varible
                     *
                     * @var        <type>
                     */
                    $patientid    =     $getmessage->parentAppt->patient->id;
                    /**
                     * assign patient name to patient varible
                     *
                     * @var        <type>
                     */
                    $patient    =     $getmessage->parentAppt->patient->name;

                    /**
                     * assign patient's doctor name as practice name
                     *
                     * @var        <type>
                     */

                    $practice   =     $getmessage->parentAppt->patient->doctor->name;
                    
                    /**
                     * assign patient's language  to language variable
                     *
                     * @var        <type>
                     */
                    $language   =     $getmessage->parentAppt->patient->language->title;
                    
                endif;
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
          
            $records[$i]['action']      =   "<a href='javascript:void(0);' class='profile-popup' data-user='".route('patients.show',$patientid)."'>Profile</a>";
            
            $i++;
        }
        /**
         * Return json response of customer records
         */
        return \Response::json($records);

    }
}
