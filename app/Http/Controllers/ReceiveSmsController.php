<?php

namespace App\Http\Controllers;

use App\ReceiveSms;
use App\ReminderSms;
use App\ServiceSmsTypes;
use Helper;
use Illuminate\Http\Request;
use Auth;

class ReceiveSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $originalMessage                    =       ReceiveSms::where('original_message_id','8E1646D9-2DAE-4D79-819E-27F73FD47108')->first();
        $originalMessage    =       ReminderSms::where('message_id','B9188247-6A96-44C9-BC3E-AAC026655AF7')->first();
          $parentService = $originalMessage->parentService;
         
         echo "<pre>";
         print_r($parentMessageAc);
        echo $reading    =   "989392";
        echo "<br>";
      echo  is_numeric($reading);
      echo strlen($reading);
        if(is_numeric($reading)==1 && strlen($reading)>10)
            die('test');
            die();
        echo Helper::checkReceiveMessageFormat($reading);
        echo "<pre>";
       
        $history         =    'average';
        if($originalMessage->parentService->service_id==1)
          $parentService = $originalMessage->parentService;
        else
            $parentService = $originalMessage->parentService->patient->reminderService->where('service_id',1)->first();
        $ServiceSmsTypes            =   ServiceSmsTypes::where('name','bphistory')->first();
        print_r($ServiceSmsTypes);



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
         * Here get parent message using original message id
         *
         * @var        <type>
         */

        $originalMessage    =       ReminderSms::where('message_id',$request->original_message_id)->first();

        /**
         * here we get message body and remove spaces using trim function
         * and change all message to lower chase and assigned to action key word
         * for bp history , help ,average and share message get and for reply them
         *
         * @var        callable
         */
        $action            =       trim(strtolower($request->body));
         if(is_numeric($reading)==1 && strlen($reading)>10){
            $action = 'share';
         }

        /**
         * Assign bp service id  for service_id variable
         *
         * @var        integer
         */
        $service_id         =       1;

        /**
         *  start switch case if action help,history,average and share
         *  than perform action for those
         *  if action not match with those cases then go to default condition
         */
        switch ($action) {
            case 'bphistory':
            case 'bphelp':
            case 'bpaverage':
            case 'bpshare':
            case 'bshelp':
            case 'advice':
            case 'bshistory':
            case 'bsaverage':
            case 'buy':
            case 'appointments':
                              
                 /**
                 * find current action service id
                 *
                 * @var        <type>
                 */
                $service_id            =   ServiceSmsTypes::where('name',$action)->value('service_id');

                /**
                 * check is parent service
                 * exists
                 */
                if($originalMessage->parentService):
                    /**
                     * check orignal message parent service is matched with bp service id or not
                     * if match then assigne original parent service for parent sevice varible
                     */

                    if($originalMessage->parentService->service_id==$service_id)

                        $parentService = $originalMessage->parentService;

                    /**
                     * if not then find patient bp service id 
                     * and assign patient bp service to parent service
                     */
                    else
                        $parentService = $originalMessage->parentService->patient->reminderService->where('service_id',$service_id)->first();

                    /**
                     * initialize empty type for
                     * other services
                     *
                     * @var        string
                     */
                    $type = '';
                else:

                    /**
                     * find patient services appointments
                     *
                     * @var        <type>
                     */
                    $parentService = $originalMessage->parentAppt;

                    /**
                     * initialize type appointment for 
                     * appointment services
                     *
                     * @var        string
                     */

                    $type  = 'appointment';

                endif;
                /**
                 * Call helper function for send bp average,help,history and share message
                 * based of action value
                 */
                \Helper::sendSmsMessage($parentService,$action,$type);

                /**
                 * find latest send message
                 *
                 * @var        <type>
                 */

                $parentMessage = $parentService->reminderMessage()->latest()->first();

                /**
                 * initialize recieve sms object and
                 * get receive message data and assign to receive sms object
                 *
                 * @var        ReceiveSms
                 */

                $receiveSms                         =       new ReceiveSms;

                $receiveSms->sms_time               =       $request->timestamp;
                $receiveSms->to                     =       $request->to;
                $receiveSms->from                   =       $request->from;
                $receiveSms->body                   =       $request->body;
                $receiveSms->original_body          =       $request->original_body;
                
                $receiveSms->message_id             =       $request->message_id;
                $receiveSms->custom_string          =       $request->custom_string;
                $receiveSms->user_id                =       $request->user_id;

                /**
                 * save lastest message id as parent message id for recieve message
                 */
                $receiveSms->original_message_id    =       $parentMessage->message_id;

                 /**
                  * save receive message object
                  */
                $receiveSms->save();

            break;
        case 'share':
            # code...

                $parentService = $originalMessage->parentService;
                $receiveSms                         =       new ReceiveSms;

                $receiveSms->sms_time               =       $request->timestamp;
                $receiveSms->to                     =       $request->to;
                $receiveSms->from                   =       $request->from;
                $receiveSms->body                   =       $request->body;
                /**
                 * assign recieve message data to receive message object
                 */
                $receiveSms->original_body          =       $request->original_body;
                $receiveSms->message_id             =       $request->message_id;
                
                $receiveSms->custom_string          =       $request->custom_string;
                $receiveSms->user_id                =       $request->user_id;

                /**
                 * save receive sms object
                 */
                $receiveSms->save();

                $parentMessageAc    =   $parentService->serviceData->smsTypes()->where('label','SHARED')->first();
                $parentMessageAc2   =   $parentService->serviceData->smsTypes()->where('label','SHARED OTHER')->first();

                \Helper::sendSmsMessage($parentService,$parentMessageAc->name,$receiveSms);
                \Helper::sendSmsMessage($parentService,$parentMessageAc2->name,$receiveSms,'',$request->body);


            break;
            
        default: 

            
            /**
             * initialize recieve sms object and
             * get receive message data and assign to receive sms object
             *
             * @var        ReceiveSms
             */

            $receiveSms                         =       new ReceiveSms;

            $receiveSms->sms_time               =       $request->timestamp;
            $receiveSms->to                     =       $request->to;
            $receiveSms->from                   =       $request->from;
            $receiveSms->body                   =       $request->body;

            /**
             * Call helper function to check receive message 
             * format match with blood pressure service reply 
             * or not if reply match with bp service reply format
             * then function return 1
             */
            $service_id     =   Helper::checkReceiveMessageFormat($request->body);
            if($service_id > 0):

                /**
                 * check orignal message parent service is matched with bp service id or not
                 * if match then assigne original parent service for parent sevice varible
                 */
                if($originalMessage->parentService->service_id==$service_id)
                    $parentService = $originalMessage->parentService;

                /**
                 * if not then find patient bp service id 
                 * and assign patient bp service to parent service
                 */
                else
                    $parentService = $originalMessage->parentService->patient->reminderService->where('service_id',$service_id)->first();
                /**
                 * find bp latest send reminder message to patient
                 *
                 * @var        <type>
                 */

                $parentMessageAc = $parentService->reminderMessage()->whereHas('parentSmsType',function($q){ $q->where('is_sender',1);})->latest()->first();

                if($service_id==1):    
                    /**
                     * Assign reply message to reading variable
                     *
                     * @var        <type>
                     */
                    $reading     =  $request->body;

                    /**
                     * Define empty reading data to save readings
                     *
                     * @var        array
                     */
                    $readingData =  array();

                    /**
                     * check bp reading seperated by space 
                     */
                    if(strpos($reading, ' ')!='')
                        /**
                         * if yes the reading varible exploded by space
                         * and save reading in reading data varible
                         *
                         * @var        callable
                         */
                        $readingData = explode(' ', $reading);

                      /**
                       * check if readings are seperated by slash 
                       */
                    elseif(strpos($reading,'/')!='')

                        /**
                        * if yes the reading varible exploded by slash
                         * and save reading in reading data varible 
                         *
                         * @var        callable
                         */
                        $readingData = explode('/', $reading);

                    /**
                     * assign reading data first index as bg number
                     */
                    $receiveSms->bg_number            =   $readingData[0];

                    /**
                     * assign reading data last index as sm number
                     */
                    $receiveSms->sm_number            =   end($readingData);

                endif;

                /**
                 * assign patient bp service id as service id of reply message
                 */
                $receiveSms->patient_service_id   =   $parentService->id;

                /**
                 * assign lastest bp reminder sent message id as original message id of curent message
                 */
                $receiveSms->original_message_id  =   $parentMessageAc->message_id;


            else:

                /**
                 * check orignal message parent service is matched with tb service id or not
                 * if match then assigne original parent service for parent sevice varible
                 */
                if($originalMessage->parentService->service_id==3)
                    $parentService = $originalMessage->parentService;

                /**
                 * if not then find patient tb service id 
                 * and assign patient tb service to parent service
                 */
                else
                    $parentService = $originalMessage->parentService->patient->reminderService->where('service_id',3)->first();

                /**
                 * find tb latest send reminder message to patient
                 *
                 * @var        <type>
                 */

                $parentMessageAc = $parentService->reminderMessage()->whereHas('parentSmsType',function($q){ $q->where('is_sender',1);})->latest()->first();

                
                /**
                 * assign receive original message id as original message id of current message
                 */
                $receiveSms->original_message_id    =       $parentMessageAc->message_id;

            endif;

            /**
             * assign recieve message data to receive message object
             */
            $receiveSms->original_body          =       $request->original_body;
            $receiveSms->message_id             =       $request->message_id;
            
            $receiveSms->custom_string          =       $request->custom_string;
            $receiveSms->user_id                =       $request->user_id;

            /**
             * save receive sms object
             */
            $receiveSms->save();

            /**
             * check parent service id is bp service id
             */
            if($service_id>0):
                
                /**
                 * call helper function for send reading receive for bp service
                 */
                \Helper::sendSmsMessage($parentService,'reading-received',$receiveSms);

                if($service_id==1):
                    /**
                     * assign parent service  bg number as tar_bg_number
                     *
                     * @var        <type>
                     */
                    $tar_bg_number          =   $parentService->bg_number;

                    /**
                     * assign parent service  sm number as tar_sm_number
                     *
                     * @var        <type>
                     */
                    $tar_sm_number          =   $parentService->sm_number;

                    /**
                     * calculate  parent service bp big number percetange respect to receive message bp big number
                     *
                     * @var        <type>
                     */
                    $bpBigPercentage        =   (($receiveSms->bg_number-$tar_bg_number)/$tar_bg_number)*100;

                    /**
                     * calcalate parent service bp sm number percentage respect to receive message bp sm number
                     *
                     * @var        <type>
                     */
                    
                    $bpSmPercentage        =   (($receiveSms->sm_number-$tar_sm_number)/$tar_sm_number)*100;
                    
                    /**
                     * if bp big percentage or bp sm percentage is greater than parent service
                     * very high alert percentage than sent bp very high alert messag
                     */
                    if($bpSmPercentage>$parentService->very_high_alert || $bpBigPercentage>$parentService->very_high_alert){
                        
                        /**
                         * call helper function to send bp very high reading message
                         */
                        \Helper::sendSmsMessage($parentService,'reading-very-high');

                    }

                    /**
                     * if bp big percentage or bp sm percentage is greater than parent service
                     *  high alert percentage than sent bp very high alert message
                     */
                    elseif($bpSmPercentage>$parentService->high_alert || $bpBigPercentage>$parentService->high_alert){

                      /**
                       * call helper function to send bp high reading message
                       */
                        \Helper::sendSmsMessage($parentService,'reading-high');
                        
                    }

                    /**
                     * if bp big percentage or bp sm percentage is less than parent service
                     * very low alert percentage than sent bp very low alert message
                     */
                    if($bpSmPercentage<(-$parentService->very_low_alert) || $bpBigPercentage<(-$parentService->very_low_alert)){

                        /**
                         * call helper fuction to sent bp very low alert message
                         */
                        \Helper::sendSmsMessage($parentService,'reading-very-low');
                        
                    }

                    /**
                     * if bp big percentage or bp sm percentage is less than parent service
                     * low alert percentage than sent bp low alert message
                     */
                    elseif($bpSmPercentage<(-$parentService->low_alert) || $bpBigPercentage<(-$parentService->low_alert)){

                        /**
                         * call helper function bp low alert message
                         */
                        \Helper::sendSmsMessage($parentService,'reading-low');
                        
                    }
                endif;
                if($service_id==2):
                    /**
                     * assign parent service  target as target_number
                     *
                     * @var        <type>
                     */
                    $target_number          =   $parentService->target;

                    

                    /**
                     * calculate  parent service bs target percetange respect to receive message bs reading
                     *
                     * @var        <type>
                     */
                    $targetPercentage        =   (($receiveSms->body-$target_number)/$target_number)*100;

                   
                    
                    /**
                     * if bp big percentage or bp sm percentage is greater than parent service
                     * very high alert percentage than sent bp very high alert messag
                     */
                    if($targetPercentage>$parentService->bs_very_high_alert){
                        
                        /**
                         *
                         * call helper function to send bp very high reading message
                         */
                        \Helper::sendSmsMessage($parentService,'reading-very-high');

                    }

                    /**
                     * if bp big percentage or bp sm percentage is greater than parent service
                     *  high alert percentage than sent bp very high alert message
                     */
                    elseif($targetPercentage>$parentService->bs_high_alert){

                      /**
                       * call helper function to send bp high reading message
                       */
                        \Helper::sendSmsMessage($parentService,'reading-high');
                        
                    }

                    /**
                     * if bp big percentage or bp sm percentage is less than parent service
                     * very low alert percentage than sent bp very low alert message
                     */
                   elseif($targetPercentage<(-$parentService->bs_very_low_alert)){

                        /**
                         * call helper fuction to sent bp very low alert message
                         */
                        \Helper::sendSmsMessage($parentService,'reading-very-low');
                        
                    }

                    /**
                     * if bp big percentage or bp sm percentage is less than parent service
                     * low alert percentage than sent bp low alert message
                     */
                    elseif($targetPercentage<(-$parentService->bs_low_alert)){

                        /**
                         * call helper function bp low alert message
                         */
                        \Helper::sendSmsMessage($originalMessage->parentService,'reading-low');
                        
                    }
                endif;
            endif;
        break;
        }
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReceiveSms  $receiveSms
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiveSms $receiveSms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReceiveSms  $receiveSms
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiveSms $receiveSms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReceiveSms  $receiveSms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceiveSms $receiveSms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReceiveSms  $receiveSms
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiveSms $receiveSms)
    {
        //
    }
    public function ajaxLoad(Request $request){

        /**
         * Assign posted message id to variable id
         *
         * @var        <type>
         */
        $id                 =       $request->message_id;

        /**
         * Check if action is  equal to
         * edit or not
         */
        if($request->action=='edit'){

            /**
             * Find Messeage id in database
             *
             * @var        <type>
             */

            $replyMessages      =       ReceiveSms::where('message_id',$id)->first();

            /**
             * Check logged in user is autorized
             * for edit that message or not
             */
            if($replyMessages->parentService->patient->doctor->id==Auth::user()->id){

                /**
                 * Check current message included value is 1
                 * then set it 2
                 */
                if($replyMessages->included==1){

                    /**
                     * Assign value 2 for included of receive message object
                     */
                    $replyMessages->included        =   2;

                }
                /**
                 * if it message included value is not 1 
                 * then set it to 1
                 */
                else{
                    /**
                     * Assign value 1 for included of receive message object
                     */
                    $replyMessages->included        =   1; 
                }
                /**
                 * Save receive message object
                 */

                $replyMessages->save();
            }

            /**
             * Call Helper function which takes
             * Patient service and return its history
             */
           return Helper::getServiceHistory($replyMessages->parentService);

        }
        /**
         * This section is not in use currently
         */
        else{

            /**
             * find all received message 
             * based and it original message id
             *
             * @var        <type>
             */
            $replyMessages      =       ReceiveSms::where('original_message_id',$id)->get();
            
            /**
             * return ajax view for ajax response
             */
            return \Response::view('partials.ajax.replyMessage',compact('replyMessages'));
        }

    }
    public function replyBpmHistory(Request $request){
        $receiveSms                         =       new ReceiveSms;
        $receiveSms->sms_time               =       $request->timestamp;
        $receiveSms->to                     =       $request->to;
        $receiveSms->from                   =       $request->from;
        $receiveSms->body                   =       $request->body;

        $receiveSms->original_body          =       $request->original_body;
        $receiveSms->original_message_id    =       $request->original_message_id;
        $receiveSms->message_id             =       $request->message_id;
        $receiveSms->custom_string          =       $request->custom_string;
        $receiveSms->user_id                =       $request->user_id;
        $receiveSms->save();
        die;
    }
}
