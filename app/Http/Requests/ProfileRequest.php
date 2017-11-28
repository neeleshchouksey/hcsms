<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            
            'company' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,12',
            'practice_type' => 'required',
            'keycontacts.practice_manager.name' => 'required|string|max:255',
            'keycontacts.practice_manager.phone' => 'required|digits_between:10,12',
            'keycontacts.practice_manager.email' => 'required|string|email|max:255',
            'keycontacts.billing_contact.name' => 'required|string|max:255',
            'keycontacts.billing_contact.phone' => 'required|digits_between:10,12',
            'keycontacts.billing_contact.email' => 'required|string|email|max:255',
        ];
    }
    public function messages()
    {
        return [
            'keycontacts.practice_manager.phone.digits_between' => 'The phone must be between 10 and 12 digits',
            'keycontacts.practice_manager.phone.reaquired' => 'The phone field is required',
            'keycontacts.practice_manager.email.email' => 'The email must be a valid email address.',
            'keycontacts.practice_manager.email.required'=>'The email field is required.',
            
            'keycontacts.billing_contact.phone.digits_between' => 'The phone must be between 10 and 12 digits',
            'keycontacts.billing_contact.phone.reaquired' => 'The phone field is required',
            'keycontacts.billing_contact.email.required'=>'The email field is required.',
            'keycontacts.billing_contact.email.email' => 'The email must be a valid email address.',
        ];
    }
}
