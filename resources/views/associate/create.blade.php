@extends('layouts.master')

@section('style')
<style>
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

    .edit-now {
        font-size: 12px;
        font-weight: 600;
        font-style: italic;
    }

    .edit-now:hover {
        cursor: pointer;
        color: #1a2b2a;
        text-decoration: underline;
    }

    label[readonly] {
        background-color: #f6f6f6;
        border: 1px solid #a3a3a3;
        cursor: auto;
        pointer-events: none;
    }

    .btn-view {
        border: 1px solid #a3a3a3;
        color: #545454 !important;
        line-height: 1.7 !important;
    }

    .input-group .form-control:disabled,
    .input-group .form-control[readonly] {
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

    .employee,
    .view-item {
        display: none;
    }

    /*Select2 ReadOnly Start*/
    select[readonly].select2-hidden-accessible+.select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__arrow,
    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__clear {
        display: none;
    }

    .select2-container--default .select2-results__option[aria-disabled=true] {
        display: none;
    }

    input[readonly] {
        background-color: #f6f6f6 !important;
    }

    .minor {
        font-size: 80%;
        font-weight: 400;
        color: #ce4b4b;

    }

    /*Select2 ReadOnly End*/
</style>

@endsection

@section('content')
@if (Auth::user()->in_house == 1 || Auth::user()->hasRole('superadmin'))
<div class="container-fluid">
    <div class="section-header mb-4">
        @include('partials.top')
    </div>

    <div class="card w-100">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4">
                    <div class="custom-wrapper">
                        <h3 class="card-title">
                            @if (isset($data->id))
                            Update Associate
                            @else
                            Create New Associate
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
                        //IsParent
                        $isParent = isset($data->id) && isset($data->associate_nominee->is_minor) && $data->associate_nominee->is_minor == 1 ? 'isParent' : null;
                        //$val = isset($data->id) && isset($data->status) && $data->status == 8 ? 'completed ' : null;
                        //$subval = isset($data->id) && isset($data->status) && $data->status == 8 ? 'sub-active sub-completed ' : null;
                        // $val = isset($data->id) ? 'completed ' : null;
                        // $subval = isset($data->id) ? 'sub-active sub-completed ' : null;
                        $val = null;
                        $subval = null;
                        //Check General Information
                        $step1 = isset($data->introducer_id) ? 'completed' : null;
                        $step2 = null; //isset($data->entitytype_id) ? 'completed' : null;
                        $step2_1 = isset($data->pan_no) ? 'sub-active sub-completed' : null;
                        $step2_2 = isset($data->address->pincode) ? 'sub-active sub-completed' : null;
                        $step2_3 = isset($data->ifsc_no) ? 'sub-active sub-completed' : null;
                        $step2_4 = isset($data->primary_color) && $step2_3 == 'sub-active sub-completed' ? 'sub-active sub-completed' : null;

                        $step3 = isset($data->pan_no) ? 'completed' : null;
                        $step4 = isset($data->address->pincode) ? 'completed' : null;
                        $step5 = isset($data->ifsc_no) ? 'completed' : null;
                        $step6 = isset($data->primary_color) && $step5 == 'completed' ? 'completed' : null;

                        if ($step3 == 'completed' && $step4 == 'completed' && $step5 == 'completed' && $step6 == 'completed') {
                        $step2 = 'completed';
                        }

                        if (isset($data->entitytype_id) && !empty($data->entitytype_id)) {
                        if ($data->status == 1) {
                        $step2 = 'completed';
                        }
                        }

                        $step7 = isset($data->associate_licence->arn_rgn_no) || isset($data->associate_licence->ria_rgn_no) ? 'completed' : null;
                        $step8 = null;
                        if (isset($data->associate_certificate->nism_va_no) && !empty($data->associate_certificate->nism_va_no)) {
                        $step8 = 'completed';
                        } elseif (isset($data->associate_certificate->nism_xa_no) && !empty($data->associate_certificate->nism_xa_no)) {
                        $step8 = 'completed';
                        } elseif (isset($data->associate_certificate->nism_xb_no) && !empty($data->associate_certificate->nism_xb_no)) {
                        $step8 = 'completed';
                        } elseif (isset($data->associate_certificate->cfp_no) && !empty($data->associate_certificate->cfp_no)) {
                        $step8 = 'completed';
                        } elseif (isset($data->associate_certificate->cwm_no) && !empty($data->associate_certificate->cwm_no)) {
                        $step8 = 'completed';
                        } elseif (isset($data->associate_certificate->ca_no) && !empty($data->associate_certificate->ca_no)) {
                        $step8 = 'completed';
                        } elseif (isset($data->associate_certificate->cs_no) && !empty($data->associate_certificate->cs_no)) {
                        $step8 = 'completed';
                        } elseif (isset($data->associate_certificate->course_no) && !empty($data->associate_certificate->course_no)) {
                        $step8 = 'completed';
                        } else {
                        $step8 = null;
                        }

                        $step9 = isset($data->associate_nominee->nominee_name) ? 'completed' : null;
                        $step9_1 = isset($data->id) && isset($data->associate_nominee->assoicate_guardian->guardian_name) && $data->associate_nominee->is_minor == 1 ? 'sub-active sub-completed' : null;
                        $step10 = isset($data->associate_nominee->assoicate_guardian->guardian_name) ? 'completed' : null;
                        $step11 = isset($data->equitymf_bps) ? 'completed' : null;
                        if (isset($data->status) && ($data->status == 10 || $data->status == 8)) {
                        $step12 = isset($data->bse_upload) && $data->bse_upload == 1 ? 'completed' : null;
                        }

                        @endphp
                        <ul class="form-lists">
                            <li data-form="general-information" class="{{ $step1 }} active">
                                <div class="indicator">
                                    <div class="check"></div>
                                </div>
                                General Information
                            </li>
                            <li data-form="entity-detail" class="{{ $step2 }} isParent">
                                <div class="indicator">
                                    <div class="check"></div>
                                </div>
                                Entity Details
                                <ul>
                                    <li class="{{ $step2_1 }} isChild" data-form="photo-detail">Photo ID
                                        Details
                                    </li>
                                    <li class="{{ $step2_1 }} isChild" data-form="address-detail">Address
                                        Details
                                    </li>
                                    <li class="{{ $step2_3 }} isChild" data-form="bank-detail">Bank Details
                                    </li>
                                    <li class="{{ $step2_4 }} isChild" data-form="other-detail">Other Details
                                    </li>
                                </ul>
                            </li>
                            <!-- <li data-form="bank-detail">
                                                <div class="indicator">
                                                    <div class="check"></div>
                                                </div>
                                                Bank Details
                                            </li> -->
                            <li data-form="license-detail" class="{{ $step7 }}">
                                <div class="indicator">
                                    <div class="check"></div>
                                </div>
                                License Details
                            </li>
                            <li data-form="euin-detail" class="{{ $step8 }}">
                                <div class="indicator">
                                    <div class="check"></div>
                                </div>
                                Certification
                            </li>
                            <li data-form="nominee-detail" class="{{ $step9 }} {{ $isParent }}" id="menu_nominee">
                                <div class="indicator">
                                    <div class="check"></div>
                                </div>
                                Nominee
                                <ul>
                                    <li class="{{ $step9_1 }} isChild" data-form="guardian-detail">Guardian
                                    </li>
                                </ul>
                            </li>
                            <li data-form="commercial-detail" class="{{ $step11 }}">
                                <div class="indicator">
                                    <div class="check"></div>
                                </div>
                                Commercials
                            </li>
                            @if (isset($data->status) && ($data->status == 10 || $data->status == 8))
                            <li data-form="bse-detail" class="{{ $step12 }}">
                                <div class="indicator">
                                    <div class="check"></div>
                                </div>
                                Download
                            </li>

                            @endif
                        </ul>
                    </div>
                </div>

                <form class="col-lg-8 col-xl-9 step-forms col-md-8 pl-0" enctype="multipart/form-data" id="form-information" method="POST" action="{{ route('associate.store') }}">
                    @csrf

                    <input type="hidden" name="step" value="1">
                    <input type="hidden" name="step_edit" id="step_edit" value="0">
                    <input type="hidden" name="associate_id" id="associate_id" value="{{ @$data->id }}">
                    <input type="hidden" name="status" value="{{ isset($data->status) ? $data->status : 1 }}">
                    <input type="hidden" name="associate_edit" id="associate_edit" value="{{ isset($data->id) ? 1 : 0 }}">
                    <input type="hidden" name="business_code" id="business_code" value="{{ @$data->business_tag }}">
                    <section class="trial {{ $step1 }} active" id="general-information" data-step="1" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"> General Information
                                    @if ($step1 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row flex-column">
                                            <input type="hidden" name="has_employee" id="has_employee" value="0">

                                            <div class="col-sm-8 introducer_id">

                                                <div class="form-group">
                                                    <!--List of Employee for Selected Associate-->
                                                    <label for="introducer_id">Introduced by <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="introducer_id" name="introducer_id">
                                                            <option value="" @if (!isset($data->introducer_id)) {{ 'disabled selected' }} @endif>Select Introduced By</option>
                                                            @empty($associates)
                                                            <option value="1">Self</option>
                                                            @else
                                                            @foreach ($associates as $associate)
                                                            <option value="{{ $associate->id }}" @if (isset($data->introducer_id) && $data->introducer_id == $associate->id) {{ 'selected' }} @endif>{{ $associate->entity_name }}</option>
                                                            @endforeach
                                                            @endempty
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 employee_id @if (!isset($data->employee_id) && empty($data->employee_id)) employee @endif">
                                                <div class="form-group">
                                                    <!--List of Employee for Selected Associate-->
                                                    <label for="employee_id">Introducer-Employee Name <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="employee_id" name="employee_id">
                                                            <option value="" disabled selected>Select Employee
                                                            </option>
                                                            @if (isset($data->employee_id) && !empty($data->employee_id))
                                                            @foreach ($data->salesemployees as $employee)
                                                            <option value="{{ $employee->id }}" @if (isset($data->employee_id) && $data->employee_id == $employee->id) {{ 'selected' }} @endif>{{ $employee->name }}
                                                            </option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 profession_id">
                                                <div class="form-group">
                                                    <label for="profession_id">Profession of the introducee <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="profession_id" name="profession_id">
                                                            <option value="" @if (!isset($data->profession_id)) {{ 'disabled selected' }} @endif>Select Profession</option>
                                                            @foreach ($professions as $profession)
                                                            <option value="{{ $profession->id }}" @if (isset($data->profession_id) && $data->profession_id == $profession->id) {{ 'selected' }} @endif>{{ $profession->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 business_tag">
                                                <div class="form-group">
                                                    <label for="business_tag">Business Tag <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="business_tag" name="business_tag">
                                                            <option value="" @if (!isset($data->business_tag)) {{ 'disabled selected' }} @endif>Select Business Tag
                                                            </option>
                                                            <option value="0" @if (isset($data->business_tag) && $data->business_tag == 0) {{ 'selected' }} @endif>
                                                                Self</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-3 d-none d-lg-flex">
                                        <lottie-player src="/assets/images/data.json" background="transparent" speed="1" style="height: 300px;" loop autoplay></lottie-player>
                                    </div>
                                </div>

                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step2 }} " id="entity-detail" data-step="2" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Entity Details
                                    @if ($step2 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @elseif(!empty($data->entitytype_id) && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row flex-column">
                                            <div class="col-sm-8 entitytype_id">
                                                <div class="form-group">
                                                    <label for="entitytype_id">Entity Type <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="entitytype_id" name="entitytype_id" data-minimum-results-for-search="Infinity">
                                                            <option value="" @if (!isset($data->entitytype_id)) {{ 'disabled selected' }} @endif>
                                                                Select
                                                                Entity Type</option>
                                                            @foreach ($entitytypes as $entitytype)
                                                            <option value="{{ $entitytype->id }}" @if (isset($data->entitytype_id) && $data->entitytype_id == $entitytype->id) {{ 'selected' }} @endif>
                                                                {{ $entitytype->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 entity_name">
                                                <div class="form-group">
                                                    <label for="entity_name">Entity Name (As per Pancard) <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="entity_name" aria-describedby="entity_name" name="entity_name" value="{{ @$data->entity_name }}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 authorised_person1">
                                                <div class="form-group">
                                                    <label for="authorised_person1">Authorised Person 1 <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="authorised_person1" aria-describedby="authorised_person1" name="authorised_person1" value="{{ @$data->authorised_person1 }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 authorised_email1">
                                                <div class="form-group">
                                                    <label for="authorised_email1">Email 1 <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="authorised_email1" aria-describedby="authorised_email1" name="authorised_email1" value="{{ @$data->authorised_email1 }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 authorised_person2">
                                                <div class="form-group">
                                                    <label for="authorised_person2">Authorised Person 2 <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="authorised_person2" aria-describedby="authorised_person2" name="authorised_person2" value="{{ @$data->authorised_person2 }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 authorised_email2">
                                                <div class="form-group">
                                                    <label for="authorised_email2">Email 2 <span class="required-sign">*</span></label>
                                                    <input type="email" class="form-control" id="authorised_email2" aria-describedby="authorised_email2" name="authorised_email2" value="{{ @$data->authorised_email2 }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 authorised_person3">
                                                <div class="form-group">
                                                    <label for="authorised_person3">Authorised Person 3</label>
                                                    <input type="text" class="form-control text-capitalize" id="authorised_person3" aria-describedby="authorised_person3" name="authorised_person3" value="{{ @$data->authorised_person3 }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group authorised_email3">
                                                    <label for="authorised_email3">Email 3</label>
                                                    <input type="email" class="form-control" id="authorised_email3" aria-describedby="authorised_email3" name="authorised_email3" value="{{ @$data->authorised_email3 }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step3 }}" id="photo-detail" data-step="3" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Photo ID Details
                                    @if ($step3 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row">
                                            <!-- For Individual Case :: Name, PANCARD NUMBER, AADHAR CARD NUMBER, Date of Birth field is require-->
                                            <div class="col-sm-8 name">
                                                <div class="form-group">
                                                    <label for="name">Name (As per Pancard) <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="name" name="name" aria-describedby="name" value="{{ @$data->entity_name }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->photo_upload) && !empty($data->photo_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->photo_upload) && !empty($data->photo_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->photo_upload }}')" data-src="{{ $data->photo_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 pan_no">
                                                <div class="form-group">
                                                    <label for="pan_no">PANCARD NUMBER <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no" aria-describedby="pan_no" value="{{ @$data->pan_no }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->pan_upload) && !empty($data->pan_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->pan_upload) && !empty($data->pan_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->pan_upload }}')" data-src="{{ $data->pan_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 aadhar_no">
                                                <div class="form-group">
                                                    <label for="aadhar_no">AADHAR CARD NUMBER <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" aria-describedby="aadhar_no" value="{{ @$data->aadhar_no }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->aadhar_upload) && !empty($data->aadhar_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->aadhar_upload) && !empty($data->aadhar_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->aadhar_upload }}')" data-src="{{ $data->aadhar_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 birth_incorp_date">
                                                <div class="form-group">
                                                    <label for="birth_incorp_date"><span id="birth_incorp_date">Date of
                                                            Birth</span> <span class="required-sign">*</span></label>
                                                    <input type="text" name="birth_incorp_date" class="form-control" id="birth_incorp_date" aria-describedby="birth_incorp_date" value="{{ @$data->birth_incorp_date }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step4 }}" id="address-detail" data-step="4" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <!-- If Selected Individual on Entity Type, then Address 1, Address 2, Address 3, City, State, Country, Pincode,Mobile Number,Telephone No,Email Address Require -->
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Address Details
                                    @if ($step4 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <input type="hidden" name="state_code" id="state_code" value="{{ @$data->address->state }}">
                                        <div class="row">
                                            <div class="col-sm-12 address1">
                                                <div class="form-group ">
                                                    <label for="address1">Address 1 <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="address1" value="{{ @$data->address->address1 }}" aria-describedby="address1" name="address1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 address2">
                                                <div class="form-group ">
                                                    <label for="address2">Address 2 <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="address2" value="{{ @$data->address->address2 }}" aria-describedby="address2" name="address2">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 address3">
                                                <div class="form-group">
                                                    <label for="address3">Address 3</label>
                                                    <input type="text" class="form-control text-capitalize" id="address3" value="{{ @$data->address->address3 }}" aria-describedby="address3" name="address3">
                                                </div>
                                            </div>


                                            <div class="col-sm-6 city">
                                                <div class="form-group">
                                                    <label for="city">City <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="city" value="{{ @$data->address->city }}" aria-describedby="city" name="city">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 state">
                                                <div class="form-group">
                                                    <label for="state">State <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="state" name="state">
                                                            <option value="" disabled selected>Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 country">
                                                <div class="form-group">
                                                    <label for="country">Country <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="country" name="country">
                                                            <option value="" disabled selected>Select Country</option>
                                                            @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}" @if (isset($data->address->country) && $country->id == $data->address->country) {{ 'selected' }} @elseif($country->id == 98) {{ 'selected' }} @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 pincode">
                                                <div class="form-group">
                                                    <label for="pincode">Pincode <span class="required-sign">*</span></label>
                                                    <input type="text" id="pincode" class="form-control" value="{{ @$data->address->pincode }}" aria-describedby="pincode" name="pincode">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 address_upload">
                                                <input type="hidden" name="is_address_upload" value="{{ isset($data->address->address_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="address_upload" class="w-100">PROOF
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="address_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="address_upload" type="file" name="address_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->address->address_upload) && !empty($data->address->address_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->address->address_upload) && !empty($data->address->address_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->address->address_upload }}')" data-src="{{ $data->address->address_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mobile">
                                                <div class="form-group">
                                                    <label for="mobile">Mobile Number <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="mobile" value="{{ @$data->mobile }}" aria-describedby="mobile" name="mobile">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 telephone">
                                                <div class="form-group">
                                                    <label for="telephone">TELEPHONE NO</label>
                                                    <input type="text" class="form-control" id="telephone" value="{{ @$data->telephone }}" aria-describedby="telephone" name="telephone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 email">
                                                <div class="form-group">
                                                    <label for="email">EMAIL ADDRESS <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="email" value="{{ @$data->email }}" aria-describedby="email" name="email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step5 }}" id="bank-detail" data-step="5" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Bank Details
                                    @if ($step5 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row">
                                            <div class="col-sm-12 mdf_ria">
                                                <h4 class="card-title">MFD Bank Details</h4>
                                            </div>
                                            <div class="col-sm-8 ifsc_no">
                                                <div class="form-group">
                                                    <label for="ifsc_no">IFSC Number <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-uppercase" id="ifsc_no" name="ifsc_no" value="{{ @$data->ifsc_no }}" aria-describedby="ifsc_no">
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
                                                            <span class="default-text">
                                                                @if (isset($data->cheque_upload) && !empty($data->cheque_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->cheque_upload) && !empty($data->cheque_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->cheque_upload }}')" data-src="{{ $data->cheque_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 bank_name">
                                                <div class="form-group">
                                                    <label for="bank_name">Bank Name <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control  text-capitalize" id="bank_name" value="{{ @$data->bank_name }}" name="bank_name" aria-describedby="bank_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 branch_name">
                                                <div class="form-group">
                                                    <label for="branch_name">Branch <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="branch_name" value="{{ @$data->branch_name }}" name="branch_name" aria-describedby="branch_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 micr">
                                                <div class="form-group">
                                                    <label for="micr">MICR <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="micr" name="micr" value="{{ @$data->micr }}" aria-describedby="micr" placeholder="Enter MICR">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 account_type">
                                                <div class="form-group">
                                                    <label for="account_type">Account Type <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="account_type" name="account_type">
                                                            <option value="" @if (!isset($data->account_type)) {{ 'disabled selected' }} @endif>
                                                                Select
                                                                Account Type
                                                            </option>
                                                            <option value="Saving" @if (isset($data->account_type) && $data->account_type == 'Saving') {{ 'selected' }} @endif>Saving
                                                                Account
                                                            </option>
                                                            <option value="Current" @if (isset($data->account_type) && $data->account_type == 'Current') {{ 'selected' }} @endif>Current
                                                                Account
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 account_no">
                                                <div class="form-group">
                                                    <label for="account_no">Account Number <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="account_no" value="{{ @$data->account_no }}" aria-describedby="account_no" name="account_no">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="mfd_ria_bank">
                                            <input type="hidden" name="is_mfd_ria_cheque_upload" value="{{ isset($data->mfd_ria_cheque_upload) ? 1 : 0 }}">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">RIA Bank Details</h4>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_ifsc_no">
                                                <div class="form-group">
                                                    <label for="mfd_ria_ifsc_no">IFSC Number <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-uppercase" id="mfd_ria_ifsc_no" name="mfd_ria_ifsc_no" value="{{ @$data->mfd_ria_ifsc_no }}" aria-describedby="mfd_ria_ifsc_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 mfd_ria_cheque_upload">
                                                <div class="form-group">
                                                    <label for="mfd_ria_cheque_upload" class="w-100">PROOF
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="mfd_ria_cheque_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="mfd_ria_cheque_upload" type="file" name="mfd_ria_cheque_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->mfd_ria_cheque_upload) && !empty($data->mfd_ria_cheque_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->mfd_ria_cheque_upload) && !empty($data->mfd_ria_cheque_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->mfd_ria_cheque_upload }}')" data-src="{{ $data->mfd_ria_cheque_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_bank_name">
                                                <div class="form-group">
                                                    <label for="mfd_ria_bank_name">Bank Name <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_bank_name" value="{{ @$data->mfd_ria_bank_name }}" name="mfd_ria_bank_name" aria-describedby="mfd_ria_bank_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_branch_name">
                                                <div class="form-group">
                                                    <label for="mfd_ria_branch_name">Branch <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_branch_name" value="{{ @$data->mfd_ria_branch_name }}" name="mfd_ria_branch_name" aria-describedby="mfd_ria_branch_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_micr">
                                                <div class="form-group">
                                                    <label for="mfd_ria_micr">MICR <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_micr" name="mfd_ria_micr" value="{{ @$data->mfd_ria_micr }}" aria-describedby="mfd_ria_micr" placeholder="Enter MICR">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_account_type">
                                                <div class="form-group">
                                                    <label for="mfd_ria_account_type">Account Type <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="mfd_ria_account_type" name="mfd_ria_account_type">
                                                            <option value="" @if (!isset($data->mfd_ria_account_type)) {{ 'disabled selected' }} @endif>
                                                                Select
                                                                Account Type
                                                            </option>
                                                            <option value="Saving" @if (isset($data->mfd_ria_account_type) && $data->mfd_ria_account_type == 'Saving') {{ 'selected' }} @endif>Saving
                                                                Account
                                                            </option>
                                                            <option value="Current" @if (isset($data->mfd_ria_account_type) && $data->mfd_ria_account_type == 'Current') {{ 'selected' }} @endif>Current
                                                                Account
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_account_no">
                                                <div class="form-group">
                                                    <label for="mfd_ria_account_no">Account Number <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="mfd_ria_account_no" value="{{ @$data->mfd_ria_account_no }}" aria-describedby="mfd_ria_account_no" name="mfd_ria_account_no">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step6 }}" id="other-detail" data-step="6" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Other Details
                                    @if ($step6 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row" id="gst_details">
                                            <div class="col-sm-12">
                                                <h4 class="form-group">
                                                    GST Details
                                                </h4>
                                            </div>
                                            <div class="col-sm-8 gst_no">
                                                <div class="form-group">
                                                    <label for="gst_no">GST Number</label>
                                                    <input type="text" class="form-control text-uppercase" id="gst_no" name="gst_no" value="{{ @$data->gst_no }}" aria-describedby="gst_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 gst_upload">
                                                <input type="hidden" name="is_gst_upload" value="{{ isset($data->gst_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="gst_upload" class="w-100">PROOF
                                                        <span class="required-sign">*</span>
                                                        @if (isset($data->gst_upload) && !empty($data->gst_upload))
                                                        <span class="float-right text-lowercase font-italic"><a href="javascript:showImage('{{ $data->gst_upload }}')" data-src="{{ $data->gst_upload }}">Preview</a></span>
                                                        @endif
                                                    </label>
                                                    <label for="gst_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="gst_upload" type="file" name="gst_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->gst_upload) && !empty($data->gst_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->gst_upload) && !empty($data->gst_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->gst_upload }}')" data-src="{{ $data->gst_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 gst_validity">
                                                <div class="form-group">
                                                    <label for="gst_validity">VALIDITY (If ANY)</label>
                                                    <input type="text" class="form-control" id="gst_validity" value="{{ @$data->gst_validity }}" name="gst_validity" aria-describedby="gst_validity">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="shop_est_details">
                                            <div class="col-sm-12">
                                                <h4>SHOP & ESTABLISHMENT Details </h4>
                                            </div>
                                            <div class="col-sm-8 shop_est_no">
                                                <div class="form-group">
                                                    <label for="shop_est_no">SHOP & ESTABLISHMENT CERTIFICATE NO <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="shop_est_no" value="{{ @$data->shop_est_no }}" aria-describedby="shop_est_no" name="shop_est_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 shop_est_upload">
                                                <input type="hidden" name="is_shop_est_upload" value="{{ isset($data->shop_est_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="shop_est_upload" class="w-100">PROOF
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="shop_est_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="shop_est_upload" type="file" name="shop_est_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->shop_est_upload) && !empty($data->shop_est_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->shop_est_upload) && !empty($data->shop_est_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->shop_est_upload }}')" data-src="{{ $data->shop_est_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 shop_est_validity">
                                                <div class="form-group">
                                                    <label for="shop_est_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="shop_est_validity" value="{{ @$data->shop_est_validity }}" name="shop_est_validity" aria-describedby="gst_validity">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="pd_details">
                                            <div class="col-sm-12">
                                                <h4>
                                                    PARTNERSHIP FIRM Details
                                                </h4>
                                            </div>
                                            <div class="col-sm-6 pd_upload">
                                                <input type="hidden" name="is_pd_upload" value="{{ isset($data->pd_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="pd_upload" class="w-100">PARTNERSHIP DEEP
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="pd_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="pd_upload" type="file" name="pd_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->pd_upload) && !empty($data->pd_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->pd_upload) && !empty($data->pd_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->pd_upload }}')" data-src="{{ $data->pd_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 pd_asl_upload">
                                                <input type="hidden" name="is_pd_asl_upload" value="{{ isset($data->pd_asl_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="pd_asl_upload" class="w-100">AUTHORIZED SIGNATORY LIST
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="pd_asl_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="pd_asl_upload" type="file" name="pd_asl_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->pd_asl_upload) && !empty($data->pd_asl_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->pd_asl_upload) && !empty($data->pd_asl_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->pd_asl_upload }}')" data-src="{{ $data->pd_asl_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 pd_coi_upload">
                                                <input type="hidden" name="is_pd_coi_upload" value="{{ isset($data->pd_coi_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="pd_coi_upload" class="w-100">CERTIFICATE OF INCORPORATION
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="pd_coi_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="pd_coi_upload" type="file" name="pd_coi_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->pd_coi_upload) && !empty($data->pd_coi_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->pd_coi_upload) && !empty($data->pd_coi_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->pd_coi_upload }}')" data-src="{{ $data->pd_coi_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="co_details">
                                            <div class="col-sm-12">
                                                <h4>
                                                    CORPORATE Details
                                                </h4>
                                            </div>
                                            <div class="col-sm-6 co_moa_upload">
                                                <input type="hidden" name="is_co_moa_upload" value="{{ isset($data->co_moa_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="co_moa_upload" class="w-100">MEMORANDUM OF ASSOCIATION
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="co_moa_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="co_moa_upload" type="file" name="co_moa_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->co_moa_upload) && !empty($data->co_moa_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->co_moa_upload) && !empty($data->co_moa_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->co_moa_upload }}')" data-src="{{ $data->co_moa_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 co_aoa_upload">
                                                <input type="hidden" name="is_co_aoa_upload" value="{{ isset($data->co_aoa_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="co_aoa_upload" class="w-100">ARTICLE OF ASSOCIATION
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="co_aoa_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="co_aoa_upload" type="file" name="co_aoa_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->co_aoa_upload) && !empty($data->co_aoa_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->co_aoa_upload) && !empty($data->co_aoa_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->co_aoa_upload }}')" data-src="{{ $data->co_aoa_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 co_coi_upload">
                                                <input type="hidden" name="is_co_coi_upload" value="{{ isset($data->co_coi_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="co_coi_upload" class="w-100">CERTIFICATE OF INCORPORATION
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="co_coi_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="co_coi_upload" type="file" name="co_coi_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->co_coi_upload) && !empty($data->co_coi_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->co_coi_upload) && !empty($data->co_coi_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->co_coi_upload }}')" data-src="{{ $data->co_coi_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 co_asl_upload">
                                                <input type="hidden" name="is_co_asl_upload" value="{{ isset($data->co_asl_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="co_asl_upload" class="w-100">AUTHORIZED SIGNATORY LIST
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="co_asl_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="co_asl_upload" type="file" name="co_asl_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->co_asl_upload) && !empty($data->co_asl_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->co_asl_upload) && !empty($data->co_asl_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->co_asl_upload }}')" data-src="{{ $data->co_asl_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 co_br_upload">
                                                <input type="hidden" name="is_co_br_upload" value="{{ isset($data->co_br_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="co_br_upload" class="w-100">BOARD RESOLUTION
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="co_br_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="co_br_upload" type="file" name="co_br_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->co_br_upload) && !empty($data->co_br_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->co_br_upload) && !empty($data->co_br_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->co_br_upload }}')" data-src="{{ $data->co_br_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="white_labeling">
                                            <div class="col-sm-12">
                                                <h3 class="card-title">
                                                    White Labelling
                                                </h3>
                                            </div>
                                            <div class="col-sm-8 primary_color">
                                                <div class="form-group">
                                                    <label for="primary_color">Primary Color</label>
                                                    <input type="text" class="form-control" name="primary_color" value="{{ @$data->primary_color }}" id="primary_color" aria-describedby="primary_color" placeholder="Primary Color">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 logo_upload">
                                                <div class="form-group">
                                                    <label for="logo_upload" class="w-100">Logo
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="logo_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="logo_upload" type="file" name="logo_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->logo_upload) && !empty($data->logo_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->logo_upload) && !empty($data->logo_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->logo_upload }}')" data-src="{{ $data->logo_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 secondary_color">
                                                <div class="form-group">
                                                    <label for="secondary_color">Secondary Color</label>
                                                    <input type="text" class="form-control" name="secondary_color" value="{{ @$data->secondary_color }}" id="secondary_color" aria-describedby="secondary_color" placeholder="Secondary Color">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step7 }}" id="license-detail" data-step="7" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> License Details
                                    @if ($step7 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <!-- Section Start for ARN -->
                                        <!-- If "PROFESSION" Selected :: MFD -->
                                        <div class="row" id="arn_details">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">AMFI Details</h4>
                                            </div>
                                            <div class="col-sm-8 arn_name">
                                                <div class="form-group">
                                                    <label for="arn_name">NAME AS PER ARN <span class="required-sign">*</span></label>
                                                    <input type="text" id="arn_name" class="form-control text-capitalize" value="{{ @$data->associate_licence->arn_name }}" name="arn_name" aria-describedby="arn_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 arn_upload">
                                                <input type="hidden" name="is_arn_upload" value="{{ isset($data->associate_licence->arn_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="arn_upload" class="w-100">PROOF <span class="required-sign">*</span></label>
                                                    <label for="arn_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="arn_upload" type="file" name="arn_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->associate_licence->arn_upload) && !empty($data->associate_licence->arn_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_licence->arn_upload) && !empty($data->associate_licence->arn_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_licence->arn_upload }}')" data-src="{{ $data->associate_licence->arn_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4 arn_view">
                                                <div class="form-group">
                                                    <label for="arn_view" class="w-100">PROOF</label>
                                                    <label for="arn_view" class="btn input-btn btn-view w-100">
                                                        <input id="arn_view" type="button" @if (isset($data->arn_upload) && !empty($data->arn_upload)) onclick="showImage('{{ @$data->arn_upload }}')" @endif name="arn_view" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->arn_upload) && !empty($data->arn_upload))
                                                                View Copy @else Not Uploaded @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 arn_rgn_no">
                                                <div class="form-group">
                                                    <label for="arn_rgn_no">ARN REGISTRATION NUMBER <span class="required-sign">*</span></label>
                                                    <div class="input-group exclude">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">ARN- &ensp;</span>
                                                        </div>
                                                        <input type="text" id="arn_rgn_no" class="form-control" name="arn_rgn_no" value="{{ @$data->associate_licence->arn_rgn_no }}" aria-describedby="arn_rgn_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 arn_validity">
                                                <div class="form-group">
                                                    <label for="arn_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" id="arn_validity" class="form-control" value="{{ @$data->associate_licence->arn_validity }}" name="arn_validity" aria-describedby="arn_validity">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- EUIN Details -->
                                        <div class="row" id="euin_details">
                                            <div class="col-sm-12">
                                                <!--<h3 class="card-title">EUIN</h3>-->
                                                <h4 class="card-title">EUIN</h4>
                                            </div>
                                            <div class="col-sm-8 euin_name">
                                                <div class="form-group">
                                                    <label for="euin_name">Name of EUIN Holder <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="euin_name" value="{{ @$data->associate_licence->euin_name }}" name="euin_name" aria-describedby="euin_name" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4 euin_upload">
                                                <input type="hidden" name="is_euin_upload" value="{{ isset($data->associate_licence->euin_upload) ? 1 : 0 }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->associate_licence->euin_upload) && !empty($data->associate_licence->euin_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_licence->euin_upload) && !empty($data->associate_licence->euin_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_licence->euin_upload }}')" data-src="{{ $data->associate_licence->euin_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4 euin_view">
                                                <div class="form-group">
                                                    <label for="euin_view" class="w-100">PROOF</label>
                                                    <label for="euin_view" class="btn input-btn btn-view w-100">
                                                        <input id="euin_view" type="button" @if (isset($data->euin_upload) && !empty($data->euin_upload)) onclick="showImage('{{ @$data->euin_upload }}')" @endif name="euin_view" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->euin_upload) && !empty($data->euin_upload))
                                                                View Copy @else Not Uploaded @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 euin_no">
                                                <div class="form-group">
                                                    <label for="euin_no">EUIN Number <span class="required-sign">*</span></label>
                                                    <div class="input-group exclude">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">E &ensp;</span>
                                                        </div>
                                                        <input type="text" id="euin_no" class="form-control" name="euin_no" value="{{ @$data->associate_licence->euin_no }}" aria-describedby="euin_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 euin_validity">
                                                <div class="form-group">
                                                    <label for="euin_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" id="euin_validity" class="form-control" value="{{ @$data->associate_licence->euin_validity }}" name="euin_validity" aria-describedby="euin_validity">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- END -->
                                        <!-- Section Start for RIA -->
                                        <!-- If "PROFESSION" Selected :: RIA -->
                                        <div class="row" id="ria_details">
                                            <div class="col-sm-12">
                                                <!--<h3 class="card-title">EUIN</h3>-->
                                                <h4 class="card-title">SEBI RIA Details</h4>
                                            </div>
                                            <div class="col-sm-8 ria_name">
                                                <div class="form-group">
                                                    <label for="ria_name">NAME AS PER RIA <span class="required-sign">*</span></label>
                                                    <div class="input-group exclude">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">INA &ensp;</span>
                                                        </div>
                                                        <input type="text" id="ria_name" name="ria_name" value="{{ @$data->associate_licence->ria_name }}" class="form-control text-capitalize">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ria_upload">
                                                <input type="hidden" name="is_ria_upload" value="{{ isset($data->associate_licence->ria_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="ria_upload" class="w-100">PROOF
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="ria_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="ria_upload" type="file" name="ria_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->associate_licence->ria_upload) && !empty($data->associate_licence->ria_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_licence->ria_upload) && !empty($data->associate_licence->ria_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_licence->ria_upload }}')" data-src="{{ $data->associate_licence->ria_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ria_view">
                                                <div class="form-group">
                                                    <label for="ria_view" class="w-100">PROOF</label>
                                                    <label for="ria_view" class="btn input-btn btn-view w-100">
                                                        <input id="ria_view" type="button" @if (isset($data->ria_upload) && !empty($data->ria_upload)) onclick="showImage('{{ @$data->ria_upload }}')" @endif name="ria_view" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->ria_upload) && !empty($data->ria_upload))
                                                                View Copy @else Not Uploaded @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ria_rgn_no">
                                                <div class="form-group">
                                                    <label for="ria_rgn_no">SEBI REGISTRATION NUMBER <span class="required-sign">*</span></label>
                                                    <div class="input-group exclude">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">RIA &ensp;</span>
                                                        </div>
                                                        <input type="text" id="ria_rgn_no" class="form-control" name="ria_rgn_no" value="{{ @$data->associate_licence->ria_rgn_no }}" aria-describedby="ria_rgn_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ria_validity">
                                                <div class="form-group">
                                                    <label for="ria_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" id="ria_validity" class="form-control" value="{{ @$data->associate_licence->ria_validity }}" name="ria_validity" aria-describedby="ria_validity">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- END -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step8 }}" id="euin-detail" data-step="8" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <!-- NISM VA CERTIFICATE  -->
                                <!-- If "PROFESSION" Selected :: MFD -->
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Certification
                                    @if ($step8 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row" id="nism_va_details">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">NISM VA CERTIFICATE</h4>
                                            </div>
                                            <div class="col-sm-8 nism_va_no">
                                                <div class="form-group">
                                                    <label for="nism_va_no">NISM VA CERTIFICATE NUMBER <span class="required-sign">*</span></label>
                                                    <input type="text" id="nism_va_no" class="form-control" value="{{ @$data->associate_certificate->nism_va_no }}" name="nism_va_no" aria-describedby="nism_va_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 nism_va_upload">
                                                <input type="hidden" name="is_nism_va_upload" value="{{ isset($data->associate_certificate->nism_va_upload) ? 1 : 0 }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->associate_certificate->nism_va_upload) && !empty($data->associate_certificate->nism_va_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_certificate->nism_va_upload) && !empty($data->associate_certificate->nism_va_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_certificate->nism_va_upload }}')" data-src="{{ $data->associate_certificate->nism_va_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 nism_va_validity">
                                                <div class="form-group">
                                                    <label for="nism_va_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" id="nism_va_validity" class="form-control" value="{{ @$data->associate_certificate->nism_va_validity }}" name="nism_va_validity" aria-describedby="nism_va_validity">

                                                </div>
                                            </div>
                                        </div>


                                        <!-- End -->

                                        <!-- If "PROFESSION" Selected :: RIA -->
                                        <div class="row flex-column" id="ria_type">
                                            <div class="col-sm-8 ria_certificate_type">
                                                <div class="form-group">
                                                    <label for="ria_certificate_type">Certification Type <span class="required-sign">*</span></label>
                                                    <div class="dropdown customMulti">
                                                        <a class="dropdown-toggle select-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-grey">Select Year</span>
                                                        </a>
                                                        <div id="ria_certificate_type" class="dropdown-menu dropdown-menu-left select-dropdown-list">
                                                            @php
                                                            $nism = 0;
                                                            $cfp = 0;
                                                            $cwm = 0;
                                                            if (isset($data->associate_certificate->ria_certificate_type) && !empty($data->associate_certificate->ria_certificate_type)) {
                                                            $cdata = json_decode($data->associate_certificate->ria_certificate_type);

                                                            if (is_array($cdata)) {
                                                            if (in_array('nism', $cdata)) {
                                                            $nism = 1;
                                                            }
                                                            if (in_array('cfp', $cdata)) {
                                                            $cfp = 1;
                                                            }
                                                            if (in_array('nism', $cdata)) {
                                                            $nism = 1;
                                                            }
                                                            }
                                                            }
                                                            @endphp
                                                            <input type="hidden" name="ria_type_nism" value="@if ($nism==0) {{ '0' }} @else {{ '1' }} @endif">
                                                            <input type="hidden" name="ria_type_cfp" value="@if ($cfp==0) {{ '0' }} @else {{ '1' }} @endif">
                                                            <input type="hidden" name="ria_type_cwm" value="@if ($cwm==0) {{ '0' }} @else {{ '1' }} @endif">

                                                            <div class="data-list">
                                                                <a class="dropdown-item">
                                                                    <div class="form-group custom-checkbox m-0">

                                                                        <input type="checkbox" name="ria_certificate_type[]" id="nism" value="nism" @if ($nism==1) {{ 'checked' }} @endif>
                                                                        <label for="nism">NISM</label>
                                                                    </div>
                                                                </a>
                                                                <a class="dropdown-item">
                                                                    <div class="form-group custom-checkbox m-0">
                                                                        <input type="checkbox" name="ria_certificate_type[]" id="cfp" value="cfp" @if ($cfp==1) {{ 'checked' }} @endif>
                                                                        <label for="cfp">CFP</label>
                                                                    </div>
                                                                </a>
                                                                <a class="dropdown-item">
                                                                    <div class="form-group custom-checkbox m-0">
                                                                        <input type="checkbox" name="ria_certificate_type[]" id="cwm" value="cwm" @if ($cwm==1) {{ 'checked' }} @endif>
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
                                                    <label for="nism_xa_no">NISM XA CERTIFICATE NUMBER <span class="required-sign">*</span></label>
                                                    <input type="text" id="nism_xa_no" class="form-control" value="{{ @$data->associate_certificate->nism_xa_no }}" name="nism_xa_no" aria-describedby="nism_xa_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 nism_xa_upload">
                                                <input type="hidden" name="is_nism_xa_upload" value="{{ isset($data->associate_certificate->nism_xa_upload) ? 1 : 0 }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->associate_certificate->nism_xa_upload) && !empty($data->associate_certificate->nism_xa_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_certificate->nism_xa_upload) && !empty($data->associate_certificate->nism_xa_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_certificate->nism_xa_upload }}')" data-src="{{ $data->associate_certificate->nism_xa_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 nism_xa_validity">
                                                <div class="form-group">
                                                    <label for="nism_xa_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" id="nism_xa_validity" class="form-control" value="{{ @$data->associate_certificate->nism_xa_validity }}" name="nism_xa_validity" aria-describedby="nism_xa_validity">

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
                                                    <label for="nism_xb_no">NISM XB CERTIFICATE NUMBER <span class="required-sign">*</span></label>
                                                    <input type="text" id="nism_xb_no" class="form-control" value="{{ @$data->associate_certificate->nism_xb_no }}" name="nism_xb_no" aria-describedby="nism_xb_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 nism_xb_upload">
                                                <input type="hidden" name="is_nism_xb_upload" value="{{ isset($data->associate_certificate->nism_xb_upload) ? 1 : 0 }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->associate_certificate->nism_xb_upload) && !empty($data->associate_certificate->nism_xb_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_certificate->nism_xb_upload) && !empty($data->associate_certificate->nism_xb_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_certificate->nism_xb_upload }}')" data-src="{{ $data->associate_certificate->nism_xb_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 nism_xb_validity">
                                                <div class="form-group">
                                                    <label for="nism_xb_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" id="nism_xb_validity" class="form-control" value="{{ @$data->associate_certificate->nism_xb_validity }}" name="nism_xb_validity" aria-describedby="nism_xb_validity">

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
                                                    <label for="cfp_no">CFP CERTIFICATE NUMBER <span class="required-sign">*</span></label>
                                                    <input type="text" id="cfp_no" class="form-control" name="cfp_no" value="{{ @$data->associate_certificate->cfp_no }}" aria-describedby="cfp_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 cfp_upload">
                                                <input type="hidden" name="is_cfp_upload" value="{{ isset($data->associate_certificate->cfp_upload) ? 1 : 0 }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->associate_certificate->cfp_upload) && !empty($data->associate_certificate->cfp_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_certificate->cfp_upload) && !empty($data->associate_certificate->cfp_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_certificate->cfp_upload }}')" data-src="{{ $data->associate_certificate->cfp_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 cfp_validity">
                                                <div class="form-group">
                                                    <label for="cfp_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" id="cfp_validity" class="form-control" value="{{ @$data->associate_certificate->cfp_validity }}" name="cfp_validity" aria-describedby="cfp_validity">

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
                                                    <label for="cwm_no">CWM CERTIFICATE NUMBER <span class="required-sign">*</span></label>
                                                    <input type="text" id="cwm_no" class="form-control" name="cwm_no" value="{{ @$data->associate_certificate->cwm_no }}" aria-describedby="cwm_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 cwm_upload">
                                                <input type="hidden" name="is_cwm_upload" value="{{ isset($data->associate_certificate->cwm_upload) ? 1 : 0 }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->associate_certificate->cwm_upload) && !empty($data->associate_certificate->cwm_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_certificate->cwm_upload) && !empty($data->associate_certificate->cwm_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_certificate->cwm_upload }}')" data-src="{{ $data->associate_certificate->cwm_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 cwm_validity">
                                                <div class="form-group">
                                                    <label for="cwm_validity">VALIDITY <span class="required-sign">*</span></label>
                                                    <input type="text" id="cwm_validity" class="form-control" value="{{ @$data->associate_certificate->cwm_validity }}" name="cwm_validity" aria-describedby="cwm_validity">

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
                                                    <label for="ca_no">CA CERTIFICATE NO <span class="required-sign">*</span></label>
                                                    <input type="text" id="ca_no" class="form-control" name="ca_no" value="{{ @$data->associate_certificate->ca_no }}" aria-describedby="ca_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ca_upload">
                                                <input type="hidden" name="is_ca_upload" value="{{ isset($data->associate_certificate->ca_upload) ? 1 : 0 }}">
                                                <div class="form-group">
                                                    <label for="ca_upload" class="w-100">PROOF
                                                        <span class="required-sign">*</span>
                                                    </label>
                                                    <label for="ca_upload" class="btn input-btn w-100">
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        <input id="ca_upload" type="file" name="ca_upload" />
                                                        <div class="value-wrap">
                                                            <span class="default-text">
                                                                @if (isset($data->associate_certificate->ca_upload) && !empty($data->associate_certificate->ca_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_certificate->ca_upload) && !empty($data->associate_certificate->ca_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_certificate->ca_upload }}')" data-src="{{ $data->associate_certificate->ca_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 ca_validity">
                                                <div class="form-group">
                                                    <label for="ca_validity">VALIDITY (IF ANY)</label>
                                                    <input type="text" id="ca_validity" class="form-control" value="{{ @$data->associate_certificate->ca_validity }}" name="ca_validity" aria-describedby="ca_validity">

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
                                                    <label for="cs_no">CS CERTIFICATE NO <span class="required-sign">*</span></label>
                                                    <input type="text" id="cs_no" class="form-control" name="cs_no" value="{{ @$data->associate_certificate->cs_no }}" aria-describedby="cs_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 cs_upload">
                                                <input type="hidden" name="is_cs_upload" value="{{ isset($data->associate_certificate->cs_upload) ? 1 : 0 }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->associate_certificate->cs_upload) && !empty($data->associate_certificate->cs_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_certificate->cs_upload) && !empty($data->associate_certificate->cs_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_certificate->cs_upload }}')" data-src="{{ $data->associate_certificate->cs_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 cs_validity">
                                                <div class="form-group">
                                                    <label for="cs_validity">VALIDITY (IF ANY)</label>
                                                    <input type="text" id="cs_validity" class="form-control" value="{{ @$data->associate_certificate->cs_validity }}" name="cs_validity" aria-describedby="cs_validity">

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
                                                    <label for="course_name">Name of Course/Degree <span class="required-sign">*</span></label>
                                                    <input type="text" id="course_name" class="form-control" value="{{ @$data->associate_certificate->course_name }}" name="course_name" aria-describedby="course_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 course_upload">
                                                <input type="hidden" name="is_course_upload" value="{{ isset($data->associate_certificate->course_upload) ? 1 : 0 }}">
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
                                                            <span class="default-text">
                                                                @if (isset($data->associate_certificate->course_upload) && !empty($data->associate_certificate->course_upload))
                                                                Update @else Upload @endif
                                                            </span>
                                                            <span class="value"></span>
                                                        </div>
                                                    </label>
                                                    @if (isset($data->associate_certificate->course_upload) && !empty($data->associate_certificate->course_upload))
                                                    <label class="w-100">
                                                        <span class="text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_certificate->course_upload }}')" data-src="{{ $data->associate_certificate->course_upload }}">Preview</a></span>
                                                    </label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-8 course_no">
                                                <div class="form-group">
                                                    <label for="course_no">COURSE CERTIFICATE NO <span class="required-sign">*</span></label>
                                                    <input type="text" id="course_no" class="form-control" value="{{ @$data->associate_certificate->course_no }}" name="course_no" aria-describedby="course_no">
                                                </div>
                                            </div>

                                            <div class="col-sm-8 course_validity">
                                                <div class="form-group">
                                                    <label for="course_validity">VALIDITY (IF ANY)</label>
                                                    <input type="text" id="course_validity" class="form-control" value="{{ @$data->associate_certificate->course_validity }}" name="course_validity" aria-describedby="course_validity">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step9 }}" id="nominee-detail" data-step="9" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <input type="hidden" name="nominee_state_code" id="nominee_state_code" value="{{ @$data->associate_nominee->nominee_state }}">
                                <input type="hidden" name="is_minor" id="is_minor" value="{{ isset($data->associate_nominee->is_minor) ? $data->associate_nominee->is_minor : 0 }}">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Nominee
                                    @if ($step9 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row">
                                            <div class="col-sm-6 nominee_name">
                                                <div class="form-group">
                                                    <label for="nominee_name">Nominee Name <span class="required-sign">*</span></label>
                                                    <input type="text" id="nominee_name" class="form-control text-capitalize" value="{{ @$data->associate_nominee->nominee_name }}" name="nominee_name" aria-describedby="nominee_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_birth_date">
                                                <div class="form-group">
                                                    <label for="nominee_birth_date">Date of Birth <span class="minor">(If Nominee
                                                            Minor)</span></label>
                                                    <input type="text" id="nominee_birth_date" class="form-control" value="{{ @$data->associate_nominee->nominee_birth_date }}" name="nominee_birth_date" aria-describedby="nominee_birth_date">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group custom-checkbox">
                                                    <input type="checkbox" id="nominee_primary_address" name="nominee_primary_address" value="{{ @$data->associate_nominee->nominee_primary_address }}" @if (isset($data->associate_nominee->nominee_primary_address) && $data->associate_nominee->nominee_primary_address == 1) {{ 'checked' }} @endif>
                                                    <label for="nominee_primary_address">Address same as per Primary Holder</label>
                                                </div>
                                                <!--
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" id="nomineeaddress" name="nomineeaddress">
                                                                        <label class="form-check-label" for="nomineeaddress">Address same as per Primary
                                                                            Holder</label>
                                                                        </div>
                                                                    <h4 class="text-uppercase mb-4 d-flex align-items-center"> <input
                                                                        type="checkbox" id="sameAddress" />
                                                                    <label for="sameAddress" class="ml-2  mb-0">Address same as per Primary
                                                                        Holder </label></h4> -->

                                            </div>
                                            <div class="col-sm-6 nominee_address1">
                                                <div class="form-group">
                                                    <label for="nominee_address1">Address 1 <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="nominee_address1" value="{{ @$data->associate_nominee->nominee_address1 }}" aria-describedby="nominee_address1" name="nominee_address1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_address2">
                                                <div class="form-group">
                                                    <label for="nominee_address2">Address 2</label>
                                                    <input type="text" class="form-control text-capitalize" id="nominee_address2" value="{{ @$data->associate_nominee->nominee_address2 }}" aria-describedby="nominee_address2" name="nominee_address2">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_address3">
                                                <div class="form-group">
                                                    <label for="nominee_address3">Address 3</label>
                                                    <input type="text" class="form-control text-capitalize" id="nominee_address3" value="{{ @$data->associate_nominee->nominee_address3 }}" aria-describedby="nominee_address3" name="nominee_address3">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_city">
                                                <div class="form-group">
                                                    <label for="nominee_city">City <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="nominee_city" value="{{ @$data->associate_nominee->nominee_city }}" aria-describedby="nominee_city" name="nominee_city">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_state">
                                                <div class="form-group">
                                                    <label for="nominee_state">State <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="nominee_state" name="nominee_state">
                                                            <option value="" disabled selected>Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_country">
                                                <div class="form-group">
                                                    <label for="nominee_country">Country <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="nominee_country" name="nominee_country">
                                                            <option value="" disabled selected>Select Country</option>
                                                            @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}" @if (isset($data->associate_nominee->nominee_country) && $country->id == $data->associate_nominee->nominee_country) {{ 'selected' }} @elseif($country->id == 98) {{ 'selected' }} @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_pincode">
                                                <div class="form-group">
                                                    <label for="nominee_pincode">Pincode <span class="required-sign">*</span></label>
                                                    <input type="text" id="nominee_pincode" class="form-control" value="{{ @$data->associate_nominee->nominee_pincode }}" aria-describedby="nominee_pincode" name="nominee_pincode">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_mobile">
                                                <div class="form-group">
                                                    <label for="nominee_mobile">Mobile Number</label>
                                                    <input type="text" class="form-control" id="nominee_mobile" value="{{ @$data->associate_nominee->nominee_mobile }}" aria-describedby="nominee_mobile" name="nominee_mobile">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_telephone">
                                                <div class="form-group">
                                                    <label for="nominee_telephone">TELEPHONE NO</label>
                                                    <input type="text" class="form-control" id="nominee_telephone" value="{{ @$data->associate_nominee->nominee_telephone }}" aria-describedby="nominee_telephone" name="nominee_telephone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_email">
                                                <div class="form-group">
                                                    <label for="nominee_email">EMAIL ADDRESS</label>
                                                    <input type="text" class="form-control" id="nominee_email" value="{{ @$data->associate_nominee->nominee_email }}" aria-describedby="nominee_email" name="nominee_email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step10 }}" id="guardian-detail" data-step="10" autocomplete="off">

                        @php
                        // dd($data->associate_nominee->assoicate_guardian->guardian_name);
                        @endphp
                        <div class="form-inner-section">
                            <div class="form-header">
                                <input type="hidden" name="nominee_state_code" id="guardian_state_code" value="{{ @$data->associate_nominee->assoicate_guardian->state }}">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Guardian Details
                                    @if ($step10 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row">
                                            <div class="col-sm-8 guardian_name">
                                                <div class="form-group">
                                                    <label for="guardian_name">Guardian Name <span class="required-sign">*</span></label>
                                                    <input type="text" id="guardian_name" class="form-control text-capitalize" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_name }}" name="guardian_name" aria-describedby="guardian_name">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-sm-8 guardian_pan_no">
                                                        <div class="form-group">
                                                            <label for="guardian_pan_no">PAN Number <span class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-uppercase" id="guardian_pan_no" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}" name="guardian_pan_no" aria-describedby="guardian_pan_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 guardian_pan_upload">
                                                        <input type="hidden" name="is_guardian_pan_upload" value="{{ isset($data->associate_nominee->assoicate_guardian->guardian_pan_upload) ? 1 : 0 }}">
                                                        <div class="form-group">
                                                            <label for="guardian_pan_upload" class="w-100">Upload PAN
                                                                <span class="required-sign">*</span>
                                                                @if (isset($data->associate_nominee->assoicate_guardian->guardian_pan_upload) && !empty($data->associate_nominee->assoicate_guardian->guardian_pan_upload))
                                                                <span class="float-right text-lowercase font-italic"><a href="javascript:showImage('{{ $data->associate_nominee->assoicate_guardian->guardian_pan_upload }}')" data-src="{{ $data->associate_nominee->assoicate_guardian->guardian_pan_upload }}">Preview</a></span>
                                                                @endif
                                                            </label>
                                                            <label for="guardian_pan_upload" class="btn input-btn w-100">
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                <input id="guardian_pan_upload" type="file" name="guardian_pan_upload" />
                                                                <div class="value-wrap">
                                                                    <span class="default-text">
                                                                        @if (isset($data->associate_nominee->assoicate_guardian->guardian_pan_upload) && !empty($data->associate_nominee->assoicate_guardian->guardian_pan_upload))
                                                                        Update @else Upload @endif
                                                                    </span>
                                                                    <span class="value"></span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 guardian_nominee_relation">
                                                        <div class="form-group">
                                                            <label for="guardian_nominee_relation">Relation With Nominee <span class="required-sign">*</span></label>
                                                            <div class="select-wrapper exclude">
                                                                <select class="form-control" id="guardian_nominee_relation" name="guardian_nominee_relation">
                                                                    <option value="" @if (!isset($data->associate_nominee->assoicate_guardian->guardian_nominee_relation)) {{ 'disabled selected' }} @endif>
                                                                        Select RelationShip</option>
                                                                    @foreach ($relations as $relation)
                                                                    <option value="{{ $relation->id }}" @if (isset($data->associate_nominee->assoicate_guardian->guardian_nominee_relation) && $data->associate_nominee->assoicate_guardian->guardian_nominee_relation == $relation->id) {{ 'selected' }} @endif>
                                                                        {{ $relation->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group custom-checkbox">
                                                    <input type="checkbox" id="guardian_primary_address" name="guardian_primary_address" value="{{ @$data->associate_nominee->nominee_primary_address }}" @if (isset($data->associate_nominee->nominee_primary_address) && $data->associate_nominee->nominee_primary_address == 1) {{ 'checked' }} @endif>
                                                    <label for="guardian_primary_address">Address same as per Primary Holder</label>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 guardian_address1">
                                                <div class="form-group">
                                                    <label for="guardian_address1">Address 1 <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="guardian_address1" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}" aria-describedby="guardian_address1" name="guardian_address1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_address2">
                                                <div class="form-group">
                                                    <label for="guardian_address2">Address 2</label>
                                                    <input type="text" class="form-control text-capitalize" id="guardian_address2" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}" aria-describedby="guardian_address2" name="guardian_address2">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_address3">
                                                <div class="form-group">
                                                    <label for="guardian_address3">Address 3</label>
                                                    <input type="text" class="form-control text-capitalize" id="guardian_address3" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}" aria-describedby="guardian_address3" name="guardian_address3">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_city">
                                                <div class="form-group">
                                                    <label for="guardian_city">City <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="guardian_city" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}" aria-describedby="guardian_city" name="guardian_city">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_state">
                                                <div class="form-group">
                                                    <label for="guardian_state">State <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="guardian_state" name="guardian_state">
                                                            <option value="" disabled selected>Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_country">
                                                <div class="form-group">
                                                    <label for="guardian_country">Country <span class="required-sign">*</span></label>
                                                    <div class="select-wrapper exclude">
                                                        <select class="form-control" id="guardian_country" name="guardian_country">
                                                            <option value="" disabled selected>Select Country</option>
                                                            @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}" @if (isset($data->associate_nominee->assoicate_guardian->country) && $country->id == $data->associate_nominee->assoicate_guardian->country) {{ 'selected' }} @elseif($country->id == 98) {{ 'selected' }} @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_pincode">
                                                <div class="form-group">
                                                    <label for="guardian_pincode">Pincode <span class="required-sign">*</span></label>
                                                    <input type="text" id="guardian_pincode" class="form-control" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pincode }}" aria-describedby="guardian_pincode" name="guardian_pincode">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_mobile">
                                                <div class="form-group">
                                                    <label for="guardian_mobile">Mobile Number <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="guardian_mobile" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_mobile }}" aria-describedby="guardian_mobile" name="guardian_mobile">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_telephone">
                                                <div class="form-group">
                                                    <label for="guardian_telephone">TELEPHONE NO</label>
                                                    <input type="text" class="form-control" id="guardian_telephone" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_telephone }}" aria-describedby="guardian_telephone" name="guardian_telephone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_email">
                                                <div class="form-group">
                                                    <label for="guardian_email">EMAIL ADDRESS <span class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="guardian_email" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_email }}" aria-describedby="guardian_email" name="guardian_email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="button" class="proceed btn btn-primary btn-lg">Proceed</button>
                            </div>
                        </div>
                    </section>
                    <section class="trial {{ $step11 }}" id="commercial-detail" data-step="11" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i>Commercials
                                    @if ($step11 == 'completed' && $details == 0)
                                    <span class="edit-now float-right mt-1">Edit</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="row" id="commercials">
                                            <!--Testing-->

                                            @foreach ($commercials as $commercial)
                                            <div class="col-sm-12 {{ $commercial->field_name }}">
                                                <div class="form-group">
                                                    <label for="commercials">{{ $commercial->name }} <span class="required-sign">*</span></label>
                                                    <div class="multi-input">
                                                        @foreach ($commercialtypes as $commercialtype)
                                                        @php
                                                        $name = $commercial->field_name . '_' . $commercialtype->field_name;
                                                        @endphp
                                                        <div class="{{ $name }}">
                                                            <div class="input-group">
                                                                <input type="number" name="{{ $name }}" class="form-control share_in" id="{{ $name }}" class="form-control" value="{{ @$data->$name }}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        @if ($commercialtype->field_name == 'perc')
                                                                        {{ '%' }}
                                                                        @else
                                                                        {{ $commercialtype->field_name }}
                                                                        @endif
                                                                    </span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        @if (!$loop->last)
                                                        <div>
                                                            <span class="or">OR</span>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <!--Testing End-->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                @if (isset($data->status) && $data->status == 2 && $details == 0)
                                <input type="hidden" id="userstatus" name="userstatus" value="0">


                                <button type="button" class="proceed btn btn-primary btn-lg" style="min-width:11rem">Verify</button>
                                <button type="button" class="reject-now btn btn-danger btn-lg" style="min-width:11rem">Reject</button>
                                @else
                                @if ($details == 0)
                                <button type="button" class="proceed btn btn-primary btn-lg">Confirm</button>
                                @elseif($details == 1 && ($data->status == 8 || $data->status == 10))
                                <button type="button" class="proceed btn btn-primary btn-lg">Confirm</button>
                                @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal fade" id="RejectModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <!-- modal-lg-->
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
                    @if (isset($data->status) && ($data->status == 10 || $data->status == 8))
                    <section class="trial {{ $step12 }}" id="bse-detail" data-step="12" autocomplete="off">
                        <div class="form-inner-section">
                            <div class="form-header">
                                <h3 class="card-title"> <i class="icon-left-arrow back-btn"></i> Download</h3>
                            </div>
                            <div class="form-content">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-9">
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
                                        <hr />
                                        <h3 class="card-title">Upload</h3>
                                        <input type="hidden" name="is_credential_email" value="{{ @$data->is_credential_email }}">
                                        <div class="row">
                                            <div class="col-12 bse_upload mt-20">
                                                <div class="form-group custom-checkbox">
                                                    <input type="checkbox" id="bse_upload" name="bse_upload" value="{{ @$data->bse_upload }}" @if ($data->bse_upload == 1) {{ 'checked' }} @endif class="form-control">
                                                    <label for="bse_upload">File Uploaded to BSE</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                @if ($details == 0)
                                @if ($data->status == 10)
                                <button type="button" class="proceed btn btn-primary btn-lg" id="bse_send_email" @if ($data->bse_upload == 0) {{ 'disabled' }} @endif>Send Credentials
                                    Email</button>
                                @endif
                                @else
                                <button type="button" class="btn btn-primary btn-lg" id="bse_send_email" disabled>Send Credentials Email</button>
                                @endif
                            </div>
                        </div>
                    </section>
                    @endif
                </form>

            </div>
        </div>

    </div>
</div>
@else
<script>
    window.location = "/employee/create";
</script>

@endif
@endsection

@section('modal')

<!-- Modal -->

<div class="modal fade" id="uploadModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- modal-lg-->
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
<script type="text/javascript" src="{{ asset('assets/javascript/associate.js') }}"></script>
<script>

</script>
@endsection
