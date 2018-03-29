<?php

namespace App\Http\Controllers\Admin;

use Response;
use Helper;
use App\User as Customer;
use App\ReminderSms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public $slug = 'customers';
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
        return view('admin.customers.index');
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
    public function show(Customer $customer)
    {
        //

        /**
         * check is request action is equal to 
         * user-popop if yes then return staff 
         * information view
         */
        if(request()->action=='user-popup'){
            /**
             * find all staffs of currect  custome
             *
             * @var        <type>
             */
            $staffs =  $customer->staffs;

            /**
             * pass staff object to view and return view for ajax response
             */
            return Response::view('admin.partials.ajax.customer.staff',compact('staffs'));
        }
        else{
            /**
             * find other keys  of current customers
             *
             * @var        <type>
             */
            $others              =   $customer->keyContacts()->where('is_fixed',0)->get();

            /**
             * find pratice manager key of current customers
             *
             * @var        <type>
             */
            $practice_manager    =   $customer->keyContacts()->where('title','practice_manager')->first();
            
            /**
             * find billing contact key of current customers
             *
             * @var        <type>
             */
            $billing_contact     =   $customer->keyContacts()->where('title','billing_contact')->first();
            
            /**
             * pass customer,others, pratice manager and billing_contact in view
             * and return view for ajax response
             */
            return Response::view('admin.partials.ajax.customer.profile',compact('customer','others','practice_manager','billing_contact')); 
        }
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
    /**
     * ajax funtion which loads all customer
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function ajaxLoad(){

        /**
         * get all customers from database
         *
         * @var        <type>
         */
        $users      =   Customer::all();

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

        foreach ($users as $user) {

            /**
             * call helper function for find total messages sent
             *
             * @var        <type>
             */
            $totalreminderSms           =       Helper::totalMessageSent($user);

            /**
             * call helper function for find last message sent
             *
             * @var        <type>
             */
            $lastMessage                =       Helper::lastMessageSend($user);

            /**
             * call helper function for find all active reminders
             *
             * @var        <type>
             */
            $activeReminders            =       Helper::getActiveReminders($user);


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
            $records[$i]['company']      =   $user->company;
            
            $records[$i]['practice']     =   $user->name;
           
            $records[$i]['users']        =   "<a href='javascript:void(0);' class='user-popup' data-user='".route('customers.show',$user->id)."'>".$user->staffs->count()."</a>";
           
            $records[$i]['patients']     =   $user->patients->count();
           
            $records[$i]['reminders']    =   $activeReminders;
           
            $records[$i]['lastMessage']  =   $lastMessageSendDate;
           
            $records[$i]['nextMessage']  =   0;
          
            $records[$i]['totalMessage'] =   $totalreminderSms;
          
            $records[$i]['action']       =   "<a href='javascript:void(0);' class='profile-popup' data-user='".route('customers.show',$user->id)."'>Profile</a>";
            
            $i++;
        }
        /**
         * Return json response of customer records
         */
        return \Response::json($records);

    }
}
