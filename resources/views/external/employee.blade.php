@extends('layouts.external')

@section('style')
<style>
    .termsx {
overflow-y: scroll;
height: 150px;
width: 100%;
border: 1px solid #DDD;
padding: 10px;
}
div.error{
    font-size: 80%;
    font-weight: 400;
    color: #ce4b4b;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    text-transform: capitalize;
}
    .btn-view{
        border: 1px solid #a3a3a3;
    color: #545454 !important;
    line-height: 1.7 !important;
    }
    .input-group .form-control:disabled, .input-group .form-control[readonly] {
        background-color: #e9ecef !important;
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
.center {
  margin: auto;
  width: 70%;

  padding: 10px;
}
/*Select2 ReadOnly End*/

    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="col-12 d-flex center">

                        <img src="http://127.0.0.1:8001/assets/images/logo.svg" width="30%">
                        <h3 style="margin-top: 7px;font-size: 25px;margin-left:10px;">Kinntegra</h3>

                    </div>
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

                    @endphp
                    <ul class="form-lists">
                        <li data-form="general-information" class="active">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            General Information
                        </li>
                        <li data-form="employee-detail" class="isParent">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Employee Details
                            <ul>
                                <li class="isChild" data-form="photo-detail">Photo ID Details</li>
                                <li class="isChild" data-form="address-detail">Address Details</li>
                                <li class="isChild" data-form="bank-detail">Bank Details</li>
                            </ul>
                        </li>
                       <li data-form="certification-detail" class="">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Certification
                        </li>
                    </ul>
                </div>
                <form class="col-lg-5 col-md-8 step-forms" enctype="multipart/form-data" id="form-information" method="POST" action="{{ route('external-employee.store') }}">
                    @csrf

                    <input type="hidden" name="step" value="1">
                    <input type="hidden" name="step_edit" id="step_edit" value="0">
                    <input type="hidden" name="employee_id" id="employee_id" value="{{ @$data->id }}">
                    <input type="hidden" name="profession_id" id="profession_id" value="{{ @$data->profession_id }}">
                    <input type="hidden" name="status" value="{{ isset($data->status) ? $data->status : 1 }}">
                    <input type="hidden" name="employee_edit" id="employee_edit" value="{{ isset($data->id) ? 1 : 0 }}">
                    <input type="hidden" name="department_id" id="department_id" value="{{ @$data->department_id }}">
                    <input type="hidden" name="supervisor_id" id="supervisor_id" value="{{ @$data->supervisor_id }}">
                    <input type="hidden" name="subdepartment_id" id="subdepartment_id" value="{{ @$data->subdepartment_id }}">
                    <input type="hidden" name="designation_id" id="designation_id" value="{{ @$data->designation_id }}">
                    <input type="hidden" name="associate_id" id="associate_id" value="{{ @$data->associate_id }}">
                    <section class="trial active" id="general-information" data-step="1" autocomplete="off">
                        <h3 class="card-title"> General Information</h3>
                        <div class="row flex-column">
                            <div class="col-sm-8 associate_name">
                                <div class="form-group">
                                    <!--List of Employee for Selected Associate-->
                                    <label for="associate_name">Employer Name</label>
                                        <input type="text" class="form-control text-capitalize" id="associate_name" name="associate_name"
                                            aria-describedby="associate_name" value="{{ @$data->associate_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 name">
                                <div class="form-group">
                                    <label for="name">Name (As per Pancard)</label>
                                    <input type="text" class="form-control text-capitalize" id="name" name="name"
                                        aria-describedby="name" value="{{ @$data->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 department_name">
                                <div class="form-group">
                                    <!--List of Employee for Selected Associate-->
                                    <label for="department_name">Department</label>
                                    <input type="text" class="form-control text-capitalize" id="department_name" name="department_name"
                                        aria-describedby="department_name" value="{{ @$data->department_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 subdepartment_name">
                                <div class="form-group">
                                    <label for="subdepartment_name">Sub Department</label>
                                    <input type="text" class="form-control text-capitalize" id="subdepartment_name" name="subdepartment_name"
                                        aria-describedby="subdepartment_name" value="{{ @$data->subdepartment_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 designation_name">
                                <div class="form-group">
                                    <label for="designation_name">Grade</label>
                                    <input type="text" class="form-control text-capitalize" id="designation_name" name="designation_name"
                                        aria-describedby="designation_name" value="{{ @$data->designation_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 supervisor_name">
                                <div class="form-group">
                                    <label for="supervisor_name">Supervised By</label>
                                    <input type="text" class="form-control text-capitalize" id="supervisor_name" name="supervisor_name"
                                        aria-describedby="supervisor_name" value="{{ @$data->supervisor_name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-lg proceed">Next</button>
                    </section>
                    <section class="trial" id="employee-detail" data-step="2" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Employee Details</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="card-title">Contact Details</h4>
                            </div>
                            <div class="col-sm-6 mobile">
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile" value="{{ @$data->mobile }}"
                                        aria-describedby="mobile" name="mobile" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 telephone">
                                <div class="form-group">
                                    <label for="telephone">TELEPHONE NO</label>
                                    <input type="text" class="form-control" id="telephone" value="{{ @$data->telephone }}"
                                        aria-describedby="telephone" name="telephone" disabled>
                                </div>
                                <!--trim($com->comment)-->
                            </div>
                            <div class="col-sm-6 email">
                                <div class="form-group">
                                    <label for="email">EMAIL ADDRESS</label>
                                    <input type="text" class="form-control" id="email" value="{{ @$data->email }}"
                                        aria-describedby="email" name="email" disabled>
                                </div>
                            </div>

                            <div class="col-sm-6 blood_group">
                                <div class="form-group">
                                    <label for="blood_group">Blood Group</label>
                                    <input type="text" class="form-control" id="blood_group" value="{{ @$data->blood_group }}"
                                        aria-describedby="blood_group" name="blood_group" disabled>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group health_issue">
                                    <label for="health_issue">Health Issue (If Any)</label>

                                    <textarea class="form-control" id="health_issue"  name="health_issue" aria-describedby="health_issue" rows="3" disabled>{{ @$data->health_issue }}</textarea>
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
                                    <label for="contact_name1">Name</label>
                                    <input type="text" class="form-control text-uppercase" id="contact_name1" name="contact_name1" value="{{ @$data->contact_name1 }}"
                                        aria-describedby="contact_name1" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 contact_mobile1">
                                <div class="form-group">
                                    <label for="contact_mobile1">Mobile Number</label>
                                    <input type="text" class="form-control" id="contact_mobile1" value="{{ @$data->contact_mobile1 }}"
                                        aria-describedby="contact_mobile1" name="contact_mobile1" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 contact_email1">
                                <div class="form-group">
                                    <label for="contact_email1">EMAIL ADDRESS</label>
                                    <input type="text" class="form-control" id="contact_email1" value="{{ @$data->contact_email1 }}"
                                        aria-describedby="contact_email1" name="contact_email1" disabled>
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
                                    <label for="contact_name2">Name</label>
                                    <input type="text" class="form-control text-uppercase" id="contact_name2" name="contact_name2" value="{{ @$data->contact_name2 }}"
                                        aria-describedby="contact_name2" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 contact_mobile2">
                                <div class="form-group">
                                    <label for="contact_mobile2">Mobile Number</label>
                                    <input type="text" class="form-control" id="contact_mobile2" value="{{ @$data->contact_mobile2 }}"
                                        aria-describedby="contact_mobile2" name="contact_mobile2" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 contact_email2">
                                <div class="form-group">
                                    <label for="contact_email2">EMAIL ADDRESS</label>
                                    <input type="text" class="form-control" id="contact_email2" value="{{ @$data->contact_email2 }}"
                                        aria-describedby="contact_email2" name="contact_email2" disabled>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-lg proceed">Next</button>
                    </section>
                    <section class="trial" id="photo-detail" data-step="3" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Photo ID Details</h3>
                        <div class="row">
                            <!-- For Individual Case :: Name, PANCARD NUMBER, AADHAR CARD NUMBER, Date of Birth field is require-->

                            <div class="col-sm-8 pan_no">
                                <div class="form-group">
                                    <label for="pan_no">PANCARD NUMBER</label>
                                    <input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no"
                                        aria-describedby="pan_no" value="{{ @$data->pan_no }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 pan_upload">
                                <div class="form-group">
                                    <label for="pan_upload" class="w-100">Pan Card</label>
                                    @if(isset($data->pan_upload) && !empty($data->pan_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->pan_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 aadhar_no">
                                <div class="form-group">
                                    <label for="aadhar_no">AADHAR CARD NUMBER </label>
                                    <input type="text" class="form-control" id="aadhar_no"
                                        name="aadhar_no" aria-describedby="aadhar_no" value="{{ @$data->aadhar_no }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 aadhar_upload">
                                <div class="form-group">
                                    <label for="aadhar_upload" class="w-100">Aadhar Card</label>
                                    @if(isset($data->aadhar_upload) && !empty($data->aadhar_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->aadhar_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 birth_date">
                                <div class="form-group">
                                    <label for="birth_date">Date of Birth</label>
                                    <input type="text" name="birth_date" class="form-control"
                                        id="birth_date" aria-describedby="birth_date" value="{{ @$data->birth_date }}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 photo_upload">
                                <div class="form-group">
                                    <label for="photo_upload" class="w-100">PHOTO</label>
                                    @if(isset($data->photo_upload) && !empty($data->photo_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->photo_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 anniversary_date">
                                <div class="form-group">
                                    <label for="anniversary_date">Date of Anniversary</label>
                                    <input type="text" name="anniversary_date" class="form-control"
                                        id="anniversary_date" aria-describedby="anniversary_date" value="{{ @$data->anniversary_date }}" disabled>
                                </div>
                            </div>
                        </div>
                        <button  type="button" class="btn btn-primary btn-lg proceed">Next</button>
                    </section>
                    <section class="trial" id="address-detail" data-step="4" autocomplete="off">

                        <!-- If Selected Individual on Entity Type, then Address 1, Address 2, Address 3, City, State, Country, Pincode,Mobile Number,Telephone No,Email Address Require -->
                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Address Details</h3>
                        <div class="row" id="correspondence_address">
                            <div class="col-sm-12">
                                <h4 class="card-title">Correspondence Address</h4>
                            </div>
                            <input type="hidden" name="c_state_code" id="c_state_code" value="{{ @$data->c_state }}">
                            <input type="hidden" name="p_state_code" id="p_state_code" value="{{ @$data->p_state }}">
                            <div class="col-sm-12 c_address1">
                                <div class="form-group ">
                                    <label for="c_address1">Address 1</label>
                                    <input type="text" class="form-control text-capitalize" id="c_address1" value="{{ @$data->c_address1 }}"
                                        aria-describedby="c_address1" name="c_address1" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12 c_address2">
                                <div class="form-group ">
                                    <label for="c_address2">Address 2</label>
                                    <input type="text" class="form-control text-capitalize" id="c_address2" value="{{ @$data->c_address2 }}"
                                        aria-describedby="c_address2" name="c_address2" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 c_address3">
                                <div class="form-group">
                                    <label for="c_address3">Address 3</label>
                                    <input type="text" class="form-control text-capitalize" id="c_address3" value="{{ @$data->c_address3 }}"
                                        aria-describedby="c_address3" name="c_address3" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 c_city">
                                <div class="form-group">
                                    <label for="c_city">City</label>
                                    <input type="text" class="form-control text-capitalize" id="c_city" value="{{ @$data->c_city }}"
                                        aria-describedby="c_city" name="c_city" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 c_statename">
                                <div class="form-group">
                                    <label for="c_statename">State</label>
                                    <input type="text" class="form-control text-capitalize" id="c_statename" value="{{ @$data->c_statename }}"
                                        aria-describedby="c_statename" name="c_statename" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 c_countryname">
                                <div class="form-group">
                                    <label for="c_countryname">Country</label>
                                    <input type="text" class="form-control text-capitalize" id="c_countryname" value="{{ @$data->c_countryname }}"
                                        aria-describedby="c_countryname" name="c_countryname" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 c_pincode">
                                <div class="form-group">
                                    <label for="c_pincode">Pincode</label>
                                    <input type="text" id="c_pincode" class="form-control" value="{{ @$data->c_pincode }}"
                                        aria-describedby="c_pincode" name="c_pincode" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 c_address_upload">
                                <div class="form-group">
                                    <label for="c_address_upload" class="w-100">PROOF</label>
                                    @if(isset($data->c_address_upload) && !empty($data->c_address_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->c_address_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group custom-checkbox">
                                    <input type="checkbox" id="is_permanent_address" name="is_permanent_address" value="1" checked disabled>
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
                                    <label for="p_address1">Address 1</label>
                                    <input type="text" class="form-control text-capitalize" id="p_address1" value="{{ @$data->p_address1 }}"
                                        aria-describedby="p_address1" name="p_address1" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12 p_address2">
                                <div class="form-group ">
                                    <label for="p_address2">Address 2</label>
                                    <input type="text" class="form-control text-capitalize" id="p_address2" value="{{ @$data->p_address2 }}"
                                        aria-describedby="p_address2" name="p_address2" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 p_address3">
                                <div class="form-group">
                                    <label for="p_address3">Address 3</label>
                                    <input type="text" class="form-control text-capitalize" id="p_address3" value="{{ @$data->p_address3 }}"
                                        aria-describedby="p_address3" name="p_address3" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 p_city">
                                <div class="form-group">
                                    <label for="p_city">City</label>
                                    <input type="text" class="form-control text-capitalize" id="p_city" value="{{ @$data->p_city }}"
                                        aria-describedby="p_city" name="p_city" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 p_statename">
                                <div class="form-group">
                                    <label for="p_statename">State</label>
                                    <input type="text" class="form-control text-capitalize" id="p_statename" value="{{ @$data->p_statename }}"
                                        aria-describedby="p_statename" name="p_statename" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 p_countryname">
                                <div class="form-group">
                                    <label for="p_countryname">Country</label>
                                    <input type="text" class="form-control text-capitalize" id="p_countryname" value="{{ @$data->p_countryname }}"
                                        aria-describedby="p_countryname" name="p_countryname" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 p_pincode">
                                <div class="form-group">
                                    <label for="p_pincode">Pincode</label>
                                    <input type="text" id="p_pincode" class="form-control" value="{{ @$data->p_pincode }}"
                                        aria-describedby="p_pincode" name="p_pincode" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 p_address_upload">
                                <div class="form-group">
                                    <label for="p_address_upload" class="w-100">PROOF</label>
                                    @if(isset($data->p_address_upload) && !empty($data->p_address_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->p_address_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-lg proceed">Next</button>
                    </section>
                    <section class="trial" id="bank-detail" data-step="5" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Bank Details</h3>

                        <div class="row">

                            <div class="col-sm-8 ifsc_no">
                                <div class="form-group">
                                    <label for="ifsc_no">IFSC Number</label>
                                    <input type="text" class="form-control text-uppercase" id="ifsc_no" name="ifsc_no" value="{{ @$data->ifsc_no }}"
                                        aria-describedby="ifsc_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 cheque_upload">
                                <div class="form-group">
                                    <label for="cheque_upload" class="w-100">PROOF</label>
                                    @if(isset($data->cheque_upload) && !empty($data->cheque_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->cheque_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 bank_name">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" class="form-control  text-capitalize" id="bank_name" value="{{ @$data->bank_name }}"
                                        name="bank_name" aria-describedby="bank_name" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 branch_name">
                                <div class="form-group">
                                    <label for="branch_name">Branch</label>
                                    <input type="text" class="form-control text-capitalize" id="branch_name" value="{{ @$data->branch_name }}"
                                        name="branch_name" aria-describedby="branch_name" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 micr">
                                <div class="form-group">
                                    <label for="micr">MICR</label>
                                    <input type="text" class="form-control text-capitalize" id="micr" name="micr" value="{{ @$data->micr }}"
                                        aria-describedby="micr" placeholder="Enter MICR" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 account_type">
                                <div class="form-group">
                                    <label for="account_type">Account Type</label>
                                    <input type="text" class="form-control text-capitalize" id="account_type" name="account_type" value="{{ @$data->account_type }}"
                                        aria-describedby="account_type" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 account_no">
                                <div class="form-group">
                                    <label for="account_no">Account Number</label>
                                    <input type="text" class="form-control" id="account_no" value="{{ @$data->account_no }}"
                                        aria-describedby="account_no" name="account_no" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-lg proceed">Next</button>
                    </section>
                    <section class="trial" id="certification-detail" data-step="6" autocomplete="off">

                        <!-- NISM VA CERTIFICATE  -->
                        <!-- If "PROFESSION" Selected :: MFD -->
                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Certification</h3>
                        @if (isset($data->employee_certificate->nism_va_no) && !empty($data->employee_certificate->nism_va_no))
                        <div class="row" id="nism_va_details">
                            <div class="col-sm-12">
                                <h3 class="card-title"> MFD Certificate Details</h3>
                                <h4 class="card-title">NISM VA CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 nism_va_no">
                                <div class="form-group">
                                    <label for="nism_va_no">NISM VA CERTIFICATE NUMBER</label>
                                    <input type="text" id="nism_va_no" class="form-control" value="{{ @$data->employee_certificate->nism_va_no }}"
                                        name="nism_va_no" aria-describedby="nism_va_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 nism_va_upload">
                                <div class="form-group">
                                    <label for="nism_va_upload" class="w-100">PROOF</label>
                                    @if(isset($data->employee_certificate->nism_va_upload) && !empty($data->employee_certificate->nism_va_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->employee_certificate->nism_va_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 nism_va_validity">
                                <div class="form-group">
                                    <label for="nism_va_validity">VALIDITY</label>
                                    <input type="text" id="nism_va_validity" class="form-control" value="{{ @$data->employee_certificate->nism_va_validity }}"
                                        name="nism_va_validity" aria-describedby="nism_va_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- End -->



                        <!-- If ABOVE Selected :: NISM -->
                        <!-- NISM XA CERTIFICATE  -->
                        @if (isset($data->employee_certificate->nism_xa_no) && !empty($data->employee_certificate->nism_xa_no))
                        <div class="row" id="nism_xa_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">NISM XA CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 nism_xa_no">
                                <div class="form-group">
                                    <label for="nism_xa_no">NISM XA CERTIFICATE NUMBER </label>
                                    <input type="text" id="nism_xa_no" class="form-control" value="{{ @$data->employee_certificate->nism_xa_no }}"
                                        name="nism_xa_no" aria-describedby="nism_xa_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 nism_xa_upload">
                                <div class="form-group">
                                    <label for="nism_xa_upload" class="w-100">PROOF</label>
                                    @if(isset($data->employee_certificate->nism_xa_upload) && !empty($data->employee_certificate->nism_xa_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->employee_certificate->nism_xa_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 nism_xa_validity">
                                <div class="form-group">
                                    <label for="nism_xa_validity">VALIDITY </label>
                                    <input type="text" id="nism_xa_validity" class="form-control" value="{{ @$data->employee_certificate->nism_xa_validity }}"
                                        name="nism_xa_validity" aria-describedby="nism_xa_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- NISM XB CERTIFICATE  -->
                        @if (isset($data->employee_certificate->nism_xb_no) && !empty($data->employee_certificate->nism_xb_no))
                        <div class="row" id="nism_xb_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">NISM XB CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 nism_xb_no">
                                <div class="form-group">
                                    <label for="nism_xb_no">NISM XB CERTIFICATE NUMBER </label>
                                    <input type="text" id="nism_xb_no" class="form-control" value="{{ @$data->employee_certificate->nism_xb_no }}"
                                        name="nism_xb_no" aria-describedby="nism_xb_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 nism_xb_upload">
                                <div class="form-group">
                                    <label for="nism_xb_upload" class="w-100">PROOF</label>
                                    @if(isset($data->employee_certificate->nism_xb_upload) && !empty($data->employee_certificate->nism_xb_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->employee_certificate->nism_xb_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 nism_xb_validity">
                                <div class="form-group">
                                    <label for="nism_xb_validity">VALIDITY </label>
                                    <input type="text" id="nism_xb_validity" class="form-control" value="{{ @$data->employee_certificate->nism_xb_validity }}"
                                        name="nism_xb_validity" aria-describedby="nism_xb_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- CFP CERTIFICATE  -->
                        @if (isset($data->employee_certificate->cfp_no) && !empty($data->employee_certificate->cfp_no))
                        <div class="row" id="cfp_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CFP CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 cfp_no">
                                <div class="form-group">
                                    <label for="cfp_no">CFP CERTIFICATE NUMBER </label>
                                    <input type="text" id="cfp_no" class="form-control" name="cfp_no" value="{{ @$data->employee_certificate->cfp_no }}"
                                        aria-describedby="cfp_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 cfp_upload">
                                <div class="form-group">
                                    <label for="cfp_upload" class="w-100">PROOF</label>
                                    @if(isset($data->employee_certificate->cfp_upload) && !empty($data->employee_certificate->cfp_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->employee_certificate->cfp_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cfp_validity">
                                <div class="form-group">
                                    <label for="cfp_validity">VALIDITY </label>
                                    <input type="text" id="cfp_validity" class="form-control" value="{{ @$data->employee_certificate->cfp_validity }}"
                                        name="cfp_validity" aria-describedby="cfp_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- CWM CERTIFICATE  -->
                        @if (isset($data->employee_certificate->cwm_no) && !empty($data->employee_certificate->cwm_no))
                        <div class="row" id="cwm_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CWM CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 cwm_no">
                                <div class="form-group">
                                    <label for="cwm_no">CWM CERTIFICATE NUMBER </label>
                                    <input type="text" id="cwm_no" class="form-control" name="cwm_no" value="{{ @$data->employee_certificate->cwm_no }}"
                                        aria-describedby="cwm_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 cwm_upload">
                                <div class="form-group">
                                    <label for="cwm_upload" class="w-100">PROOF</label>
                                    @if(isset($data->employee_certificate->cwm_upload) && !empty($data->employee_certificate->cwm_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->employee_certificate->cwm_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cwm_validity">
                                <div class="form-group">
                                    <label for="cwm_validity">VALIDITY </label>
                                    <input type="text" id="cwm_validity" class="form-control" value="{{ @$data->employee_certificate->cwm_validity }}"
                                        name="cwm_validity" aria-describedby="cwm_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- CA CERTIFICATE  -->
                        @if (isset($data->employee_certificate->ca_no) && !empty($data->employee_certificate->ca_no))
                        <div class="row" id="ca_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CA DETAILS</h4>
                            </div>
                            <div class="col-sm-8 ca_no">
                                <div class="form-group">
                                    <label for="ca_no">CA CERTIFICATE NO </label>
                                    <input type="text" id="ca_no" class="form-control" name="ca_no" value="{{ @$data->employee_certificate->ca_no }}"
                                        aria-describedby="ca_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 ca_upload">
                                <div class="form-group">
                                    <label for="ca_upload" class="w-100">PROFF</label>
                                    @if(isset($data->employee_certificate->ca_upload) && !empty($data->employee_certificate->ca_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->employee_certificate->ca_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 ca_validity">
                                <div class="form-group">
                                    <label for="ca_validity">VALIDITY (IF ANY)</label>
                                    <input type="text" id="ca_validity" class="form-control" value="{{ @$data->employee_certificate->ca_validity }}"
                                        name="ca_validity" aria-describedby="ca_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- CS CERTIFICATE  -->
                        @if (isset($data->employee_certificate->cs_no) && !empty($data->employee_certificate->cs_no))
                        <div class="row" id="cs_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CS DETAILS</h4>
                            </div>
                            <div class="col-sm-8 cs_no">
                                <div class="form-group">
                                    <label for="cs_no">CS CERTIFICATE NO </label>
                                    <input type="text" id="cs_no" class="form-control" name="cs_no" value="{{ @$data->employee_certificate->cs_no }}"
                                        aria-describedby="cs_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 cs_upload">
                                <div class="form-group">
                                    <label for="cs_upload" class="w-100">PROOF</label>
                                    @if(isset($data->employee_certificate->cs_upload) && !empty($data->employee_certificate->cs_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->employee_certificate->cs_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cs_validity">
                                <div class="form-group">
                                    <label for="cs_validity">VALIDITY  (IF ANY)</label>
                                    <input type="text" id="cs_validity" class="form-control" value="{{ @$data->employee_certificate->cs_validity }}"
                                        name="cs_validity" aria-describedby="cs_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- OTHER CERTIFICATE  -->
                        @if (isset($data->employee_certificate->course_no) && !empty($data->employee_certificate->course_no))
                        <div class="row" id="course_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">Degree/Course Details</h4>
                            </div>
                            <div class="col-sm-8 course_name">
                                <div class="form-group">
                                    <label for="course_name">Name of Course/Degree </label>
                                    <input type="text" id="course_name" class="form-control" value="{{ @$data->employee_certificate->course_name }}"
                                        name="course_name" aria-describedby="course_name" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 course_upload">
                                <div class="form-group">
                                    <label for="course_upload" class="w-100">PROOF</label>
                                    @if(isset($data->employee_certificate->course_upload) && !empty($data->employee_certificate->course_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->employee_certificate->course_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 course_no">
                                <div class="form-group">
                                    <label for="course_no">COURSE CERTIFICATE NO </label>
                                    <input type="text" id="course_no" class="form-control" value="{{ @$data->employee_certificate->course_no }}"
                                        name="course_no" aria-describedby="course_no" disabled>
                                </div>
                            </div>

                            <div class="col-sm-8 course_validity">
                                <div class="form-group">
                                    <label for="course_validity">VALIDITY (IF ANY)</label>
                                    <input type="text" id="course_validity" class="form-control" value="{{ @$data->employee_certificate->course_validity }}"
                                        name="course_validity" aria-describedby="course_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- End -->
                        <h3 class="card-title">Terms & Conditions</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="entry-content termsx">
                                    <h4><span style="font-weight: 400;">Limitation of Liability</span></h4>
                                    <p><span style="font-weight: 400;">The bootstrap themes shall not be held accountable for any direct, indirect, special, accidental or considerable damages that includes but not bound to, loss of data or profit caused due to use or inability to use the products that we provide under any circumstances, even if the bootstrap themes or legit representative has been considered the possibility of such damages. You are soley held responsible of any costs caused, if your use of materials from this site results in the need for servicing, repair or correction of equipment or data.</span></p>
                                    <h3><span style="font-weight: 400;">Licensing Policy</span></h3>
                                    <p><span style="font-weight: 400;">The Bootstrap themes are released under the GNU General Public License v2 or later.&nbsp;</span><span style="font-weight: 400;">You can use all our themes for personal and commercial use.&nbsp;</span><span style="font-weight: 400;">Please go through the </span><a href="https://thebootstrapthemes.com/licensing-policy/"><span style="font-weight: 400;">licensing policy page</span></a><span style="font-weight: 400;"> for licensing details.</span></p>
                                    <h3><span style="font-weight: 400;">Product Compatibility</span></h3>
                                    <ol>
                                    <li style="font-weight: 400;"><strong>WordPress Themes:</strong><span style="font-weight: 400;"><br>
                                    </span><span style="font-weight: 400;">The products are developed to be compatible with the latest version of WordPress because we always strive to stay up-to-date with the latest version of WordPress. You might experience certain performance or functionality glitches with the products if you use any version prior to that.</span></li>
                                    <li style="font-weight: 400;"><strong>HTML Themes:</strong><span style="font-weight: 400;"><br>
                                    </span><span style="font-weight: 400;">The products designed are developed possess static features. Whereas, in need of forms or any other dynamic features, you will have to code as per your product requirement.</span></li>
                                    </ol>
                                    <h3><span style="font-weight: 400;">Delivery</span></h3>
                                    <p><span style="font-weight: 400;">Any kind of information related to your purchased product(s) will be emailed to the email address that you have provided once we receive your payment. This process usually takes few minutes, but for some issue might get extended to 24 hours. In case you do not receive your email up to the allocated time period, you can contact us through our contact page. Also, you can access the products that you have purchased from your account in the bootstrap theme after logging in.</span></p>
                                    <h3><span style="font-weight: 400;">Ownership</span></h3>
                                    <p><span style="font-weight: 400;">The Bootstrap Themes claims ownership on all of its products. Hence, you may not demand your any kind of proprietorship over any of our products, modified or unmodified. We provide our products without any warranty, as it is. You cannot hold our legit person accountable to any kind of damage including, but not limited to direct, indirect, special, incidental or consequential damages or other losses caused due to inefficiency in using our products.</span></p>
                                    <h3><span style="font-weight: 400;">Browser Compatibility</span></h3>
                                    <p><span style="font-weight: 400;">We are solely concerned with providing the best possible quality in products to our users. Thus, we make it sure that our themes and templates are compatible across most major browsers including the latest version of modern web browsers such as Safari, Firefox, Internet explorer 9+ and Chrome.</span></p>
                                    <h3><span style="font-weight: 400;">Updates</span></h3>
                                    <p><span style="font-weight: 400;">We provide our license holders who have an active and valid subscription and licence key with one click updates. As long as the license key generated from the purchase is valid and active, you can get access to the updates. We have provision of updates for a 1 year time period.</span></p>
                                    <p><span style="font-weight: 400;">We advise you to constantly get updated with the current version of our themes for your usage. Since, we constantly update our themes to be compatible with the latest version of WordPress.</span></p>
                                    <h3><span style="font-weight: 400;">Theme Support</span></h3>
                                    <p><span style="font-weight: 400;">Please go through to </span><a href="https://thebootstrapthemes.com/help-support-policy/"><span style="font-weight: 400;">Help and Support Policy page</span></a><span style="font-weight: 400;"> for further details.</span></p>
                                    <h3><span style="font-weight: 400;">Price Changes</span></h3>
                                    <p><span style="font-weight: 400;">Please be informed that it is our sole right to modify or disallow, permanently or temporarily a subscription at any point of time and from time to time with or without any prior notice.</span></p>
                                    <h3><span style="font-weight: 400;">Refund Policy</span></h3>
                                    <p><span style="font-weight: 400;">Please go through to </span><a href="https://thebootstrapthemes.com/refund-policy/"><span style="font-weight: 400;">Refund Policy page</span></a><span style="font-weight: 400;"> for further details.</span></p>
                                    <h3><span style="font-weight: 400;">Email</span></h3>
                                    <p><span style="font-weight: 400;">We occasionally send you emails concerned with the purchase of the product(s) from our company. We also send you email newsletters concerning the WordPress and bootstrap themes promotions and updates. We assure you that we do not sell or release your email to any third party vendors. You may withdraw your emails at any time without fine or penalty. </span></p>
                                    <h3><span style="font-weight: 400;">License Agreement:</span></h3>
                                    <p><span style="font-weight: 400;">We believe that you have provided your full consent and read and agreed to the Terms and Conditions mentioned and explained on this page while purchasing our product(s). We hold the right to change or modify the present Terms and Conditions solely without any prior consent or notice.</span></p>
                                    <h3><span style="font-weight: 400;">Severability</span></h3>
                                    <p><span style="font-weight: 400;">If any part of this agreement is declared unenforceable or invalid, all remaining clauses in this agreement shall remain binding on the customer.</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 user_agree">
                                <div class="form-group custom-checkbox">
                                    <input type="checkbox" id="user_agree" name="user_agree" value="1" class="form-control">
                                    <label for="user_agree">I agree to terms and Conditions</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="proceed btn btn-primary btn-lg" style="min-width:11rem">Accept</button>
                        <button type="button" class="reject-now btn btn-danger btn-lg float-right" style="min-width:11rem">Reject</button>
                        <input type="hidden" id="userstatus" name="userstatus" value="0">
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
                                            <button type="submit" class="proceed btn btn-primary btn-lg" style="min-width: 11rem">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

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
                        <div class="col-12 d-flex justify-content-center">
                           <img src="" id="show_img" alt="image" class="img-fluid">
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
<script type="text/javascript" src="{{ asset('external/js/employee.js') }}"></script>
<script>

</script>
@endsection
