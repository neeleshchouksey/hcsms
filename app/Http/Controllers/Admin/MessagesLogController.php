<?php

namespace App\Http\Controllers\Admin;

use Response;
use App\ReminderSms;
use Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesLogController extends Controller
{
    public $slug   =   'messages-log';
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
        
         $query = request()->query();
        /**
         * get all messages from database
         *
         * @var        <type>
         */
        $messages     =   Helper::getAllMessageLogs($query);

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
                     * assign patient name to patient varible
                     *
                     * @var        <type>
                     */
                    $getPatient    =     $getmessage->parentService->patient;
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
                    
                    $serviceAbbr =      $getmessage->parentService->serviceData->data;
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

                    $getPatient         =   $getmessage->parentAppt->patient;
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

                    $serviceAbbr =      $getmessage->parentAppt->serviceData->data;
                endif;
            }
            $smsLabel   =   '';
            if($getmessage->parentSmsType()->exists())
                $smsLabel   = $getmessage->parentSmsType->label;

            $country                    =       $getPatient->doctor->getCountry->full_name;

            $countryCode                =       $getPatient->doctor->getCountry->iso_3166_2;

            $ch2 = curl_init();

            curl_setopt($ch2, CURLOPT_URL, "https://rest.clicksend.com/v3/pricing/".$countryCode);

            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);
            
            curl_setopt($ch2, CURLOPT_HEADER, FALSE);

            $response2 = curl_exec($ch2);
            
            curl_close($ch2);
            
            $response2 = json_decode($response2);

            if(isset($response2->data) && !empty($response2->data)):
            
                $smscost   =    $response2->data->sms->price_rate_0;
            
                $smsFees   =    $smscost*2;  
            
            else:
            
                $smscost   =    'Not available';
            
                $smsFees   =    0;
            
            endif;

            $messageParts               =       \Helper::getSmsLength($message->body);
            
            $messageFees                =       $messageParts*$smsFees;
            /**
             * assigning values for record array
             */
            $records[$i]['date']        =   $message->created_at->format('d-m-Y');
            
            $records[$i]['time']        =   $message->created_at->format('H:i');

            $records[$i]['patient']     =   $patient;

            $records[$i]['practice']    =   $practice;

            $records[$i]['status']      =   $message->type;

            $records[$i]['country']     =       $country;

            $records[$i]['mparts']      =       $messageParts;

            $records[$i]['mfees']       =       '$ '.$messageFees;
           
            $records[$i]['language']    =   $language;
    
            $records[$i]['message']     =   $message->body;
          
            $records[$i]['action']      =   "<a href='javascript:void(0);' service-type='". $serviceAbbr.' '.$smsLabel."' class='profile-popup' data-user='".route('patients.show',$patientid)."'>Profile</a>";
            
            $i++;
        }
        /**
         * Return json response of customer records
         */
        return \Response::json($records);

    }
}
