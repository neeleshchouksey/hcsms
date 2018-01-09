<?php

namespace App\Http\Controllers;
use Auth;
use App\KeyContacts;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UpdatePractice;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $others              =   Auth::user()->keyContacts()->where('is_fixed',0)->get();
        $practice_manager    =   Auth::user()->keyContacts()->where('title','practice_manager')->first();
        $billing_contact     =   Auth::user()->keyContacts()->where('title','billing_contact')->first();
        return view('profile.index',compact('others','practice_manager','billing_contact'));
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
    public function store(ProfileRequest $request)
    {
        //
        
        $data                   =       $request;
        $user                   =       Auth::user();
        $user->name             =       $data['name'];
        $user->email            =       $data['email'];
        $user->company          =       $data['company'];
        $user->sender_id        =       $data['sender_id'];
        $user->postcode         =       $data['postcode'];
        $user->appt_sender_id   =       $data['appt_sender_id'];
        $user->address          =       $data['address'];
        $user->country          =       $data['country'];
        $user->contact          =       $data['phone'];
        $user->practice_id      =       implode(',', $data['practice_type']);
        $user->save();

        $practiceM  =   $data['keycontacts']['practice_manager'];
       
        $practice_manager = Auth::user()->keyContacts()->where('title','practice_manager')->first();
        $practice_manager->name     =   $practiceM['name'];
        $practice_manager->phone    =   $practiceM['phone'];
        $practice_manager->email    =   $practiceM['email'];
        $practice_manager->save();

       // unset($data['keycontacts']['practice_manager']);

        $billingC  =   $data['keycontacts']['billing_contact'];

        $billing_contact           =   Auth::user()->keyContacts()->where('title','billing_contact')->first();
        
        $billing_contact->name     =   $billingC['name'];
        $billing_contact->phone    =   $billingC['phone'];
        $billing_contact->email    =   $billingC['email'];
        $billing_contact->save();

       // unset($data['keycontacts']['billingC']);
        if(isset($data['keycontacts']['others'])):
            $keycontacts = $data['keycontacts']['others'];
            foreach ($keycontacts as $key => $value) {
                if($value['keyid']!=0)
                    $others           =   KeyContacts::find($value['keyid']) ;
                else
                    $others           =  New KeyContacts; 
                
                $others->title    =   $value['title'];
                $others->user_id  =   $user->id;
                $others->name     =   $value['name'];
                $others->phone    =   $value['phone'];
                $others->email    =   $value['email'];
                $others->save();

                
            }
        endif;
        return redirect(url('profile'));
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

    public function updateInfo(UpdatePractice $request){
        $user               =       Auth::user();
        $user->sender_id    =       $request->sender_id;
        $user->save();
    }
}
