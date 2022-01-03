<?php

namespace App\Http\Requests\Client;

use App\Rules\CheckEmail;
use App\Rules\CheckMobileNo;
use App\Rules\Lead\CheckEmail as LeadCheckEmail;
use App\Rules\Lead\CheckMobileNo as LeadCheckMobileNo;
use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
            'account_type' => ['required'],
            'associate_id' => ['required_if:user_associate,0'],
            'employee_id' => ['required_if:has_employee,1'],
            'first_name' => ['required_if:account_type,1'],
            'last_name' => ['required_if:account_type,1'],
            'gender' => ['required_if:account_type,1'],
            'cname' => ['required_if:account_type,2'],
            'cauthname1' => ['required_if:account_type,2'],
            'cauthdesignation1' => ['required_if:account_type,2'],
            'mobile' => ['required', new CheckMobileNo('','',''), new LeadCheckMobileNo($this->id)],
            'email' => ['required', new CheckEmail('','',''), new LeadCheckEmail($this->id)],
            'address1' => ['required'],
            'address2' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'pincode' => ['required'],
        ];
    }

    /**
     *  Display the message as per validation rules
     *
     */
    public function messages()
    {
        return [
            'account_type.required' => 'Select Account Type',
            'associate_id.required_if' => 'Select Accociate',
            'employee_id.required_if' => 'Select Employee',
            'first_name.required_if' => 'Enter first name',
            'last_name.required_if' => 'Enter last name',
            'gender.required_if' => 'Select gender',
            'cname.required_if' => 'Enter Company name',
            'cauthname1.required_if' => 'Enter Authorised name',
            'cauthdesignation1.required_if' => 'Enter Designation',
            'mobile.required' => 'Enter mobile no',
            'email.required' => 'Enter email address',
            'address1.required' => 'Enter Address',
            'address2.required' => 'Enter Address',
            'city.required' => 'Enter City',
            'state.required' => 'Select State',
            'country.required' => 'Select Country',
            'pincode.required' => 'Select Pincode',
        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         dd($validator->errors());
    //         // if ($this->somethingElseIsInvalid()) {

    //         //     $validator->errors()->add('field', 'Something is wrong with this field!');
    //         // }
    //     });
    // }
}
