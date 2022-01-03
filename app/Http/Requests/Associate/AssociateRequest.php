<?php

namespace App\Http\Requests\Associate;

use App\Rules\CalculateAge;
use App\Rules\CheckEmail;
use App\Rules\checkGST;
use App\Rules\CheckMobileNo;
use App\Rules\CheckPanNo;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\MarketService;
use Illuminate\Validation\Rule;

class AssociateRequest extends FormRequest
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
        if($this->step == 1)
        {
            return [
                'introducer_id' => ['required'],
                'employee_id' => ['required_if:has_employee,1'],
                'profession_id' => ['required'],
                'business_tag' => ['required'],
            ];

        }
        elseif($this->step == 2){
            return [
                'entitytype_id' => ['required'],
                'entity_name' => ['required_if:entitytype_id,1,2,3',],
                'authorised_person1' => ['required_if:entitytype_id,1,2,3,4'],
                'authorised_email1' => ['sometimes','required_if:entitytype_id,1,2,3,4','nullable','email',new CheckEmail($this->pan_no,$this->associate_id,$this->employee_id)],
                'authorised_person2' => ['required_if:entitytype_id,2,3'],
                'authorised_email2' => ['sometimes','required_if:entitytype_id,2,3','nullable','email',new CheckEmail($this->pan_no,$this->associate_id,$this->employee_id)],
            ];
        }
        elseif($this->step == 3){
            return [
            'name' => ['required'],
            'photo_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
            'pan_no' => ['required', 'regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/', new CheckPanNo($this->associate_id,'')],
            'pan_upload' => ['bail', 'nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
            'aadhar_no' => ['bail','required_if:entitytype_id,1,4','nullable','numeric','regex:/^([0-9]){12}?$/'],
            'aadhar_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
            'birth_incorp_date' => ['bail','required','date','before:today', new CalculateAge($this->entitytype_id)],
            ];
        }
        elseif($this->step == 4){
            return [
                'address1' => ['required','max:40'],
                'address2' => ['required','max:40'],
                'city' => ['required'],
                'state' => ['required'],
                'country' => ['required'],
                'pincode' => ['required','nullable','numeric'],
                'address_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'mobile' => ['bail','required','nullable','numeric','regex:/^[6-9]\d{9}$/', new CheckMobileNo($this->pan_no,$this->associate_id,$this->employee_id)],
                'email' => ['bail','required','nullable','email', new CheckEmail($this->pan_no,$this->associate_id,$this->employee_id)],
            ];
        }
        elseif($this->step == 5){
            return [
                'ifsc_no' => ['required'],
                'cheque_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'bank_name' => ['required'],
                'branch_name' => ['required'],
                'micr' => ['required'],
                'account_type' => ['required'],
                'account_no' => ['required','numeric'],
                'mfd_ria_ifsc_no' => ['required_if:profession_id,3'],
                'mfd_ria_cheque_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'mfd_ria_bank_name' => ['required_if:profession_id,3'],
                'mfd_ria_branch_name' => ['required_if:profession_id,3'],
                'mfd_ria_micr' => ['required_if:profession_id,3'],
                'mfd_ria_account_type' => ['required_if:profession_id,3'],
                'mfd_ria_account_no' => ['required_if:profession_id,3','nullable','numeric'],
            ];
        }
        elseif($this->step == 6){
            return [
                //GST
                //'gst_no' => ['bail','nullable','regex:/^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([1-9a-zA-Z]){1}Z([1-9a-zA-Z]){1}?$/'],
                'gst_no' => ['bail','nullable', new checkGST($this->pan_no)],
                'gst_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'logo_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'gst_validity' => ['bail', 'nullable', 'after:today'],
                //Shop & Establishment Details
                'shop_est_no' => ['required_if:entitytype_id,1'],
                'shop_est_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'shop_est_validity' => ['bail','nullable','required_if:entitytype_id,1','after:today'],
                //PARTNERSHIP FIRM Details
                'pd_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'pd_asl_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'pd_coi_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                //CORPORATE Details
                'co_moa_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'co_aoa_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'co_coi_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'co_asl_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'co_br_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
            ];
        }
        elseif($this->step == 7){
            return [
            //AMFI Details
            'arn_name' => ['required_if:profession_id,1,3'],
            'arn_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
            'arn_rgn_no' => ['required_if:profession_id,1,3'],
            'arn_validity' => ['bail','nullable','required_if:profession_id,1,3','after:today'],
            //EUIN
            'euin_name' => ['required_if:profession_id,1,3'],
            'euin_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
            'euin_no' => ['required_if:profession_id,1,3'],
            'euin_validity' => ['bail','nullable','required_if:profession_id,1,3','after:today'],
            //SEBI RIA Details
            'ria_name' => ['required_if:profession_id,2,3'],
            'ria_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
            'ria_rgn_no' => ['required_if:profession_id,2,3'],
            'ria_validity' => ['bail','nullable','required_if:profession_id,2,3','after:today'],
            ];
        }
        elseif($this->step == 8){

            if($this->profession_id == 1)
            {
                if($this->entitytype_id == 4)
                {
                    return [
                        'nism_va_no' => ['required'],
                        'nism_va_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                        'nism_va_validity' => ['bail','nullable','required','after:today'],
                    ];
                }else{
                    return [
                        'pan_no' => ['required'],
                    ];
                }
            }
            elseif($this->profession_id == 2)
            {
                if($this->entitytype_id == 4)
                {
                    return [
                        'ria_certificate_type' => ['required'],
                        'ria_type_nism' => ['numeric'],
                        'ria_type_cfp' => ['numeric'],
                        'ria_type_cwm' => ['numeric'],
                        'nism_xa_no' => ['required_if:ria_type_nism,1'],
                        'nism_xa_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                        'nism_xa_validity' => ['bail','nullable','required_if:ria_type_nism,1','after:today'],
                        'nism_xb_no' => ['required_if:ria_type_nism,1'],
                        'nism_xb_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                        'nism_xb_validity' => ['bail','nullable','required_if:ria_type_nism,1','after:today'],
                        'cfp_no' => ['required_if:ria_type_cfp,1'],
                        'cfp_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                        'cfp_validity' => ['bail','nullable','required_if:ria_type_cfp,1','after:today'],
                        'cwm_no' => ['required_if:ria_type_cwm,1'],
                        'cwm_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                        'cwm_validity' => ['bail','nullable','required_if:ria_type_cwm,1','after:today'],
                    ];
                }else{
                    return [
                        'pan_no' => ['required'],
                    ];
                }

            }elseif($this->profession_id == 3)
            {
                return [
                    'pan_no' => ['required'],
                ];

            }elseif($this->profession_id == 4)
            {
                return [
                    'ca_no' => ['required'],
                    'ca_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                    'ca_validity' => ['bail','nullable','after:today'],
                ];
            }elseif($this->profession_id == 5)
            {
                return [
                    'cs_no' => ['required'],
                    'cs_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                    'cs_validity' => ['bail','nullable','after:today'],
                ];
            }elseif($this->profession_id == 6)
            {
                return [
                    'course_name' => ['required'],
                    'course_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                    'course_no' => ['required'],
                    'course_validity' => ['bail','nullable','after:today'],
                ];
            }

        }
        elseif($this->step == 9){
            return [
                'nominee_name' => ['required'],
                'nominee_birth_date' => ['bail','nullable','date','before:today'],
                'nominee_address1' => ['required','max:50'],
                'nominee_address2' => ['required','max:50'],
                'nominee_city' => ['required'],
                'nominee_state' => ['required'],
                'nominee_country' => ['required'],
                'nominee_pincode' => ['required','nullable','numeric'],
                'nominee_mobile' => ['bail','nullable','numeric','regex:/^[6-9]\d{9}$/', new CheckMobileNo($this->pan_no,$this->associate_id,$this->employee_id)],
                'nominee_email' => ['bail','nullable','email', new CheckEmail($this->pan_no,$this->associate_id,$this->employee_id)],
            ];
        }
        elseif($this->step == 10){
            return [
                'guardian_name' => ['required'],
                'guardian_pan_no' => ['required', 'regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/', new CheckPanNo($this->associate_id,$this->employee_id)],
                'guardian_pan_upload' => ['bail','nullable','mimes:jpeg,png,jpg,bmp,pdf,gif','max:500'],
                'guardian_nominee_relation' => ['required'],
                'guardian_address1' => ['required','max:50'],
                'guardian_address2' => ['required','max:50'],
                'guardian_city' => ['required'],
                'guardian_state' => ['required'],
                'guardian_country' => ['required'],
                'guardian_pincode' => ['required','nullable','numeric'],
                'guardian_mobile' => ['bail','required','nullable','numeric','regex:/^[6-9]\d{9}$/'],//, new CheckMobileNo($this->pan_no,$this->associate_id,$this->employee_id)
                'guardian_email' => ['bail','required','nullable','email'],//,new CheckEmail($this->pan_no,$this->associate_id,$this->employee_id)
            ];
        }
        elseif($this->step == 11){
            $marketService = resolve(MarketService::class);
            $commercials = $marketService->getCommercials();
            $commercialtypes = $marketService->getCommercialTypes();
            $validator = [];
            foreach($commercials as $commercial)
            {
                foreach($commercialtypes as $commercialtype)
                {
                    if($commercialtype->field_name == 'bps'){$val = 'perc';}
                    if($commercialtype->field_name == 'perc'){$val = 'bps';}

                    $validator[$commercial->field_name.'_'.$commercialtype->field_name] = ['required_without:'.$commercial->field_name.'_'.$val];
                }
            }
            //$validator["userstatus"] = ['required_if:status,2'];
            $validator["reject_reason"] = ['required_if:userstatus,1'];
            //dd($validator);
            return $validator;
        }
        elseif($this->step == 12){
            return [
            'bse_upload' => ['required'],
            ];
        }

    }

    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        //Step1
        if($this->step == 1)
        {
            return [

                'introducer_id.required' => 'Select Introducer name',
                'employee_id.required_if' => 'Select Employer name',
                'profession_id.required' => 'Select Profession',
                'business_tag.required' => 'Select business tag',
            ];
        }
        //Step2
        elseif($this->step == 2)
        {
            return [
                'entitytype_id.required' => 'Select Entity Type',
                'entity_name.required_if' => 'Enter Entity Name',
                'authorised_person1.required_if' => 'Enter Authorised Person Name',
                'authorised_email1.required_if' => 'Enter Authorised Person Email',
                'authorised_email1.email' => 'Enter Valid email address',
                'authorised_person2.required_if' => 'Enter Second Authorised Person Name',
                'authorised_email2.required_if' => 'Enter Second Authorised Person Email',
                'authorised_email2.email' => 'Enter Valid email address',
            ];
        }
        //step3
        elseif($this->step == 3)
        {
            return [

                'name.required_if' => 'Enter Name',
                'photo_upload.required' => 'Upload Photo',
                'photo_upload.mimes' => 'Not a Proper Format',
                'photo_upload.max' => 'Max Size 500kb',
                'pan_no.required' => 'Enter Pan Card No',
                'pan_no.regex' => 'Enter valid Pan Card No',
                'pan_upload.required' => 'Upload Pancard',
                'pan_upload.mimes' => 'Not a Proper Format',
                'pan_upload.max' => 'Max Size 500kb',
                'aadhar_no.required_if' => 'Enter Aadhar Card No',
                'aadhar_no.numeric' => 'Enter only numeric value',
                'aadhar_no.regex' => 'Enter Valid Aadhar Card No',
                'aadhar_upload.required' => 'Upload Aadhar Card',
                'aadhar_upload.mimes' => 'Not a Proper Format',
                'aadhar_upload.max' => 'Max Size 500kb',
                'birth_incorp_date.required' => 'Select Date',
                'birth_incorp_date.before' => 'Date must be less than current date'
            ];
        }
        //step4
        elseif($this->step == 4)
        {
            return [

                'address1.required' => 'Enter Address Details',
                'address2.required' => 'Enter Address Details',
                'city.required' => 'Enter City Name',
                'state.required' => 'Select State',
                'country.required' => 'Select Country',
                'pincode.required' => 'Enter Pincode',
                'pincode.numeric' => 'Enter only numeric value',
                'address_upload.required' => 'Upload Address',
                'address_upload.mimes' => 'Not a Proper Format',
                'address_upload.max' => 'Max Size 500kb',
                'mobile.required' => 'Enter Mobile No',
                'mobile.numeric' => 'Enter only numeric value',
                'mobile.regex' => 'Enter valid mobile no',
                'email.required' => 'Enter Email Address',
                'email.email' => 'Enter Valid email address',
            ];
        }
        //step5
        elseif($this->step == 5)
        {
            return [

                'ifsc_no.required' => 'Enter IFSC code',
                'cheque_upload.required' => 'Upload Cheque',
                'cheque_upload.mimes' => 'Not a Proper Format',
                'cheque_upload.max' => 'Max Size 500kb',
                'bank_name.required' => 'Enter Bank name',
                'branch_name.required' => 'Enter Bank Branch Name',
                'micr.required' => 'Enter MICR',
                'account_type.required' => 'Select Account Type',
                'account_no.required' => 'Enter Account No',
                'account_no.numeric' => 'Account No must be in Numeric',
                'mfd_ria_ifsc_no.required_if' => 'Enter IFSC code',
                'mfd_ria_cheque_upload.required' => 'Upload Cheque',
                'mfd_ria_cheque_upload.mimes' => 'Not a Proper Format',
                'mfd_ria_cheque_upload.max' => 'Max Size 500kb',
                'mfd_ria_bank_name.required_if' => 'Enter Bank name',
                'mfd_ria_branch_name.required_if' => 'Enter Bank Branch Name',
                'mfd_ria_micr.required_if' => 'Enter MICR',
                'mfd_ria_account_type.required_if' => 'Select Account Type',
                'mfd_ria_account_no.required_if' => 'Enter Account No',
                'mfd_ria_account_no.numeric' => 'Account No must be in Numeric',
            ];
        }
        //step6
        elseif($this->step == 6)
        {
            return [
                //GST
                'gst_no.regex' => 'Enter Proper format',
                'gst_upload.required' => 'Upload Proof',
                'gst_upload.mimes' => 'Not a Proper Format',
                'gst_upload.max' => 'Max Size 500kb',
                'gst_validity.after' => 'Date must be greater then today',
                'logo_upload.mimes' => 'Not a Proper Format',
                'logo_upload.max' => 'Max Size 500kb',

                //Shop & Establishment Details
                'shop_est_no.required_if' => 'Enter Certificate No',
                'shop_est_upload.required' => 'Upload Certificate',
                'shop_est_upload.mimes' => 'Not a Proper Format',
                'shop_est_upload.max' => 'Max Size 500kb',
                'shop_est_validity.required_if' => 'Enter Validity Date',
                'shop_est_validity.after' => 'Date must be greater then today',
                //PARTNERSHIP FIRM Details
                'pd_upload.required' => 'Upload Partnership deed',
                'pd_upload.mimes' => 'Not a Proper Format',
                'pd_upload.max' => 'Max Size 500kb',
                'pd_asl_upload.required' => 'Upload Signatorylist',
                'pd_asl_upload.mimes' => 'Not a Proper Format',
                'pd_asl_upload.max' => 'Max Size 500kb',
                'pd_coi_upload.required' => 'Enter Certificate',
                'pd_coi_upload.mimes' => 'Not a Proper Format',
                'pd_coi_upload.max' => 'Max Size 500kb',
                //CORPORATE Details
                'co_moa_upload.required' => 'Upload Proof',
                'co_moa_upload.mimes' => 'Not a Proper Format',
                'co_moa_upload.max' => 'Max Size 500kb',
                'co_aoa_upload.required' => 'Upload Proof',
                'co_aoa_upload.mimes' => 'Not a Proper Format',
                'co_aoa_upload.max' => 'Max Size 500kb',
                'co_coi_upload.required' => 'Upload Proof',
                'co_coi_upload.mimes' => 'Not a Proper Format',
                'co_coi_upload.max' => 'Max Size 500kb',
                'co_asl_upload.required' => 'Upload Proof',
                'co_asl_upload.mimes' => 'Not a Proper Format',
                'co_asl_upload.max' => 'Max Size 500kb',
                'co_br_upload.required' => 'Upload Proof',
                'co_br_upload.mimes' => 'Not a Proper Format',
                'co_br_upload.max' => 'Max Size 500kb',
            ];
        }
        elseif($this->step == 7)
        {
            return [
                //step7
                //AMFI Details
                'arn_name.required_if' => 'Enter Name',
                'arn_upload.required' => 'Upload Copy',
                'arn_upload.mimes' => 'Not a Proper Format',
                'arn_upload.max' => 'Max Size 500kb',
                'arn_rgn_no.required_if' => 'Enter Registration No',
                'arn_validity.required_if' => 'Select Validity',
                'arn_validity.after' => 'Date must be greater then today',
                //EUIN
                'euin_name.required_if' => 'Enter Name',
                'euin_upload.required' => 'Upload Proof',
                'euin_upload.mimes' => 'Not a Proper Format',
                'euin_upload.max' => 'Max Size 500kb',
                'euin_no.required_if' => 'Enter EUIN No',
                'euin_validity.required_if' => 'Select Validity',
                'euin_validity.after' => 'Date must be greater then today',
                //SEBI RIA Details
                'ria_name.required_if' => 'Enter Name',
                'ria_upload.required' => 'Upload Proof',
                'ria_upload.mimes' => 'Not a Proper Format',
                'ria_upload.max' => 'Max Size 500kb',
                'ria_rgn_no.required_if' => 'Enter Registration No',
                'ria_validity.required_if' => 'Select Validity',
                'ria_validity.after' => 'Date must be greater then today',
            ];
        }
        elseif($this->step == 8)
        {
            if($this->profession_id == 1)
            {
                if($this->entitytype_id == 4)
                {
                    return [
                        'nism_va_no.required' => 'Enter Certificate No',
                        'nism_va_upload.required' => 'Upload Certificate',
                        'nism_va_upload.mimes' => 'Not a Proper Format',
                        'nism_va_upload.max' => 'Max Size 500kb',
                        'nism_va_validity.required' => 'Enter Certificate Validity',
                        'nism_va_validity.after' => 'Date must be greater then today',
                    ];
                }else{
                    return [
                        'pan_no.required' => 'Enter Pan NO',
                    ];
                }
            }
            elseif($this->profession_id == 2)
            {
                if($this->entitytype_id == 4)
                {
                    return [
                        'ria_certificate_type.required' => 'Select RIA Type',
                        'nism_xa_no.required_if' => 'Enter Certificate No',
                        'nism_xa_upload.required' => 'Upload Certificate',
                        'nism_xa_upload.mimes' => 'Not a Proper Format',
                        'nism_xa_upload.max' => 'Max Size 500kb',
                        'nism_xa_validity.required_if' => 'Enter Certificate Validity',
                        'nism_xa_validity.after' => 'Date must be greater then today',
                        'nism_xb_no.required_if' => 'Enter Certificate No',
                        'nism_xb_upload.required' => 'Upload Certificate',
                        'nism_xb_upload.mimes' => 'Not a Proper Format',
                        'nism_xb_upload.max' => 'Max Size 500kb',
                        'nism_xb_validity.required_if' => 'Enter Certificate Validity',
                        'nism_xb_validity.after' => 'Date must be greater then today',
                        'cfp_no.required_if' => 'Enter Certificate No',
                        'cfp_upload.required' => 'Upload Certificate',
                        'cfp_upload.mimes' => 'Not a Proper Format',
                        'cfp_upload.max' => 'Max Size 500kb',
                        'cfp_validity.required_if' => 'Enter Certificate Validity',
                        'cfp_validity.after' => 'Date must be greater then today',
                        'cwm_no.required_if' => 'Enter Certificate No',
                        'cwm_upload.required' => 'Upload Certificate',
                        'cwm_upload.mimes' => 'Not a Proper Format',
                        'cwm_upload.max' => 'Max Size 500kb',
                        'cwm_validity.required_if' => 'Enter Certificate Validity',
                        'cwm_validity.after' => 'Date must be greater then today',
                    ];
                }
                else{
                    return [
                        'pan_no.required' => 'Enter Pan NO',
                    ];
                }
            }
            elseif($this->profession_id == 3)
            {
                return [
                    'pan_no.required' => 'Enter Pan NO',
                ];
            }
            elseif($this->profession_id == 4)
            {
                return [
                    'ca_no.required' => 'Enter Certificate No',
                    'ca_upload.required' => 'Upload Certificate',
                    'ca_upload.mimes' => 'Not a Proper Format',
                    'ca_upload.max' => 'Max Size 500kb',
                    'ca_validity.required' =>'Enter Certificate Validity',
                    'ca_validity.after' => 'Date must be greater then today',
                ];
            }
            elseif($this->profession_id == 5)
            {
                return [
                    'cs_no.required' => 'Enter Certificate No',
                    'cs_upload.required' => 'Upload Certificate',
                    'cs_upload.mimes' => 'Not a Proper Format',
                    'cs_upload.max' => 'Max Size 500kb',
                    'cs_validity.required' => 'Enter Certificate Validity',
                    'cs_validity.after' => 'Date must be greater then today',
                ];
            }
            elseif($this->profession_id == 6)
            {
                return [
                    'course_name.required' => 'Enter Course Name',
                    'course_upload.required' => 'Upload Certificate',
                    'course_upload.mimes' => 'Not a Proper Format',
                    'course_upload.max' => 'Max Size 500kb',
                    'course_no.required' => 'Enter Certificate No',
                    'course_validity.required' => 'Enter Certificate Validity',
                    'course_validity.after' => 'Date must be greater then today',
                ];
            }
        }
        //step 9
        elseif($this->step == 9)
        {
            return [

                'nominee_name.required' => 'Enter Full Name',
                'nominee_birth_date.before' => 'Date must be less than current date',
                'nominee_address1.required' => 'Enter Address Details',
                'nominee_address2.required' => 'Enter Address Details',
                'nominee_city.required' => 'Enter City Name',
                'nominee_state.required' => 'Select State',
                'nominee_country.required' => 'Select Country',
                'nominee_pincode.required' => 'Enter Pincode',
                'nominee_pincode.numeric' => 'Enter only numeric value',
                'nominee_mobile.numeric' => 'Enter only numeric value',
                'nominee_mobile.regex' => 'Enter valid mobile no',
                'nominee_email.email' => 'Enter Valid email address',
            ];
        }
        //step10
        elseif($this->step == 10)
        {
            return [

                'guardian_name.required' => 'Enter Full Name',
                'guardian_pan_no.required' => 'Enter Pancard No',
                'guardian_pan_upload.required' => 'Upload Proof',
                'guardian_pan_upload.mimes' => 'Not a Proper Format',
                'guardian_pan_upload.max' => 'Max Size 500kb',
                'guardian_nominee_relation.required' => 'Select Relationship',
                'guardian_address1.required' => 'Enter Address Details',
                'guardian_address2.required' => 'Enter Address Details',
                'guardian_city.required' => 'Enter City Name',
                'guardian_state.required' => 'Select State',
                'guardian_country.required' => 'Select Country',
                'guardian_pincode.required' => 'Enter Pincode',
                'guardian_pincode.numeric' => 'Enter only numeric value',
                'guardian_mobile.required' => 'Enter Mobile No',
                'guardian_mobile.numeric' => 'Enter only numeric value',
                'guardian_mobile.regex' => 'Enter valid mobile no',
                'guardian_email.required' => 'Enter Email Address',
                'guardian_email.email' => 'Enter Valid email address',
            ];
        }
        //step11
        elseif($this->step == 11)
        {
            $marketService = resolve(MarketService::class);
            $commercials = $marketService->getCommercials();
            $commercialtypes = $marketService->getCommercialTypes();
            $array = [];

            foreach($commercials as $commercial)
            {
                foreach($commercialtypes as $commercialtype)
                {
                    if($commercialtype->field_name == 'bps'){$val = 'perc';}
                    if($commercialtype->field_name == 'perc'){$val = 'bps';}

                    $array[$commercial->field_name.'_'.$commercialtype->field_name.'.required_without'] = 'Enter Value';
                }
            }

            //$array['userstatus.required_if'] = 'Please select status';
            $array['reject_reason.required_if'] = 'Please provide reason to reject';
            return $array;
        }elseif($this->step == 12){
            return [
            'bse_upload.required' => 'Please upload a file to BSE',
            ];
        }else{
            return [
                'pan_no.required' => 'Enter Pan NO',
            ];
        }

    }

    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('photo_upload', 'required', function($input) {
            return $input->entitytype_id == 4 && $input->associate_edit == 0 && $input->step == 3;
        });
        $validator->sometimes('pan_upload', 'required', function($input) {
            return $input->associate_edit == 0  && $input->step == 3;
        });
        $validator->sometimes('aadhar_upload', 'required', function($input) {
            return ($input->entitytype_id == 1 || $input->entitytype_id == 4) && $input->associate_edit == 0  && $input->step == 3;
        });
        $validator->sometimes('address_upload', 'required', function($input) {
            return $input->step == 4 && $input->is_address_upload == 0;
        });
        $validator->sometimes('cheque_upload', 'required', function($input) {
            return $input->step == 5 && $input->is_cheque_upload == 0;
        });
        $validator->sometimes('mfd_ria_cheque_upload', 'required', function($input) {
            return $input->profession_id == 3 && $input->is_mfd_ria_cheque_upload == 0  && $input->step == 5;
        });
        $validator->sometimes('gst_upload', 'required', function($input) {
            return $input->gst_no != null && $input->step == 6 && $input->is_gst_upload == 0;
        });
        // $validator->sometimes('logo_upload', 'required', function($input) {
        //     return $input->associate_edit == 0  && $input->step == 6;
        // });
        $validator->sometimes('shop_est_upload', 'required', function($input) {
            return $input->entitytype_id == 1 && $input->is_shop_est_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('pd_upload', 'required', function($input) {
            return $input->entitytype_id == 2 && $input->is_pd_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('pd_asl_upload', 'required', function($input) {
            return $input->entitytype_id == 2 && $input->is_pd_asl_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('pd_coi_upload', 'required', function($input) {
            return $input->entitytype_id == 2 && $input->is_pd_coi_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('co_moa_upload', 'required', function($input) {
            return $input->entitytype_id == 3 && $input->is_co_moa_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('co_aoa_upload', 'required', function($input) {
            return $input->entitytype_id == 3 && $input->is_co_aoa_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('co_coi_upload', 'required', function($input) {
            return $input->entitytype_id == 3 && $input->is_co_coi_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('co_asl_upload', 'required', function($input) {
            return $input->entitytype_id == 3 && $input->is_co_asl_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('co_br_upload', 'required', function($input) {
            return $input->entitytype_id == 3 && $input->is_co_br_upload == 0  && $input->step == 6;
        });
        $validator->sometimes('arn_upload', 'required', function($input) {
            return ($input->profession_id == 1 || $input->profession_id == 3) && $input->is_arn_upload == 0  && $input->step == 7;
        });
        $validator->sometimes('euin_upload', 'required', function($input) {
            return ($input->profession_id == 1 || $input->profession_id == 3) && $input->is_euin_upload == 0  && $input->step == 7;
        });
        $validator->sometimes('ria_upload', 'required', function($input) {
            return ($input->profession_id == 2 || $input->profession_id == 3) && $input->is_ria_upload == 0  && $input->step == 7;
        });
        $validator->sometimes('nism_va_upload', 'required', function($input) {
            return $input->nism_va_no != null && $input->is_nism_va_upload == 0  && $input->step == 8;
        });
        $validator->sometimes('nism_xa_upload', 'required', function($input) {
            return $input->ria_type_nism == 1 && $input->is_nism_xa_upload == 0  && $input->step == 8;
        });
        $validator->sometimes('nism_xb_upload', 'required', function($input) {
            return $input->ria_type_nism == 1 && $input->is_nism_xb_upload == 0  && $input->step == 8;
        });
        $validator->sometimes('cfp_upload', 'required', function($input) {
            return $input->ria_type_cfp == 1 && $input->is_cfp_upload == 0  && $input->step == 8;
        });
        $validator->sometimes('cwm_upload', 'required', function($input) {
            return $input->ria_type_cwm == 1 && $input->is_cwm_upload == 0  && $input->step == 8;
        });
        $validator->sometimes('ca_upload', 'required', function($input) {
            return $input->ca_no != null && $input->is_ca_upload == 0  && $input->step == 8;
        });
        $validator->sometimes('cs_upload', 'required', function($input) {
            return $input->cs_no != null && $input->is_cs_upload == 0  && $input->step == 8;
        });
        $validator->sometimes('course_upload', 'required', function($input) {
            return $input->course_name != null && $input->is_course_upload == 0  && $input->step == 8;
        });
        $validator->sometimes('guardian_pan_upload', 'required', function($input) {
            return $input->is_guardian_pan_upload == 0  && $input->step == 10;
        });
        //dd($validator);
        return $validator;
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
    //         //dd($validator->errors());
    //         if ($this->somethingElseIsInvalid()) {

    //             $validator->errors()->add('field', 'Something is wrong with this field!');
    //         }
    //     });
    // }
}
