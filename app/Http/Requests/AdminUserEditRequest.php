<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserEditRequest extends FormRequest
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
            'first_name'        => 'required',
            'last_name'         => 'required',
            'mobile'            => 'required',
            'job_title'         => 'required',
            
            'password'          => 'nullable|string|min:6|confirmed',
            'status'            => 'required',
            'email'             => 'required|unique:admins,email,'.$this->user->id,
            'permissions'       =>  'required',
            'password_confirmation'   => 'required_with:password|same:password',
        ];
    }
}
