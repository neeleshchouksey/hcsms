<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientEditRequest extends FormRequest
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
           
            'code' => 'required|string|max:255|unique:patients,ref_code,'.$this->patient->id,
            'name' => 'required|string|max:255',
            
            
            'mobile' => 'required|numeric|phone:AUTO',
            //'service' => 'required',
            
       
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Patient Reference field is required',
            'code.max'      => 'The Patient Reference may not be greater than 255 characters.',
            'code.unique' => 'The Patient Reference has already been taken..',
           
        ];
    }
}
