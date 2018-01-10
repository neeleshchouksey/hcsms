<?php

namespace App\Http\Controllers\Admin;

use Response;
use App\User as Customer;
use App\ReminderSms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        if(request()->action=='user-popup'){
            $staffs =  $customer->staffs;
            return Response::view('admin.partials.ajax.customer.staff',compact('staffs'));
        }
        else{
            $others              =   $customer->keyContacts()->where('is_fixed',0)->get();
            $practice_manager    =   $customer->keyContacts()->where('title','practice_manager')->first();
            $billing_contact     =   $customer->keyContacts()->where('title','billing_contact')->first();
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
    public function ajaxLoad(){
        $users      =   Customer::all();
        $records    =   array();
        $i          =   0;
        foreach ($users as $user) {
           $totalreminderSms                 =   ReminderSms::whereHas('parentService',
                                                                    function($q) use($user){
                                                                        $q->whereHas('patient',
                                                                            function($q2) use($user){
                                                                                $q2->whereHas('doctor',
                                                                                    function($q3)use($user){
                                                                                        $q3->where('id',$user->id);
                                                                                    });
                                                                            });
                                                                    })
                                                        ->orWhereHas('parentAppt',
                                                                    function($q) use($user){
                                                                        $q->whereHas('patient',
                                                                            function($q2) use($user){
                                                                                $q2->whereHas('doctor',
                                                                                    function($q3)use($user){
                                                                                        $q3->where('id',$user->id);
                                                                                    });
                                                                            });
                                                                    })->count();
            $lastMessage                 =   ReminderSms::whereHas('parentService',
                                                                    function($q) use($user){
                                                                        $q->whereHas('patient',
                                                                            function($q2) use($user){
                                                                                $q2->whereHas('doctor',
                                                                                    function($q3)use($user){
                                                                                        $q3->where('id',$user->id);
                                                                                    });
                                                                            });
                                                                    })
                                                        ->orWhereHas('parentAppt',
                                                                    function($q) use($user){
                                                                        $q->whereHas('patient',
                                                                            function($q2) use($user){
                                                                                $q2->whereHas('doctor',
                                                                                    function($q3)use($user){
                                                                                        $q3->where('id',$user->id);
                                                                                    });
                                                                            });
                                                                    })->latest()->first();
            $lastMessageSendDate= "";
            if(!empty($lastMessage))
                $lastMessageSendDate    =   $lastMessage->created_at->format('d-m-Y');
           $records[$i]['company']      =   $user->company;
           $records[$i]['practice']     =   $user->name;
           $records[$i]['users']        =   "<a href='javascript:void(0);' class='user-popup' data-user='".route('customers.show',$user->id)."'>".$user->staffs->count()."</a>";
           $records[$i]['patients']     =   $user->patients->count();
           $records[$i]['reminders']    =   0;
           $records[$i]['lastMessage']  =   $lastMessageSendDate;
           $records[$i]['nextMessage']  =   0;
           $records[$i]['totalMessage'] =   $totalreminderSms;
           $records[$i]['action']       =   "<a href='javascript:void(0);' class='profile-popup' data-user='".route('customers.show',$user->id)."'>Profile</a>";
           $i++;
        }
        return \Response::json($records);

    }
}
