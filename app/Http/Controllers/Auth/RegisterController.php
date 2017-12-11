<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\Mail\WelcomeMail;
use App\User;
use App\KeyContacts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
                        'keycontacts.practice_manager.phone.digits_between' => 'The phone must be between 10 and 12 digits',
                        'keycontacts.practice_manager.phone.required' => 'The phone field is required',
                        'keycontacts.practice_manager.email.email' => 'The email must be a valid email address.',
                        'keycontacts.practice_manager.email.required'=>'The email field is required.',
                        
                        'keycontacts.billing_contact.phone.digits_between' => 'The phone must be between 10 and 12 digits',
                        'keycontacts.billing_contact.phone.required' => 'The phone field is required',
                        'keycontacts.billing_contact.email.required'=>'The email field is required.',
                        'keycontacts.billing_contact.email.email' => 'The email must be a valid email address.',
                    ];
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'company' => 'required|string|max:255',
            'phone' => 'required|numeric|phone:AUTO',
            'practice_type' => 'required',
            'keycontacts.practice_manager.name' => 'required|string|max:255',
            'keycontacts.practice_manager.phone' => 'required|numeric|phone:AUTO',
            'keycontacts.practice_manager.email' => 'required|string|email|max:255',
            'keycontacts.billing_contact.name' => 'required|string|max:255',
            'keycontacts.billing_contact.phone' => 'required|numeric|phone:AUTO',
            'keycontacts.billing_contact.email' => 'required|string|email|max:255',
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            
        ]);
        $user->company  = $data['company'];
        $user->address  = $data['address'];
        $user->contact    = $data['phone'];
        $user->practice_id    = implode(',', $data['practice_type']);
        $user->save();
        $practiceM  =   $data['keycontacts']['practice_manager'];
       
        $practice_manager = New KeyContacts;
        $practice_manager->user_id = $user->id;
        $practice_manager->title = 'practice_manager';
        $practice_manager->is_fixed = 1;
        $practice_manager->name     =   $practiceM['name'];
        $practice_manager->phone    =   $practiceM['phone'];
        $practice_manager->email    =   $practiceM['email'];
        $practice_manager->save();

        unset($data['keycontacts']['practice_manager']);

        $billingC  =   $data['keycontacts']['billing_contact'];

        $billing_contact           =   New KeyContacts;
        $billing_contact->user_id  =   $user->id;
        $billing_contact->title    =   'billing_contact';
        $billing_contact->is_fixed =   1;
        $billing_contact->name     =   $billingC['name'];
        $billing_contact->phone    =   $billingC['phone'];
        $billing_contact->email    =   $billingC['email'];
        $billing_contact->save();

        unset($data['keycontacts']['billingC']);
        if(isset($data['keycontacts']['others'])):
            $keycontacts = $data['keycontacts']['others'];
            foreach ($keycontacts as $key => $value) {

                $others           =   New KeyContacts;
                $others->user_id  =   $user->id;
                $others->title    =   $value['title'];
                
                $others->name     =   $value['name'];
                $others->phone    =   $value['phone'];
                $others->email    =   $value['email'];
                $others->save();

                
            }
        endif;
        Mail::to($data['email'])->send(new WelcomeMail($user));
        return $user;
    }
}
