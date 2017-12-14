<?php

namespace App\Http\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminProfile extends FormRequest
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
            'name'              => 'required|unique:admins,name,'.Auth::guard('admin')->user()->id,
            'email'             => 'required|unique:admins,email,'.Auth::guard('admin')->user()->id,
            'confirmpassword'   =>  'required_with:newpassword|same:newpassword',
            

           
        ];
    }
    public function messages(){
        return [
         'oldpassword.old_password' => 'Old Password Not Matched!'
        ];
    }
}
