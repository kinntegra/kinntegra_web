@extends('layouts.master')

@section('style')
<style>
    div[readonly] {
        background-color: #f6f6f6;

    cursor: auto;
    pointer-events:none;
}
    div.error {
        font-size: 80%;
        font-weight: 400;
        color: #ce4b4b;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        text-transform: capitalize;
    }
    .edit-now{
        font-size: 12px;
        font-weight: 600;
        font-style: italic;
    }
    .edit-now:hover{
        cursor: pointer;
        color: #1a2b2a;
    text-decoration: underline;
    }
    label[readonly]{
    background-color: #f6f6f6;
    border: 1px solid #a3a3a3;
    cursor: auto;
    pointer-events:none;
}
    .btn-view{
        border: 1px solid #a3a3a3;
    color: #545454 !important;
    line-height: 1.7 !important;
    }
    .input-group .form-control:disabled, .input-group .form-control[readonly] {
        background-color: #e9ecef !important;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #eee;
    opacity: 1;
}
           /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.permanent,.view-item {display: none;}
/*Select2 ReadOnly Start*/
select[readonly].select2-hidden-accessible + .select2-container {
    pointer-events: none;
    touch-action: none;
}

select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
    background: #eee;
    box-shadow: none;
}

select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
    display: none;
}
.select2-container--default .select2-results__option[aria-disabled=true] {
    display: none;
}
input[readonly] {
    background-color: #eee !important;
}
/*Select2 ReadOnly End*/

    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="section-header mb-4">
        @include('partials.top')
    </div>
    <div class="card w-100">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <h3 class="card-title">
                        @if(isset($data->id))
                            Update Employee
                        @else
                            Create New Employee
                        @endif
                    </h3>
                    <div class="form-percentage">
                        <svg viewBox="0 0 36 36" class="circular-chart orange">
                            <path class="circle-bg" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="00, 100" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="percentage">0%</text>
                        </svg>
                    </div>
                    @php
                        //$isParent = isset($data->id) && isset($data->associate_nominee->is_minor) && $data->associate_nominee->is_minor == 1 ? 'isParent' : null;
                        //$val = isset($data->id) && isset($data->status) && $data->status == 8 ? 'completed ' : null;
                        //$subval = isset($data->id) && isset($data->status) && $data->status == 8 ? 'sub-active sub-completed ' : null;
                        //$val = isset($data->id) ? 'completed ' : null;
                        //$subval = isset($data->id) ? 'sub-active sub-completed ' : null;
                        $val = null;
                        $subval = null;
                        $download_view = 0;
                        $step1 = isset($data->designation_id) ? 'completed' : null;
                        $step2 = null;
                        $step2_1 = isset($data->pan_no) ? 'sub-active sub-completed' : null;
                        $step2_2 = isset($data->c_state) ? 'sub-active sub-completed' : null;
                        $step2_3 = isset($data->ifsc_no) ? 'sub-active sub-completed' : null;

                        $step3 = isset($data->pan_no) ? 'completed' : null;
                        $step4 = isset($data->c_state) ? 'completed' : null;
                        $step5 = isset($data->ifsc_no) ? 'completed' : null;

                        if($step3 == 'completed' && $step4 == 'completed' && $step5 == 'completed')
                        {
                            $step2 = 'completed';
                        }
                        if(isset($data->contact_mobile1) && !empty($data->contact_mobile1))
                        {
                            if($data->status == 1)
                            {
                                $step2 = 'completed';
                            }
                        }

                        $step6 = null;
                        if(isset($data->employee_certificate->nism_va_no) && !empty($data->employee_certificate->nism_va_no)){
                            $step6 = 'completed';
                        }else if(isset($data->employee_certificate->nism_xa_no) && !empty($data->employee_certificate->nism_xa_no)){
                            $step6 = 'completed';
                        }else if(isset($data->employee_certificate->nism_xb_no) && !empty($data->employee_certificate->nism_xb_no)){
                            $step6 = 'completed';
                        }else if(isset($data->employee_certificate->cfp_no) && !empty($data->employee_certificate->cfp_no)){
                            $step6 = 'completed';
                        }else if(isset($data->employee_certificate->cwm_no) && !empty($data->employee_certificate->cwm_no)){
                            $step6 = 'completed';
                        }else if(isset($data->employee_certificate->ca_no) && !empty($data->employee_certificate->ca_no)){
                            $step6 = 'completed';
                        }else if(isset($data->employee_certificate->cs_no) && !empty($data->employee_certificate->cs_no)){
                            $step6 = 'completed';
                        }else if(isset($data->employee_certificate->course_no) && !empty($data->employee_certificate->course_no)){
                            $step6 = 'completed';
                        }else{
                            $step6 = null;
                        }
                        if(isset($data->status) && ($data->status == 10 || $data->status == 8))
                        {
                            $step7 = isset($data->bse_upload) && $data->bse_upload == 1 ? 'completed' : null;
                        }
                        if(isset($data->status) && ($data->status == 10 || $data->status == 8) && $data->department_id == 1)
                        {
                            $download_view = 1;
                        }
                    @endphp
                    <ul class="form-lists">
                        <li data-form="general-information" class="{{ $step1 }} active">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            General Information
                        </li>
                        <li data-form="employee-detail" class="{{ $step2 }} isParent">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Employee Details
                            <ul>
                                <li class="{{ $step2_1 }} isChild" data-form="photo-detail">Photo ID Details</li>
                                <li class="{{ $step2_2 }} isChild" data-form="address-detail">Address Details</li>
                                <li class="{{ $step2_3 }} isChild" data-form="bank-detail">Bank Details</li>
                            </ul>
                        </li>
                       <li data-form="certification-detail" class="{{ $step6 }}">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Certification
                        </li>
                        @if($download_view == 1)
                        <li data-form="bse-detail" class="{{ $step7 }}">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Download
                        </li>

                        @endif
                    </ul>
                </div>
                <form class="col-lg-5 col-md-8 step-forms" enctype="multipart/form-data" id="form-information" method="POST" action="{{ route('employee.store') }}">
                    @csrf

                    <input type="hidden" name="step" value="1">
                    <input type="hidden" name="step_edit" id="step_edit" value="0">
                    <input type="hidden" name="employee_id" id="employee_id" value="{{ @$data->id }}">
                    <input type="hidden" name="profession_id" id="profession_id" value="{{ @$data->profession_id }}">
                    <input type="hidden" name="status" value="{{ isset($data->status) ? $data->status : 1 }}">
                    <input type="hidden" name="employee_edit" id="employee_edit" value="{{ isset($data->id) ? 1 : 0 }}">
                    <input type="hidden" name="department_code" id="department_code" value="{{ @$data->subdepartment_id }}">
                    <input type="hidden" name="supervisor_code" id="supervisor_code" value="{{ @$data->supervisor_id }}">
                    <section class="trial {{ $step1 }} active" id="general-information" data-step="1" autocomplete="off">
                        <h3 class="card-title"> General Information
                            @if($step1 == 'completed' && $details == 0)
                                <span class="edit-now float-right mt-1">Edit</span>
                            @endif
                        </h3>
                        <div class="row flex-column">

                            @if(Auth::user()->in_house == 1)
                            <div class="col-sm-8 associate_id">
                                <div class="form-group">
                                    <!--List of Employee for Selected Associate-->
                                    <label for="associate_id">Associate Name <span
                                            class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="associate_id"name="associate_id">
                                            <option value=""  @if(!isset($data->associate_id)) {{'disabled selected'}} @endif >Select Associate</option>
                                            @foreach ($associates as $associate)
                                                <option value="{{$associate->id}}" @if(isset($data->associate_id) && $data->associate_id == $associate->id) {{'selected'}} @endif>{{ $associate->entity_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            @else
                            <input type="hidden" name="associate_id" id="associate_id" value="{{ $user_associate->id }}">
                            @endif
                            <div class="col-sm-8 name">
                                <div class="form-group">
                                    <label for="name">Name (As per Pancard) <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="name" name="name"
                                        aria-describedby="name" value="{{ @$data->name }}">
                                </div>
                            </div>
                            <div class="col-sm-8 department_id">
                                <div class="form-group">
                                    <!--List of Employee for Selected Associate-->
                                    <label for="department_id">Department <span
                                            class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="department_id" name="department_id">
                                            <option value="" disabled selected>Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}" @if(isset($data->department_id) && $data->department_id == $department->id) {{'selected'}} @endif>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 subdepartment_id">
                                <div class="form-group">
                                    <label for="subdepartment_id">Sub Department <span
                                            class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="subdepartment_id" name="subdepartment_id">
                                            <option value="" disabled selected>Select Sub Department</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 designation_id">
                                <div class="form-group">
                                    <label for="designation_id">Grade <span
                                        class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="designation_id" name="designation_id">
                                            <option value="" disabled selected>Select Employee Grade</option>
                                            @foreach ($designations as $designation)
                                                <option value="{{$designation->id}}" @if(isset($data->designation_id) && $data->designation_id == $designation->id) {{'selected'}} @endif>{{ $designation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 supervisor_id">
                                <div class="form-group">
                                    <label for="supervisor_id">Supervised By <span
                                        class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="supervisor_id" name="supervisor_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg proceed">Proceed</button>
                    </section>
                    <section class="trial {{ $step2 }}" id="employee-detail" data-step="2" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Employee Details
                            @if($step2 == 'completed' && $details == 0)
                                <span class="edit-now float-right mt-1">Edit</span>
                            @elseif(!empty($data->mobile) && !empty($data->contact_mobile1) && !empty($data->contact_mobile2)  && $details == 0)
                                <span class="edit-now float-right mt-1">Edit</span>
                            @endif
                        </h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="card-title">Contact Details</h4>
                            </div>
                            <div class="col-sm-6 mobile">
                                <div class="form-group">
                                    <label for="mobile">Mobile Number <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control" id="mobile" value="{{ @$data->mobile }}"
                                        aria-describedby="mobile" name="mobile">
                                </div>
                            </div>
                            <div class="col-sm-6 telephone">
                                <div class="form-group">
                                    <label for="telephone">TELEPHONE NO</label>
                                    <input type="text" class="form-control" id="telephone" value="{{ @$data->telephone }}"
                                        aria-describedby="telephone" name="telephone">
                                </div>
                                <!--trim($com->comment)-->
                            </div>
                            <div class="col-sm-6 email">
                                <div class="form-group">
                                    <label for="email">EMAIL ADDRESS <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control" id="email" value="{{ @$data->email }}"
                                        aria-describedby="email" name="email">
                                </div>
                            </div>

                            <div class="col-sm-6 blood_group">
                                <div class="form-group">
                                    <label for="blood_group">Blood Group <span
                                        class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="blood_group"
                                            name="blood_group">
                                            <option value="" @if(!isset($data->blood_group)) {{'disabled selected'}} @endif>Select Blood Group</option>
                                            <option value="a+" @if(isset($data->blood_group) && $data->blood_group == 'a+') {{'selected'}} @endif>A Positive (A+)</option>
                                            <option value="a-" @if(isset($data->blood_group) && $data->blood_group == 'a-') {{'selected'}} @endif>A Negative (A-)</option>
                                            <option value="b+" @if(isset($data->blood_group) && $data->blood_group == 'b+') {{'selected'}} @endif>B Positive (B+)</option>
                                            <option value="b-" @if(isset($data->blood_group) && $data->blood_group == 'b-') {{'selected'}} @endif>B Negative (B-)</option>
                                            <option value="o+" @if(isset($data->blood_group) && $data->blood_group == 'o+') {{'selected'}} @endif>O Positive (O+)</option>
                                            <option value="o-" @if(isset($data->blood_group) && $data->blood_group == 'o-') {{'selected'}} @endif>O Negative (O-)</option>
                                            <option value="ab+" @if(isset($data->blood_group) && $data->blood_group == 'ab+') {{'selected'}} @endif>AB Positive (AB+)</option>
                                            <option value="ab-" @if(isset($data->blood_group) && $data->blood_group == 'ab-') {{'selected'}} @endif>AB Negative (AB-)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group health_issue">
                                    <label for="health_issue">Health Issue (If Any)</label>

                                    <textarea class="form-control" id="health_issue"  name="health_issue" aria-describedby="health_issue" rows="3">{{ @$data->health_issue }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="emergency_contact_1">
                            <div class="col-sm-12">
                                <h4 class="form-group">
                                    Emergency Contact 1
                                </h4>
                            </div>
                            <div class="col-sm-12 contact_name1">
                                <div class="form-group">
                                    <label for="contact_name1">Name <span class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-uppercase" id="contact_name1" name="contact_name1" value="{{ @$data->contact_name1 }}"
                                        aria-describedby="contact_name1"/>
                                </div>
                            </div>
                            <div class="col-sm-6 contact_mobile1">
                                <div class="form-group">
                                    <label for="contact_mobile1">Mobile Number <span class="required-sign">*</span></label>
                                    <input type="text" class="form-control" id="contact_mobile1" value="{{ @$data->contact_mobile1 }}"
                                        aria-describedby="contact_mobile1" name="contact_mobile1">
                                </div>
                            </div>
                            <div class="col-sm-6 contact_email1">
                                <div class="form-group">
                                    <label for="contact_email1">EMAIL ADDRESS <span class="required-sign">*</span></label>
                                    <input type="text" class="form-control" id="contact_email1" value="{{ @$data->contact_email1 }}"
                                        aria-describedby="contact_email1" name="contact_email1">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="emergency_contact_2">
                            <div class="col-sm-12">
                                <h4 class="form-group">
                                    Emergency Contact 2
                                </h4>
                            </div>
                            <div class="col-sm-12 contact_name2">
                                <div class="form-group">
                                    <label for="contact_name2">Name <span class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-uppercase" id="contact_name2" name="contact_name2" value="{{ @$data->contact_name2 }}"
                                        aria-describedby="contact_name2">
                                </div>
                            </div>
                            <div class="col-sm-6 contact_mobile2">
                                <div class="form-group">
                                    <label for="contact_mobile2">Mobile Number <span class="required-sign">*</span></label>
                                    <input type="text" class="form-control" id="contact_mobile2" value="{{ @$data->contact_mobile2 }}"
                                        aria-describedby="contact_mobile2" name="contact_mobile2">
                                </div>
                            </div>
                            <div class="col-sm-6 contact_email2">
                                <div class="form-group">
                                    <label for="contact_email2">EMAIL ADDRESS <span class="required-sign">*</span></label>
                                    <input type="text" class="form-control" id="contact_email2" value="{{ @$data->contact_email2 }}"
                                        aria-describedby="contact_email2" name="contact_email2">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg proceed">Proceed</button>
                    </section>
                    <section class="trial {{ $step3 }}" id="photo-detail" data-step="3" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Photo ID Details
                            @if($step3 == 'completed' && $details == 0)
                                <span class="edit-now float-right mt-1">Edit</span>
                            @endif
                        </h3>
                        <div class="row">
                            <!-- For Individual Case :: Name, PANCARD NUMBER, AADHAR CARD NUMBER, Date of Birth field is require-->

                            <div class="col-sm-8 pan_no">
                                <div class="form-group">
                                    <label for="pan_no">PANCARD NUMBER <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no"
                                        aria-describedby="pan_no" value="{{ @$data->pan_no }}">
                                </div>
                            </div>
                            <div class="col-sm-4 pan_upload">
                                <div class="form-group">
                                    <label for="pan_upload" class="w-100">PANCARD
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="pan_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="pan_upload" type="file" name="pan_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->pan_upload) && !empty($data->pan_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->pan_upload) && !empty($data->pan_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->pan_upload }}')" data-src="{{ $data->pan_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 aadhar_no">
                                <div class="form-group">
                                    <label for="aadhar_no">AADHAR CARD NUMBER <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control" id="aadhar_no"
                                        name="aadhar_no" aria-describedby="aadhar_no" value="{{ @$data->aadhar_no }}">
                                </div>
                            </div>
                            <div class="col-sm-4 aadhar_upload">
                                <div class="form-group">
                                    <label for="aadhar_upload" class="w-100">AADHAR CARD
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="aadhar_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="aadhar_upload" type="file" name="aadhar_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->aadhar_upload) && !empty($data->aadhar_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->aadhar_upload) && !empty($data->aadhar_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->aadhar_upload }}')" data-src="{{ $data->aadhar_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 birth_date">
                                <div class="form-group">
                                    <label for="birth_date">Date of Birth<span class="required-sign">*</span></label>
                                    <input type="text" name="birth_date" class="form-control"
                                        id="birth_date" aria-describedby="birth_date" value="@if(isset($data->birth_date)){{ \Carbon\Carbon::parse(@$data->birth_date)->format('d-m-Y')}}@endif">
                                </div>
                            </div>
                            <div class="col-sm-4 photo_upload">
                                <div class="form-group">
                                    <label for="photo_upload" class="w-100">PHOTO
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="photo_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="photo_upload" type="file" name="photo_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->photo_upload) && !empty($data->photo_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->photo_upload) && !empty($data->photo_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->photo_upload }}')" data-src="{{ $data->photo_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 anniversary_date">
                                <div class="form-group">
                                    <label for="anniversary_date">Date of Anniversary</label>
                                    <input type="text" name="anniversary_date" class="form-control"
                                        id="anniversary_date" aria-describedby="anniversary_date" value="@if(isset($data->anniversary_date)){{ \Carbon\Carbon::parse(@$data->anniversary_date)->format('d-m-Y')}}@endif">
                                </div>
                            </div>
                        </div>
                        <button  type="submit" class="btn btn-primary btn-lg proceed">Proceed</button>
                    </section>
                    <section class="trial {{ $step4 }}" id="address-detail" data-step="4" autocomplete="off">

                        <!-- If Selected Individual on Entity Type, then Address 1, Address 2, Address 3, City, State, Country, Pincode,Mobile Number,Telephone No,Email Address Require -->
                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Address Details
                            @if($step4 == 'completed' && $details == 0)
                                <span class="edit-now float-right mt-1">Edit</span>
                            @endif
                        </h3>
                        <div class="row" id="correspondence_address">
                            <div class="col-sm-12">
                                <h4 class="card-title">Correspondence Address</h4>
                            </div>
                            <input type="hidden" name="c_state_code" id="c_state_code" value="{{ @$data->c_state }}">
                            <input type="hidden" name="p_state_code" id="p_state_code" value="{{ @$data->p_state }}">
                            <div class="col-sm-12 c_address1">
                                <div class="form-group ">
                                    <label for="c_address1">Address 1 <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="c_address1" value="{{ @$data->c_address1 }}"
                                        aria-describedby="c_address1" name="c_address1">
                                </div>
                            </div>
                            <div class="col-sm-12 c_address2">
                                <div class="form-group ">
                                    <label for="c_address2">Address 2 <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="c_address2" value="{{ @$data->c_address2 }}"
                                        aria-describedby="c_address2" name="c_address2">
                                </div>
                            </div>
                            <div class="col-sm-6 c_address3">
                                <div class="form-group">
                                    <label for="c_address3">Address 3</label>
                                    <input type="text" class="form-control text-capitalize" id="c_address3" value="{{ @$data->c_address3 }}"
                                        aria-describedby="c_address3" name="c_address3">
                                </div>
                            </div>
                            <div class="col-sm-6 c_city">
                                <div class="form-group">
                                    <label for="c_city">City <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="c_city" value="{{ @$data->c_city }}"
                                        aria-describedby="c_city" name="c_city">
                                </div>
                            </div>
                            <div class="col-sm-6 c_state">
                                <div class="form-group">
                                    <label for="c_state">State <span
                                        class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="c_state" name="c_state">
                                            <option value="" disabled selected>Select State</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 c_country">
                                <div class="form-group">
                                    <label for="c_country">Country <span
                                        class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="c_country" name="c_country">
                                            <option value="" disabled selected>Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @if(isset($data->c_country) && $country->id == $data->c_country) {{'selected'}} @elseif($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 c_pincode">
                                <div class="form-group">
                                    <label for="c_pincode">Pincode <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="c_pincode" class="form-control" value="{{ @$data->c_pincode }}"
                                        aria-describedby="c_pincode" name="c_pincode">
                                </div>
                            </div>
                            <div class="col-sm-4 c_address_upload">
                                <input type="hidden" name="is_c_address_upload" value="{{ isset($data->c_address_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="c_address_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="c_address_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="c_address_upload" type="file" name="c_address_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->c_address_upload) && !empty($data->c_address_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->c_address_upload) && !empty($data->c_address_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->c_address_upload }}')" data-src="{{ $data->c_address_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group custom-checkbox">
                                    <input type="checkbox" id="is_permanent_address" name="is_permanent_address" value="1" checked>
                                    <label for="is_permanent_address">Permanent Address Same As Correspondence Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="row permanent" id="permanent_address">
                            <div class="col-sm-12">
                                <h4 class="card-title">Permanent Address</h4>
                            </div>
                            <div class="col-sm-12 p_address1">
                                <div class="form-group ">
                                    <label for="p_address1">Address 1 <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="p_address1" value="{{ @$data->p_address1 }}"
                                        aria-describedby="p_address1" name="p_address1">
                                </div>
                            </div>
                            <div class="col-sm-12 p_address2">
                                <div class="form-group ">
                                    <label for="p_address2">Address 2 <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="p_address2" value="{{ @$data->p_address2 }}"
                                        aria-describedby="p_address2" name="p_address2">
                                </div>
                            </div>
                            <div class="col-sm-6 p_address3">
                                <div class="form-group">
                                    <label for="p_address3">Address 3</label>
                                    <input type="text" class="form-control text-capitalize" id="p_address3" value="{{ @$data->p_address3 }}"
                                        aria-describedby="p_address3" name="p_address3">
                                </div>
                            </div>
                            <div class="col-sm-6 p_city">
                                <div class="form-group">
                                    <label for="p_city">City <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="p_city" value="{{ @$data->p_city }}"
                                        aria-describedby="p_city" name="p_city">
                                </div>
                            </div>
                            <div class="col-sm-6 p_state">
                                <div class="form-group">
                                    <label for="p_state">State <span
                                        class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="p_state" name="p_state">
                                            <option value="" disabled selected>Select State</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p_country">
                                <div class="form-group">
                                    <label for="p_country">Country <span
                                        class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="p_country" name="p_country">
                                            <option value="" disabled selected>Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @if(isset($data->p_country) && $country->id == $data->p_country) {{'selected'}} @elseif($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p_pincode">
                                <div class="form-group">
                                    <label for="p_pincode">Pincode <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="p_pincode" class="form-control" value="{{ @$data->p_pincode }}"
                                        aria-describedby="p_pincode" name="p_pincode">
                                </div>
                            </div>
                            <div class="col-sm-4 p_address_upload">
                                <input type="hidden" name="is_p_address_upload" value="{{ isset($data->p_address_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="p_address_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="p_address_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="p_address_upload" type="file" name="p_address_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->p_address_upload) && !empty($data->p_address_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->p_address_upload) && !empty($data->p_address_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->p_address_upload }}')" data-src="{{ $data->p_address_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg proceed">Proceed</button>
                    </section>
                    <section class="trial {{ $step5 }}" id="bank-detail" data-step="5" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Bank Details
                            @if($step5 == 'completed'  && $details == 0)
                                <span class="edit-now float-right mt-1">Edit</span>
                            @endif
                        </h3>

                        <div class="row">

                            <div class="col-sm-8 ifsc_no">
                                <div class="form-group">
                                    <label for="ifsc_no">IFSC Number <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-uppercase" id="ifsc_no" name="ifsc_no" value="{{ @$data->ifsc_no }}"
                                        aria-describedby="ifsc_no">
                                </div>
                            </div>
                            <div class="col-sm-4 cheque_upload">
                                <input type="hidden" name="is_cheque_upload" value="{{ isset($data->cheque_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="cheque_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="cheque_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="cheque_upload" type="file" name="cheque_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->cheque_upload) && !empty($data->cheque_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->cheque_upload) && !empty($data->cheque_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->cheque_upload }}')" data-src="{{ $data->cheque_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 bank_name">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control  text-capitalize" id="bank_name" value="{{ @$data->bank_name }}"
                                        name="bank_name" aria-describedby="bank_name">
                                </div>
                            </div>
                            <div class="col-sm-8 branch_name">
                                <div class="form-group">
                                    <label for="branch_name">Branch <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="branch_name" value="{{ @$data->branch_name }}"
                                        name="branch_name" aria-describedby="branch_name">
                                </div>
                            </div>
                            <div class="col-sm-8 micr">
                                <div class="form-group">
                                    <label for="micr">MICR <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="micr" name="micr" value="{{ @$data->micr }}"
                                        aria-describedby="micr" placeholder="Enter MICR">
                                </div>
                            </div>
                            <div class="col-sm-8 account_type">
                                <div class="form-group">
                                    <label for="account_type">Account Type <span
                                        class="required-sign">*</span></label>
                                    <div class="select-wrapper exclude">
                                        <select class="form-control" id="account_type"
                                            name="account_type">
                                            <option value="" disabled selected>Select Account Type
                                            </option>
                                            <option value="Saving" @if(isset($data->account_type) && $data->account_type == 'Saving') {{'selected'}} @endif>Saving Account</option>
                                            <option value="Current" @if(isset($data->account_type) && $data->account_type == 'Current') {{'selected'}} @endif>Current Account</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 account_no">
                                <div class="form-group">
                                    <label for="account_no">Account Number <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control" id="account_no" value="{{ @$data->account_no }}"
                                        aria-describedby="account_no" name="account_no">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg proceed">Proceed</button>
                    </section>
                    <section class="trial {{ $step6 }}" id="certification-detail" data-step="6" autocomplete="off">

                        <!-- NISM VA CERTIFICATE  -->
                        <!-- If "PROFESSION" Selected :: MFD -->
                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Certification
                            @if($step6 == 'completed' && $details == 0)
                                <span class="edit-now float-right mt-1">Edit</span>
                            @endif
                        </h3>
                        <div class="row flex-column" id="mfd_ria_type">
                            <div class="col-sm-8 mfd_ria_certificate_type">
                                <div class="form-group">
                                    <label for="mfd_ria_certificate_type">Certification Type <span
                                        class="required-sign">*</span></label>
                                    <div class="dropdown customMulti">
                                        <a class="dropdown-toggle select-dropdown"
                                            type="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-grey">Certification Type</span>
                                        </a>

                                        <div id="mfd_ria_certificate_type" class="dropdown-menu dropdown-menu-left select-dropdown-list">
                                            @php
                                                $mfd = 0;
                                                $ria = 0;
                                                if(isset($data->profession_id) && $data->profession_id == 3)
                                                {
                                                    if(!empty($data->employee_certificate->nism_va_no))
                                                    {
                                                        $mfd = 1;
                                                    }
                                                }
                                                if(isset($data->employee_certificate->ria_certificate_type) && !empty($data->employee_certificate->ria_certificate_type))
                                                {
                                                    $ria = 1;
                                                }
                                            @endphp
                                            <input type="hidden" name="mfd_ria_type_mfd" value="@if($mfd == 0){{'0'}} @else {{'1'}} @endif">
                                            <input type="hidden" name="mfd_ria_type_ria" value="@if($ria == 0){{'0'}} @else {{'1'}} @endif">

                                            <div class="data-list">
                                                <a class="dropdown-item mfd">
                                                    <div class="form-group custom-checkbox m-0">
                                                        <input type="checkbox" id="mfd" name="mfd_ria_certificate_type[]" value="mfd" @if($mfd == 1){{'checked'}} @endif>
                                                        <label for="mfd">MFD</label>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item ria">
                                                    <div class="form-group custom-checkbox m-0">
                                                        <input type="checkbox" id="ria" name="mfd_ria_certificate_type[]" value="ria" @if($ria == 1){{'checked'}} @endif>
                                                        <label for="ria">RIA</label>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="nism_va_details">

                            <div class="col-sm-12">
                                <h3 class="card-title"> MFD Certificate Details</h3>
                                <h4 class="card-title">NISM VA CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 nism_va_no">
                                <div class="form-group">
                                    <label for="nism_va_no">NISM VA CERTIFICATE NUMBER <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="nism_va_no" class="form-control" value="{{ @$data->employee_certificate->nism_va_no }}"
                                        name="nism_va_no" aria-describedby="nism_va_no">
                                </div>
                            </div>
                            <div class="col-sm-4 nism_va_upload">
                                <input type="hidden" name="is_nism_va_upload" value="{{ isset($data->employee_certificate->nism_va_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="nism_va_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="nism_va_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="nism_va_upload" type="file" name="nism_va_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_certificate->nism_va_upload) && !empty($data->employee_certificate->nism_va_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_certificate->nism_va_upload) && !empty($data->employee_certificate->nism_va_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_certificate->nism_va_upload }}')" data-src="{{ $data->employee_certificate->nism_va_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 nism_va_validity">
                                <div class="form-group">
                                    <label for="nism_va_validity">VALIDITY <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="nism_va_validity" class="form-control" value="{{ @$data->employee_certificate->nism_va_validity }}"
                                        name="nism_va_validity" aria-describedby="nism_va_validity">

                                </div>
                            </div>
                        </div>

                        <div class="row" id="euin_details">
                            <div class="col-sm-12">
                                <!--<h3 class="card-title">EUIN</h3>-->
                                <h4 class="card-title">EUIN</h4>
                            </div>
                            <div class="col-sm-8 euin_name">
                                <div class="form-group">
                                    <label for="euin_name">Name of EUIN Holder <span
                                        class="required-sign">*</span></label>
                                    <input type="text" class="form-control text-capitalize" id="euin_name" value="{{ @$data->employee_licence->euin_name }}"
                                        name="euin_name" aria-describedby="euin_name" />
                                </div>
                            </div>
                            <div class="col-sm-4 euin_upload">
                                <input type="hidden" name="is_euin_upload" value="{{ isset($data->employee_licence->euin_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="euin_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="euin_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="euin_upload" type="file" name="euin_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_licence->euin_upload) && !empty($data->employee_licence->euin_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_licence->euin_upload) && !empty($data->employee_licence->euin_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_licence->euin_upload }}')" data-src="{{ $data->employee_licence->euin_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6 euin_no">
                                <div class="form-group">
                                    <label for="euin_no">EUIN Number <span class="required-sign">*</span></label>
                                    <div class="input-group exclude">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">E &ensp;</span>
                                        </div>
                                        <input type="text" id="euin_no" class="form-control" name="euin_no" value="{{ @$data->employee_licence->euin_no }}" aria-describedby="euin_no">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 euin_validity">
                                <div class="form-group">
                                    <label for="euin_validity">VALIDITY <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="euin_validity" class="form-control" value="{{ @$data->employee_licence->euin_validity }}"
                                        name="euin_validity" aria-describedby="euin_validity">

                                </div>
                            </div>
                        </div>


                        <!-- End -->

                        <!-- If "PROFESSION" Selected :: RIA -->
                        <div class="row flex-column" id="ria_type">
                            <div class="col-sm-12">
                                <h3 class="card-title"> RIA Certificate Details</h3>
                            </div>
                            <div class="col-sm-8 ria_certificate_type">
                                <div class="form-group">
                                    <label for="ria_certificate_type">RIA Certification Type <span
                                        class="required-sign">*</span></label>
                                    <div class="dropdown customMulti">
                                        <a class="dropdown-toggle select-dropdown"
                                            type="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-grey">Certification Type</span>
                                        </a>
                                        <div id="ria_certificate_type" class="dropdown-menu dropdown-menu-left select-dropdown-list">
                                            @php
                                                $nism = 0;
                                                $cfp = 0;
                                                $cwm = 0;
                                                if(isset($data->employee_certificate->ria_certificate_type) && !empty($data->employee_certificate->ria_certificate_type))
                                                {
                                                    $cdata = json_decode($data->employee_certificate->ria_certificate_type);

                                                    if(is_array($cdata))
                                                    {
                                                        if(in_array('nism', $cdata)){$nism = 1;}
                                                        if(in_array('cfp', $cdata)){$cfp = 1;}
                                                        if(in_array('nism', $cdata)){$nism = 1;}
                                                    }
                                                }
                                            @endphp
                                            <input type="hidden" name="ria_type_nism" value="@if($nism == 0){{'0'}} @else {{'1'}} @endif">
                                            <input type="hidden" name="ria_type_cfp" value="@if($cfp == 0){{'0'}} @else {{'1'}} @endif">
                                            <input type="hidden" name="ria_type_cwm" value="@if($cwm == 0){{'0'}} @else {{'1'}} @endif">

                                            <div class="data-list">
                                                <a class="dropdown-item">
                                                    <div class="form-group custom-checkbox m-0">

                                                        <input type="checkbox" name="ria_certificate_type[]" id="nism" value="nism" @if($nism == 1){{'checked'}} @endif>
                                                        <label for="nism">NISM</label>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item">
                                                    <div class="form-group custom-checkbox m-0">
                                                        <input type="checkbox" name="ria_certificate_type[]" id="cfp" value="cfp" @if($cfp == 1){{'checked'}} @endif>
                                                        <label for="cfp">CFP</label>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item">
                                                    <div class="form-group custom-checkbox m-0">
                                                        <input type="checkbox" name="ria_certificate_type[]" id="cwm" value="cwm" @if($cwm == 1){{'checked'}} @endif>
                                                        <label for="cwm">CWM</label>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- If ABOVE Selected :: NISM -->
                        <!-- NISM XA CERTIFICATE  -->

                        <div class="row" id="nism_xa_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">NISM XA CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 nism_xa_no">
                                <div class="form-group">
                                    <label for="nism_xa_no">NISM XA CERTIFICATE NUMBER <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="nism_xa_no" class="form-control" value="{{ @$data->employee_certificate->nism_xa_no }}"
                                        name="nism_xa_no" aria-describedby="nism_xa_no">
                                </div>
                            </div>
                            <div class="col-sm-4 nism_xa_upload">
                                <input type="hidden" name="is_nism_xa_upload" value="{{ isset($data->employee_certificate->nism_xa_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="nism_xa_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="nism_xa_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="nism_xa_upload" type="file" name="nism_xa_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_certificate->nism_xa_upload) && !empty($data->employee_certificate->nism_xa_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_certificate->nism_xa_upload) && !empty($data->employee_certificate->nism_xa_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_certificate->nism_xa_upload }}')" data-src="{{ $data->employee_certificate->nism_xa_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 nism_xa_validity">
                                <div class="form-group">
                                    <label for="nism_xa_validity">VALIDITY <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="nism_xa_validity" class="form-control" value="{{ @$data->employee_certificate->nism_xa_validity }}"
                                        name="nism_xa_validity" aria-describedby="nism_xa_validity">

                                </div>
                            </div>
                        </div>
                        <!-- NISM XB CERTIFICATE  -->

                        <div class="row" id="nism_xb_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">NISM XB CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 nism_xb_no">
                                <div class="form-group">
                                    <label for="nism_xb_no">NISM XB CERTIFICATE NUMBER <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="nism_xb_no" class="form-control" value="{{ @$data->employee_certificate->nism_xb_no }}"
                                        name="nism_xb_no" aria-describedby="nism_xb_no">
                                </div>
                            </div>
                            <div class="col-sm-4 nism_xb_upload">
                                <input type="hidden" name="is_nism_xb_upload" value="{{ isset($data->employee_certificate->nism_xb_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="nism_xb_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="nism_xb_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="nism_xb_upload" type="file" name="nism_xb_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_certificate->nism_xb_upload) && !empty($data->employee_certificate->nism_xb_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_certificate->nism_xb_upload) && !empty($data->employee_certificate->nism_xb_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_certificate->nism_xb_upload }}')" data-src="{{ $data->employee_certificate->nism_xb_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 nism_xb_validity">
                                <div class="form-group">
                                    <label for="nism_xb_validity">VALIDITY <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="nism_xb_validity" class="form-control" value="{{ @$data->employee_certificate->nism_xb_validity }}"
                                        name="nism_xb_validity" aria-describedby="nism_xb_validity">

                                </div>
                            </div>
                        </div>
                        <!-- CFP CERTIFICATE  -->
                        <div class="row" id="cfp_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CFP CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 cfp_no">
                                <div class="form-group">
                                    <label for="cfp_no">CFP CERTIFICATE NUMBER <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="cfp_no" class="form-control" name="cfp_no" value="{{ @$data->employee_certificate->cfp_no }}"
                                        aria-describedby="cfp_no">
                                </div>
                            </div>
                            <div class="col-sm-4 cfp_upload">
                                <input type="hidden" name="is_cfp_upload" value="{{ isset($data->employee_certificate->cfp_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="cfp_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="cfp_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="cfp_upload" type="file" name="cfp_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_certificate->cfp_upload) && !empty($data->employee_certificate->cfp_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_certificate->cfp_upload) && !empty($data->employee_certificate->cfp_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_certificate->cfp_upload }}')" data-src="{{ $data->employee_certificate->cfp_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cfp_validity">
                                <div class="form-group">
                                    <label for="cfp_validity">VALIDITY <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="cfp_validity" class="form-control" value="{{ @$data->employee_certificate->cfp_validity }}"
                                        name="cfp_validity" aria-describedby="cfp_validity">

                                </div>
                            </div>
                        </div>
                        <!-- CWM CERTIFICATE  -->

                        <div class="row" id="cwm_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CWM CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 cwm_no">
                                <div class="form-group">
                                    <label for="cwm_no">CWM CERTIFICATE NUMBER <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="cwm_no" class="form-control" name="cwm_no" value="{{ @$data->employee_certificate->cwm_no }}"
                                        aria-describedby="cwm_no">
                                </div>
                            </div>
                            <div class="col-sm-4 cwm_upload">
                                <input type="hidden" name="is_cwm_upload" value="{{ isset($data->employee_certificate->cwm_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="cwm_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="cwm_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="cwm_upload" type="file" name="cwm_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_certificate->cwm_upload) && !empty($data->employee_certificate->cwm_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_certificate->cwm_upload) && !empty($data->employee_certificate->cwm_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_certificate->cwm_upload }}')" data-src="{{ $data->employee_certificate->cwm_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cwm_validity">
                                <div class="form-group">
                                    <label for="cwm_validity">VALIDITY <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="cwm_validity" class="form-control" value="{{ @$data->employee_certificate->cwm_validity }}"
                                        name="cwm_validity" aria-describedby="cwm_validity">

                                </div>
                            </div>
                        </div>

                        <div class="row flex-column" id="ca_cs_type">
                            <div class="col-sm-12">
                                <h3 class="card-title">Other Certificate Details</h3>
                            </div>
                            <div class="col-sm-8 ca_cs_certificate_type">
                                <div class="form-group">
                                    <label for="ca_cs_certificate_type">Certification Type <span
                                        class="required-sign">*</span></label>
                                    <div class="dropdown customMulti">
                                        <a class="dropdown-toggle select-dropdown"
                                            type="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-grey">Certification Type</span>
                                        </a>

                                        <div id="ca_cs_certificate_type" class="dropdown-menu dropdown-menu-left select-dropdown-list">
                                            @php
                                                $ca = 0;
                                                $cs = 0;
                                                $ot = 0;
                                                if(isset($data->employee_certificate->ca_no) && !empty($data->employee_certificate->ca_no))
                                                {
                                                    $ca = 1;
                                                }
                                                if(isset($data->employee_certificate->cs_no) && !empty($data->employee_certificate->cs_no))
                                                {
                                                    $cs = 1;
                                                }
                                                if(isset($data->employee_certificate->course_name) && !empty($data->employee_certificate->course_name))
                                                {
                                                    $ot = 1;
                                                }
                                            @endphp
                                            <input type="hidden" name="ca_type" value="@if($ca == 0){{'0'}} @else {{'1'}} @endif">
                                            <input type="hidden" name="cs_type" value="@if($cs == 0){{'0'}} @else {{'1'}} @endif">
                                            <input type="hidden" name="ot_type" value="@if($ot == 0){{'0'}} @else {{'1'}} @endif">
                                            <div class="data-list">
                                                <a class="dropdown-item ca">
                                                    <div class="form-group custom-checkbox m-0">
                                                        <input type="checkbox" id="typeca" name="ca_cs_certificate_type[]" value="ca" @if($ca == 1){{'checked'}} @endif>
                                                        <label for="typeca">CA</label>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item cs">
                                                    <div class="form-group custom-checkbox m-0">
                                                        <input type="checkbox" id="typecs" name="ca_cs_certificate_type[]" value="cs" @if($cs == 1){{'checked'}} @endif>
                                                        <label for="typecs">CS</label>
                                                    </div>
                                                </a>
                                                <a class="dropdown-item ot">
                                                    <div class="form-group custom-checkbox m-0">
                                                        <input type="checkbox" id="typeot" name="ca_cs_certificate_type[]" value="other" @if($ot == 1){{'checked'}} @endif>
                                                        <label for="typeot">Other</label>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CA CERTIFICATE  -->

                        <div class="row" id="ca_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CA DETAILS</h4>
                            </div>
                            <div class="col-sm-8 ca_no">
                                <div class="form-group">
                                    <label for="ca_no">CA CERTIFICATE NO <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="ca_no" class="form-control" name="ca_no" value="{{ @$data->employee_certificate->ca_no }}"
                                        aria-describedby="ca_no">
                                </div>
                            </div>
                            <div class="col-sm-4 ca_upload">
                                <input type="hidden" name="is_ca_upload" value="{{ isset($data->employee_certificate->ca_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="ca_upload" class="w-100">PROFF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="ca_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="ca_upload" type="file" name="ca_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_certificate->ca_upload) && !empty($data->employee_certificate->ca_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_certificate->ca_upload) && !empty($data->employee_certificate->ca_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_certificate->ca_upload }}')" data-src="{{ $data->employee_certificate->ca_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 ca_validity">
                                <div class="form-group">
                                    <label for="ca_validity">VALIDITY (IF ANY)</label>
                                    <input type="text" id="ca_validity" class="form-control" value="{{ @$data->employee_certificate->ca_validity }}"
                                        name="ca_validity" aria-describedby="ca_validity">

                                </div>
                            </div>
                        </div>

                        <!-- CS CERTIFICATE  -->

                        <div class="row" id="cs_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CS DETAILS</h4>
                            </div>
                            <div class="col-sm-8 cs_no">
                                <div class="form-group">
                                    <label for="cs_no">CS CERTIFICATE NO <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="cs_no" class="form-control" name="cs_no" value="{{ @$data->employee_certificate->cs_no }}"
                                        aria-describedby="cs_no">
                                </div>
                            </div>
                            <div class="col-sm-4 cs_upload">
                                <input type="hidden" name="is_cs_upload" value="{{ isset($data->employee_certificate->cs_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="cs_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="cs_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="cs_upload" type="file" name="cs_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_certificate->cs_upload) && !empty($data->employee_certificate->cs_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_certificate->cs_upload) && !empty($data->employee_certificate->cs_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_certificate->cs_upload }}')" data-src="{{ $data->employee_certificate->cs_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cs_validity">
                                <div class="form-group">
                                    <label for="cs_validity">VALIDITY  (IF ANY)</label>
                                    <input type="text" id="cs_validity" class="form-control" value="{{ @$data->employee_certificate->cs_validity }}"
                                        name="cs_validity" aria-describedby="cs_validity">

                                </div>
                            </div>
                        </div>

                        <!-- OTHER CERTIFICATE  -->

                        <div class="row" id="course_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">Degree/Course Details</h4>
                            </div>
                            <div class="col-sm-8 course_name">
                                <div class="form-group">
                                    <label for="course_name">Name of Course/Degree <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="course_name" class="form-control" value="{{ @$data->employee_certificate->course_name }}"
                                        name="course_name" aria-describedby="course_name">
                                </div>
                            </div>
                            <div class="col-sm-4 course_upload">
                                <input type="hidden" name="is_course_upload" value="{{ isset($data->employee_certificate->course_upload) ? 1 : 0 }}">
                                <div class="form-group">
                                    <label for="course_upload" class="w-100">PROOF
                                        <span class="required-sign">*</span>
                                    </label>
                                    <label for="course_upload" class="btn input-btn w-100">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#upload" />
                                        </svg>
                                        <input id="course_upload" type="file" name="course_upload" />
                                        <div class="value-wrap">
                                            <span class="default-text">@if(isset($data->employee_certificate->course_upload) && !empty($data->employee_certificate->course_upload)) Update @else Upload @endif</span>
                                            <span class="value"></span>
                                        </div>
                                    </label>
                                    @if(isset($data->employee_certificate->course_upload) && !empty($data->employee_certificate->course_upload))
                                    <label class="w-100">
                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->employee_certificate->course_upload }}')" data-src="{{ $data->employee_certificate->course_upload }}">Preview</a></span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 course_no">
                                <div class="form-group">
                                    <label for="course_no">COURSE CERTIFICATE NO <span
                                        class="required-sign">*</span></label>
                                    <input type="text" id="course_no" class="form-control" value="{{ @$data->employee_certificate->course_no }}"
                                        name="course_no" aria-describedby="course_no">
                                </div>
                            </div>

                            <div class="col-sm-8 course_validity">
                                <div class="form-group">
                                    <label for="course_validity">VALIDITY (IF ANY)</label>
                                    <input type="text" id="course_validity" class="form-control" value="{{ @$data->employee_certificate->course_validity }}"
                                        name="course_validity" aria-describedby="course_validity">

                                </div>
                            </div>
                        </div>
                        <!-- End -->
                        @if (isset($data->status) && $data->status == 2 && $details == 0)
                        <input type="hidden" id="userstatus" name="userstatus" value="0">


                        <button type="button" class="proceed btn btn-primary btn-lg" style="min-width:11rem">Verify</button>
                        <button type="button" class="reject-now btn btn-danger btn-lg" style="min-width:11rem">Reject</button>
                        @else
                        @if ($details == 0)
                        <button type="button" class="proceed btn btn-primary btn-lg">Confirm</button>
                        @endif

                        @endif
                        <div class="row">
                            <div class="modal fade" id="RejectModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog"><!-- modal-lg-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Rejection Reason</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12 reject_reason">
                                                    <div class="form-group">
                                                        <label for="reject_reason">Specify Details</label>
                                                        <textarea class="form-control" id="reject_reason" name="reject_reason" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="proceed btn btn-primary btn-lg" style="min-width: 11rem">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    @if($download_view == 1)
                    <section class="trial {{ $step7 }}" id="bse-detail" data-step="7" autocomplete="off">

                        <h3 class="card-title"> <i class="icon-left-arrow back-btn"></i> Download</h3>
                        <div class="row flex-column">
                            <div class="col-xl-6 col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="bse_download">Download BSE File</label>
                                    <a role="button" href="{{ @$download['path'] }}" download="{{ @$download['name'] }}">
                                    <label for="bse_download" class="btn download-btn w-100">
                                        <div class="left-side">
                                            <svg width="40" height="40" viewBox="0 0 38 38">
                                                <use xlink:href="#xls"></use>
                                            </svg>
                                            <span class="value text-uppercase">
                                                {{ @$download['name'] }}
                                             </span>
                                        </div>
                                        <svg class="upload-icon" width="30" height="30" viewBox="0 0 24 24">
                                            <use xlink:href="#download"></use>
                                        </svg>
                                    </label>
                                </a>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h3 class="card-title">Upload</h3>
                        <input type="hidden" name="is_credential_email" value="{{ @$data->is_credential_email }}">
                        <div class="row">
                            <div class="col-12 bse_upload mt-20">
                                <div class="form-group custom-checkbox">
                                    <input type="checkbox" id="bse_upload" name="bse_upload" value="{{ @$data->bse_upload }}" @if($data->bse_upload == 1) {{'checked'}} @endif class="form-control">
                                    <label for="bse_upload">File Uploaded to BSE</label>
                                </div>
                            </div>
                        </div>
                        @if($details == 0)
                            @if($data->status == 10)
                                <button type="button" class="proceed btn btn-primary btn-lg" id="bse_send_email" @if($data->bse_upload == 0) {{'disabled'}} @endif>Send Credentials Email</button>
                            @endif
                        @endif
                    </section>
                    @endif
                </form>
                <div class="col-xl-4 col-lg-3 d-none d-lg-flex">
                    <lottie-player src="/assets/images/data.json" background="transparent" speed="1"
                        style="height: 300px;" loop autoplay></lottie-player>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('modal')
<!-- Modal -->

  <div class="modal fade" id="uploadModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><!-- modal-lg-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">View Proof</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-sections">
                        <div class="col-12 d-flex justify-content-center" id="show_doc">
                           {{-- <img src="" id="show_img" alt="image" class="img-fluid"> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" id="download_img" class="btn btn-primary col-sm-3" download target="_blank">Download</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/employee.js') }}"></script>
<script>

</script>
@endsection
