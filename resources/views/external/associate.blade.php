@extends('layouts.external')

@section('style')
<style>
    .mt-20 {
        margin-top: 2rem;
    }
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
.employee,.view-item {display: none;}
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
    background-color: #f6f6f6 !important;
}
.minor{
    font-size: 80%;
    font-weight: 400;
    color: #ce4b4b;

}
/*Select2 ReadOnly End*/
.center {
  margin: auto;
  width: 70%;

  padding: 10px;
}
    </style>

@endsection

@section('content')

<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4">
                    {{-- <h3 class="card-title">Create New Associate</h3> --}}
                    <div class="col-12 d-flex center">

                            <img src="http://127.0.0.1:8001/assets/images/logo.svg" width="30%">
                            <h3 style="margin-top: 7px;font-size: 25px;margin-left:10px;">Kinntegra</h3>

                     </div>
                     @php
                            $certi = '1';
                            if($data->profession_id == 1 || $data->profession_id == 2 || $data->profession_id == 3)
                            {
                                if($data->entitytype_id == 1 || $data->entitytype_id == 2 || $data->entitytype_id ==3)
                                {
                                    $certi  = '0';
                                }
                            }

                        @endphp
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
                    <ul class="form-lists">
                        <li data-form="entity-detail" class="isParent">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Entity Details
                            <ul>
                                <li class="isChild" data-form="photo-detail">Photo ID Details</li>
                                <li class="isChild" data-form="address-detail">Address Details</li>
                                <li class="isChild" data-form="bank-detail">Bank Details</li>
                                <li class="isChild" data-form="other-detail">Other Details</li>
                            </ul>
                        </li>
                        <!-- <li data-form="bank-detail">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Bank Details
                        </li> -->
                        <li data-form="license-detail">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            License Details
                        </li>
                        @if ($certi == 1)
                        <li data-form="euin-detail">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Certification
                        </li>
                        @endif

                        @if (isset($data->entitytype_id) && $data->entitytype_id == 4)
                        <li data-form="nominee-detail" class="@if(isset($data->associate_nominee->is_minor) && $data->associate_nominee->is_minor == 1) isParent @endif"  id="menu_nominee">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Nominee
                            @if(isset($data->associate_nominee->assoicate_guardian->guardian_nominee_relation) && !empty($data->associate_nominee->assoicate_guardian->guardian_nominee_relation))
                            <ul>
                                <li class="isChild" data-form="guardian-detail">Guardian</li>
                            </ul>
                            @endif
                        </li>
                        @endif
                        <li data-form="commercial-detail">
                            <div class="indicator">
                                <div class="check"></div>
                            </div>
                            Commercials
                        </li>



                    </ul>
                </div>
                <form class="col-lg-5 col-md-8 step-forms" enctype="multipart/form-data" id="form-information" method="POST" action="{{ route('external-associate.store') }}">
                    @csrf

                    <input type="hidden" name="step" value="2">
                    <input type="hidden" name="step_edit" id="step_edit" value="0">
                    <input type="hidden" name="associate_id" id="associate_id" value="{{ @$data->id }}">
                    <input type="hidden" name="status" value="{{ @$data->status }}">
                    <input type="hidden" name="associate_edit" id="associate_edit" value="{{ isset($data->id) ? 1 : 0 }}">
                    <input type="hidden" name="business_code" id="business_code" value="{{ @$data->business_tag }}">
                    <input type="hidden" id="business_tag" name="business_tag" value="{{ @$data->business_tag }}">
                    <input type="hidden" id="employee_name" name="employee_name" value="{{ @$data->employee_name }}">
                    <input type="hidden" id="introducer_name" name="introducer_name" value="{{ @$data->introducer_name }}">
                    <input type="hidden" id="profession_name" name="profession_name" value="{{ @$data->profession_name }}">
                    <input type="hidden" name="has_employee" id="has_employee" value="0">
                    <input type="hidden" name="entitytype_id" id="entitytype_id" value="{{ @$data->entitytype_id }}">
                    <input type="hidden" name="profession_id" id="profession_id" value="{{ @$data->profession_id }}">
                    <section class="trial active" id="entity-detail" data-step="2" autocomplete="off">

                        <h3 class="card-title"> Entity Details </h3>
                        <div class="row flex-column">
                            <div class="col-sm-8 entitytype_name">
                                <div class="form-group">
                                    <label for="entitytype_name">Entity Type </label>
                                    <input type="text" class="form-control text-capitalize" id="entitytype_name"
                                    aria-describedby="entitytype_name" name="entitytype_name" value="{{ @$data->entitytype_name }}" disabled>
                                </div>
                            </div>
                            @if ($data->entitytype_id == 1 || $data->entitytype_id == 2 || $data->entitytype_id == 3)
                            <div class="col-sm-12 entity_name">
                                <div class="form-group">
                                    <label for="entity_name">Entity Name (As per Pancard) </label>
                                    <input type="text" class="form-control text-capitalize" id="entity_name"
                                    aria-describedby="entity_name" name="entity_name" value="{{ @$data->entity_name }}" disabled>

                                </div>
                            </div>
                            @endif

                        </div>
                        @if ($data->entitytype_id == 1 || $data->entitytype_id == 2 || $data->entitytype_id == 3 || $data->entitytype_id == 4)
                            <div class="row">
                                <div class="col-sm-6 authorised_person1">
                                    <div class="form-group">
                                        <label for="authorised_person1">Authorised Person 1 </label>
                                        <input type="text" class="form-control text-capitalize" id="authorised_person1" aria-describedby="authorised_person1"
                                        name="authorised_person1" value="{{ @$data->authorised_person1 }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 authorised_email1">
                                    <div class="form-group">
                                        <label for="authorised_email1">Email 1 </label>
                                        <input type="email" class="form-control" id="authorised_email1" aria-describedby="authorised_email1"
                                        name="authorised_email1" value="{{ @$data->authorised_email1 }}" disabled>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->entitytype_id == 2 || $data->entitytype_id == 3)
                            <div class="row">
                                <div class="col-sm-6 authorised_person2">
                                    <div class="form-group">
                                        <label for="authorised_person2">Authorised Person 2 </label>
                                        <input type="text" class="form-control text-capitalize" id="authorised_person2" aria-describedby="authorised_person2"
                                        name="authorised_person2" value="{{ @$data->authorised_person2 }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 authorised_email2">
                                    <div class="form-group">
                                        <label for="authorised_email2">Email 2 </label>
                                        <input type="email" class="form-control" id="authorised_email2" aria-describedby="authorised_email2"
                                        name="authorised_email2" value="{{ @$data->authorised_email2 }}" disabled>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($data->entitytype_id == 2 || $data->entitytype_id == 3)
                            <div class="row">
                                <div class="col-sm-6 authorised_person3">
                                    <div class="form-group">
                                        <label for="authorised_person3">Authorised Person 3</label>
                                        <input type="text" class="form-control text-capitalize" id="authorised_person3" aria-describedby="authorised_person3"
                                        name="authorised_person3" value="{{ @$data->authorised_person3 }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group authorised_email3">
                                        <label for="authorised_email3">Email 3</label>
                                        <input type="email" class="form-control" id="authorised_email3" aria-describedby="authorised_email3"
                                        name="authorised_email3" value="{{ @$data->authorised_email3 }}" disabled>
                                    </div>
                                </div>
                            </div>
                        @endif



                        <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                    </section>
                    <section class="trial" id="photo-detail" data-step="3" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Photo ID DETAILS</h3>
                        <div class="row">
                            <!-- For Individual Case :: Name, PANCARD NUMBER, AADHAR CARD NUMBER, Date of Birth field is require-->
                            <div class="col-sm-8 name">
                                <div class="form-group">
                                    <label for="name">Name (As per Pancard) </label>
                                    <input type="text" class="form-control text-capitalize" id="name" name="name"
                                        aria-describedby="name" value="{{ @$data->entity_name }}" disabled>
                                </div>
                            </div>
                            @if ($data->entitytype_id == 4)

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
                            @endif
                            <div class="col-sm-8 pan_no">
                                <div class="form-group">
                                    <label for="pan_no">PANCARD NUMBER </label>
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
                            @if ($data->entitytype_id == 1 || $data->entitytype_id == 4)
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
                            @endif

                            <div class="col-sm-8 birth_incorp_date">
                                <div class="form-group">
                                    <label for="birth_incorp_date">
                                        <span id="birth_incorp_date">
                                        @if ($data->entitytype_id == 1 || $data->entitytype_id == 2 || $data->entitytype_id == 3)
                                        Date of Incorporation
                                        @else
                                        Date of Birth
                                        @endif
                                        </span>
                                    </label>
                                    <input type="text" name="birth_incorp_date" class="form-control"
                                        id="birth_incorp_date" aria-describedby="birth_incorp_date" value="{{ @$data->birth_incorp_date }}" disabled>
                                </div>
                            </div>

                        </div>
                        <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                    </section>
                    <section class="trial" id="address-detail" data-step="4" autocomplete="off">

                        <!-- If Selected Individual on Entity Type, then Address 1, Address 2, Address 3, City, State, Country, Pincode,Mobile Number,Telephone No,Email Address Require -->
                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Address Details</h3>

                        <input type="hidden" name="state_code" id="state_code" value="{{ @$data->address->state }}">
                        <div class="row">
                            <div class="col-sm-12 address1">
                                <div class="form-group ">
                                    <label for="address1">Address 1</label>
                                    <input type="text" class="form-control text-capitalize" id="address1" value="{{ @$data->address->address1 }}"
                                        aria-describedby="address1" name="address1" disabled>
                                </div>
                            </div>
                            <div class="col-sm-12 address2">
                                <div class="form-group ">
                                    <label for="address2">Address 2</label>
                                    <input type="text" class="form-control text-capitalize" id="address2" value="{{ @$data->address->address2 }}"
                                        aria-describedby="address2" name="address2" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 address3">
                                <div class="form-group">
                                    <label for="address3">Address 3</label>
                                    <input type="text" class="form-control text-capitalize" id="address3" value="{{ @$data->address->address3 }}"
                                        aria-describedby="address3" name="address3" disabled>
                                </div>
                            </div>


                            <div class="col-sm-6 city">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control text-capitalize" id="city" value="{{ @$data->address->city }}"
                                        aria-describedby="city" name="city" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 state">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control text-capitalize" id="state" value="{{ @$data->address->state_name }}"
                                        aria-describedby="state" name="state" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 country">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control text-capitalize" id="country" value="{{ @$data->address->country_name }}"
                                        aria-describedby="country" name="country" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 pincode">
                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" id="pincode" class="form-control" value="{{ @$data->address->pincode }}"
                                        aria-describedby="pincode" name="pincode" disabled>
                                </div>
                            </div>

                            <div class="col-sm-4 address_upload">
                                <div class="form-group">
                                    <label for="address_upload" class="w-100">PROOF</label>
                                    @if(isset($data->address->address_upload) && !empty($data->address->address_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->address->address_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
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
                            </div>
                            <div class="col-sm-6 email">
                                <div class="form-group">
                                    <label for="email">EMAIL ADDRESS</label>
                                    <input type="text" class="form-control" id="email" value="{{ @$data->email }}"
                                        aria-describedby="email" name="email" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                    </section>
                    <section class="trial" id="bank-detail" data-step="5" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Bank Details</h3>

                        <div class="row">
                            <div class="col-sm-12 mdf_ria">
                                <h4 class="card-title">MFD Bank Details</h4>
                            </div>
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
                                        aria-describedby="micr" disabled>
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
                        @if($data->profession_id == 3)
                        <div class="row" id="mfd_ria_bank">
                            <div class="col-sm-12">
                                <h4 class="card-title">RIA Bank Details</h4>
                            </div>
                            <div class="col-sm-8 mfd_ria_ifsc_no">
                                <div class="form-group">
                                    <label for="mfd_ria_ifsc_no">IFSC Number</label>
                                    <input type="text" class="form-control text-uppercase" id="mfd_ria_ifsc_no" name="mfd_ria_ifsc_no" value="{{ @$data->mfd_ria_ifsc_no }}"
                                        aria-describedby="mfd_ria_ifsc_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 mfd_ria_cheque_upload">
                                <div class="form-group">
                                    <label for="mfd_ria_cheque_upload" class="w-100">Cheque Upload</label>
                                    @if(isset($data->mfd_ria_cheque_upload) && !empty($data->mfd_ria_cheque_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->mfd_ria_cheque_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 mfd_ria_bank_name">
                                <div class="form-group">
                                    <label for="mfd_ria_bank_name">Bank Name </label>
                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_bank_name" value="{{ @$data->mfd_ria_bank_name }}"
                                        name="mfd_ria_bank_name" aria-describedby="mfd_ria_bank_name" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 mfd_ria_branch_name">
                                <div class="form-group">
                                    <label for="mfd_ria_branch_name">Branch </label>
                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_branch_name" value="{{ @$data->mfd_ria_branch_name }}"
                                        name="mfd_ria_branch_name" aria-describedby="mfd_ria_branch_name" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 mfd_ria_micr">
                                <div class="form-group">
                                    <label for="mfd_ria_micr">MICR </label>
                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_micr" name="mfd_ria_micr" value="{{ @$data->mfd_ria_micr }}"
                                        aria-describedby="mfd_ria_micr" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 mfd_ria_account_type">
                                <div class="form-group">
                                    <label for="mfd_ria_account_type">Account Type </label>
                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_account_type" name="mfd_ria_account_type" value="{{ @$data->mfd_ria_account_type }}"
                                        aria-describedby="mfd_ria_account_type" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8 mfd_ria_account_no">
                                <div class="form-group">
                                    <label for="mfd_ria_account_no">Account Number </label>
                                    <input type="text" class="form-control" id="mfd_ria_account_no" value="{{ @$data->mfd_ria_account_no }}"
                                        aria-describedby="mfd_ria_account_no" name="mfd_ria_account_no" disabled>
                                </div>
                            </div>
                        </div>
                        @endif
                        <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                    </section>
                    <section class="trial" id="other-detail" data-step="6" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Other Details</h3>
                        <div class="row" id="gst_details">
                            <div class="col-sm-12">
                                <h4 class="form-group">
                                    GST Details
                                </h4>
                            </div>
                            <div class="col-sm-8 gst_no">
                                <div class="form-group">
                                    <label for="gst_no">GST Number</label>
                                    <input type="text" class="form-control text-uppercase" id="gst_no" name="gst_no" value="{{ @$data->gst_no }}"
                                        aria-describedby="gst_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 gst_upload">
                                <div class="form-group">
                                    <label for="gst_upload" class="w-100">PROOF</label>
                                    @if(isset($data->gst_upload) && !empty($data->gst_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->gst_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 gst_validity">
                                <div class="form-group">
                                    <label for="gst_validity">VALIDITY (If ANY)</label>
                                    <input type="text" class="form-control" id="gst_validity" value="{{ @$data->gst_validity }}"
                                        name="gst_validity" aria-describedby="gst_validity" disabled>
                                </div>
                            </div>
                        </div>
                        @if($data->entitytype_id == 1)
                        <div class="row" id="shop_est_details">
                            <div class="col-sm-12">
                                <h4>SHOP & ESTABLISHMENT Details </h4>
                            </div>
                            <div class="col-sm-8 shop_est_no">
                                <div class="form-group">
                                    <label for="shop_est_no">SHOP & ESTABLISHMENT CERTIFICATE NO </label>
                                    <input type="text" class="form-control" id="shop_est_no" value="{{ @$data->shop_est_no }}"
                                        aria-describedby="shop_est_no" name="shop_est_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 shop_est_upload">
                                <div class="form-group">
                                    <label for="shop_est_upload" class="w-100">PROOF</label>
                                    @if(isset($data->shop_est_upload) && !empty($data->shop_est_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->shop_est_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 shop_est_validity">
                                <div class="form-group">
                                    <label for="shop_est_validity">VALIDITY</label>
                                    <input type="text" class="form-control" id="shop_est_validity" value="{{ @$data->shop_est_validity }}"
                                        name="shop_est_validity" aria-describedby="gst_validity" disabled>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->entitytype_id == 2)
                        <div class="row" id="pd_details">
                            <div class="col-sm-12">
                                <h4>
                                    PARTNERSHIP FIRM Details
                                </h4>
                            </div>
                            <div class="col-sm-6 pd_upload">
                                <div class="form-group">
                                    <label for="pd_upload" class="w-100">PARTNERSHIP DEEP</label>
                                    @if(isset($data->pd_upload) && !empty($data->pd_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->pd_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 pd_asl_upload">
                                <div class="form-group">
                                    <label for="pd_asl_upload" class="w-100">AUTHORIZED SIGNATORY LIST</label>
                                    @if(isset($data->pd_asl_upload) && !empty($data->pd_asl_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->pd_asl_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 pd_coi_upload">
                                <div class="form-group">
                                    <label for="pd_coi_upload" class="w-100">CERTIFICATE OF INCORPORATION</label>
                                    @if(isset($data->pd_coi_upload) && !empty($data->pd_coi_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->pd_coi_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($data->entitytype_id == 3)
                        <div class="row" id="co_details">
                            <div class="col-sm-12">
                                <h4>
                                    CORPORATE Details
                                </h4>
                            </div>
                            <div class="col-sm-6 co_moa_upload">
                                <div class="form-group">
                                    <label for="co_moa_upload" class="w-100">MEMORANDUM OF ASSOCIATION</label>
                                    @if(isset($data->co_moa_upload) && !empty($data->co_moa_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->co_moa_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 co_aoa_upload">
                                <div class="form-group">
                                    <label for="co_aoa_upload" class="w-100">ARTICLE OF ASSOCIATION</label>
                                    @if(isset($data->co_aoa_upload) && !empty($data->co_aoa_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->co_aoa_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 co_coi_upload">
                                <div class="form-group">
                                    <label for="co_coi_upload" class="w-100">CERTIFICATE OF INCORPORATION</label>
                                    @if(isset($data->co_coi_upload) && !empty($data->co_coi_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->co_coi_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 co_asl_upload">
                                <div class="form-group">
                                    <label for="co_asl_upload" class="w-100">AUTHORIZED SIGNATORY LIST</label>
                                    @if(isset($data->co_asl_upload) && !empty($data->co_asl_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->co_asl_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 co_br_upload">
                                <div class="form-group">
                                    <label for="co_br_upload" class="w-100">BOARD RESOLUTION</label>
                                    @if(isset($data->co_br_upload) && !empty($data->co_br_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->co_br_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row" id="white_labeling">
                            <div class="col-sm-12">
                                <h3 class="card-title">
                                    White Labelling
                                </h3>
                            </div>
                            <div class="col-sm-8 primary_color">
                                <div class="form-group">
                                    <label for="primary_color">Primary Color</label>
                                    <input type="text" class="form-control" name="primary_color" value="{{ @$data->primary_color }}"
                                        id="primary_color" aria-describedby="primary_color"
                                        placeholder="Primary Color" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 logo_upload">
                                <div class="form-group">
                                    <label for="logo_upload" class="w-100">Logo</label>
                                    @if(isset($data->logo_upload) && !empty($data->logo_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->logo_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 secondary_color">
                                <div class="form-group">
                                    <label for="secondary_color">Secondary Color</label>
                                    <input type="text" class="form-control" name="secondary_color" value="{{ @$data->secondary_color }}"
                                        id="secondary_color" aria-describedby="secondary_color"
                                        placeholder="Secondary Color" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="proceed btn btn-primary btn-lg">Next</button>
                    </section>
                    <section class="trial" id="license-detail" data-step="7" autocomplete="off">

                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> License Details</h3>
                        <!-- Section Start for ARN -->
                        <!-- If "PROFESSION" Selected :: MFD -->
                        @if (isset($data->arn_rgn_no) && !empty($data->arn_rgn_no))
                        <div class="row" id="arn_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">AMFI Details</h4>
                            </div>
                            <div class="col-sm-8 arn_name">
                                <div class="form-group">
                                    <label for="arn_name">NAME AS PER ARN</label>
                                    <input type="text" id="arn_name" class="form-control text-capitalize" value="{{ @$data->arn_name }}"
                                        name="arn_name" aria-describedby="arn_name" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 arn_upload">
                                <div class="form-group">
                                    <label for="arn_upload" class="w-100">PROOF</label>
                                    @if(isset($data->arn_upload) && !empty($data->arn_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->arn_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 arn_rgn_no">
                                <div class="form-group">
                                    <label for="arn_rgn_no">ARN REGISTRATION NUMBER</label>
                                    <div class="input-group exclude">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ARN- &ensp;</span>
                                        </div>
                                        <input type="text" id="arn_rgn_no" class="form-control" name="arn_rgn_no" value="{{ @$data->arn_rgn_no }}" aria-describedby="arn_rgn_no" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 arn_validity">
                                <div class="form-group">
                                    <label for="arn_validity">VALIDITY </label>
                                    <input type="text" id="arn_validity" class="form-control" value="{{ @$data->arn_validity }}"
                                        name="arn_validity" aria-describedby="arn_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        @if (isset($data->euin_no) && !empty($data->euin_no))
                        <!-- EUIN Details -->
                        <div class="row" id="euin_details">
                            <div class="col-sm-12">
                                <!--<h3 class="card-title">EUIN</h3>-->
                                <h4 class="card-title">EUIN</h4>
                            </div>
                            <div class="col-sm-8 euin_name">
                                <div class="form-group">
                                    <label for="euin_name">Name of EUIN Holder </label>
                                    <input type="text" class="form-control text-capitalize" id="euin_name" value="{{ @$data->euin_name }}"
                                        name="euin_name" aria-describedby="euin_name" disabled />
                                </div>
                            </div>
                            <div class="col-sm-4 euin_upload">
                                <div class="form-group">
                                    <label for="euin_upload" class="w-100">PROOF</label>
                                    @if(isset($data->euin_upload) && !empty($data->euin_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->euin_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 euin_no">
                                <div class="form-group">
                                    <label for="euin_no">EUIN Number</label>
                                    <div class="input-group exclude">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">E &ensp;</span>
                                        </div>
                                        <input type="text" id="euin_no" class="form-control" name="euin_no" value="{{ @$data->euin_no }}" aria-describedby="euin_no" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 euin_validity">
                                <div class="form-group">
                                    <label for="euin_validity">VALIDITY </label>
                                    <input type="text" id="euin_validity" class="form-control" value="{{ @$data->euin_validity }}"
                                        name="euin_validity" aria-describedby="euin_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- END -->
                        <!-- Section Start for RIA -->
                        <!-- If "PROFESSION" Selected :: RIA -->
                        @if (isset($data->ria_rgn_no) && !empty($data->ria_rgn_no))
                        <div class="row" id="ria_details">
                            <div class="col-sm-12">
                                <!--<h3 class="card-title">EUIN</h3>-->
                                <h4 class="card-title">SEBI RIA Details</h4>
                            </div>
                            <div class="col-sm-8 ria_name">
                                <div class="form-group">
                                    <label for="ria_name">NAME AS PER RIA</label>
                                    <div class="input-group exclude">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">INA &ensp;</span>
                                        </div>
                                        <input type="text" id="ria_name" name="ria_name" value="{{ @$data->ria_name }}"
                                        class="form-control text-capitalize" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 ria_upload">
                                <div class="form-group">
                                    <label for="ria_upload" class="w-100">PROOF</label>
                                    @if(isset($data->ria_upload) && !empty($data->ria_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->ria_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 ria_rgn_no">
                                <div class="form-group">
                                    <label for="ria_rgn_no">SEBI REGISTRATION NUMBER</label>
                                    <div class="input-group exclude">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">RIA &ensp;</span>
                                        </div>
                                        <input type="text" id="ria_rgn_no" class="form-control" name="ria_rgn_no" value="{{ @$data->ria_rgn_no }}" aria-describedby="ria_rgn_no" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 ria_validity">
                                <div class="form-group">
                                    <label for="ria_validity">VALIDITY </label>
                                    <input type="text" id="ria_validity" class="form-control" value="{{ @$data->ria_validity }}"
                                        name="ria_validity" aria-describedby="ria_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- END -->
                        <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                    </section>

                    @if ($certi == 1)
                    <section class="trial" id="euin-detail" data-step="8" autocomplete="off">

                        <!-- NISM VA CERTIFICATE  -->
                        <!-- If "PROFESSION" Selected :: MFD -->
                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Certification</h3>
                        @if (isset($data->associate_certificate->nism_va_no) && !empty($data->associate_certificate->nism_va_no))
                            <div class="row" id="nism_va_details">
                                <div class="col-sm-12">
                                    <h4 class="card-title">NISM VA CERTIFICATE</h4>
                                </div>
                                <div class="col-sm-8 nism_va_no">
                                    <div class="form-group">
                                        <label for="nism_va_no">NISM VA CERTIFICATE NUMBER </label>
                                        <input type="text" id="nism_va_no" class="form-control" value="{{ @$data->associate_certificate->nism_va_no }}"
                                            name="nism_va_no" aria-describedby="nism_va_no" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4 nism_va_upload">
                                    <div class="form-group">
                                        <label for="nism_va_upload" class="w-100">PROOF</label>
                                        @if(isset($data->associate_certificate->nism_va_upload) && !empty($data->associate_certificate->nism_va_upload))
                                            <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->associate_certificate->nism_va_upload }}')">View</button>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-8 nism_va_validity">
                                    <div class="form-group">
                                        <label for="nism_va_validity">VALIDITY </label>
                                        <input type="text" id="nism_va_validity" class="form-control" value="{{ @$data->associate_certificate->nism_va_validity }}"
                                            name="nism_va_validity" aria-describedby="nism_va_validity" disabled>

                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- End -->

                        <!-- If "PROFESSION" Selected :: RIA -->

                        <!-- If ABOVE Selected :: NISM -->
                        <!-- NISM XA CERTIFICATE  -->
                        @if (isset($data->associate_certificate->nism_xa_no) && !empty($data->associate_certificate->nism_xa_no))
                        <div class="row" id="nism_xa_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">NISM XA CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 nism_xa_no">
                                <div class="form-group">
                                    <label for="nism_xa_no">NISM XA CERTIFICATE NUMBER </label>
                                    <input type="text" id="nism_xa_no" class="form-control" value="{{ @$data->associate_certificate->nism_xa_no }}"
                                        name="nism_xa_no" aria-describedby="nism_xa_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 nism_xa_upload">
                                <div class="form-group">
                                    <label for="nism_xa_upload" class="w-100">PROOF</label>
                                    @if(isset($data->associate_certificate->nism_xa_upload) && !empty($data->associate_certificate->nism_xa_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->associate_certificate->nism_xa_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 nism_xa_validity">
                                <div class="form-group">
                                    <label for="nism_xa_validity">VALIDITY </label>
                                    <input type="text" id="nism_xa_validity" class="form-control" value="{{ @$data->associate_certificate->nism_xa_validity }}"
                                        name="nism_xa_validity" aria-describedby="nism_xa_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- NISM XB CERTIFICATE  -->
                        @if (isset($data->associate_certificate->nism_xb_no) && !empty($data->associate_certificate->nism_xb_no))
                        <div class="row" id="nism_xb_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">NISM XB CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 nism_xb_no">
                                <div class="form-group">
                                    <label for="nism_xb_no">NISM XB CERTIFICATE NUMBER </label>
                                    <input type="text" id="nism_xb_no" class="form-control" value="{{ @$data->associate_certificate->nism_xb_no }}"
                                        name="nism_xb_no" aria-describedby="nism_xb_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 nism_xb_upload">
                                <div class="form-group">
                                    <label for="nism_xb_upload" class="w-100">PROOF</label>
                                    @if(isset($data->associate_certificate->nism_xb_upload) && !empty($data->associate_certificate->nism_xb_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->associate_certificate->nism_xb_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 nism_xb_validity">
                                <div class="form-group">
                                    <label for="nism_xb_validity">VALIDITY </label>
                                    <input type="text" id="nism_xb_validity" class="form-control" value="{{ @$data->associate_certificate->nism_xb_validity }}"
                                        name="nism_xb_validity" aria-describedby="nism_xb_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- CFP CERTIFICATE  -->
                        @if (isset($data->associate_certificate->cfp_no) && !empty($data->associate_certificate->cfp_no))
                        <div class="row" id="cfp_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CFP CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 cfp_no">
                                <div class="form-group">
                                    <label for="cfp_no">CFP CERTIFICATE NUMBER </label>
                                    <input type="text" id="cfp_no" class="form-control" name="cfp_no" value="{{ @$data->associate_certificate->cfp_no }}"
                                        aria-describedby="cfp_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 cfp_upload">
                                <div class="form-group">
                                    <label for="cfp_upload" class="w-100">PROOF</label>
                                    @if(isset($data->associate_certificate->cfp_upload) && !empty($data->associate_certificate->cfp_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->associate_certificate->cfp_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cfp_validity">
                                <div class="form-group">
                                    <label for="cfp_validity">VALIDITY </label>
                                    <input type="text" id="cfp_validity" class="form-control" value="{{ @$data->associate_certificate->cfp_validity }}"
                                        name="cfp_validity" aria-describedby="cfp_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- CWM CERTIFICATE  -->
                        @if (isset($data->associate_certificate->cwm_no) && !empty($data->associate_certificate->cwm_no))
                        <div class="row" id="cwm_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CWM CERTIFICATE</h4>
                            </div>
                            <div class="col-sm-8 cwm_no">
                                <div class="form-group">
                                    <label for="cwm_no">CWM CERTIFICATE NUMBER </label>
                                    <input type="text" id="cwm_no" class="form-control" name="cwm_no" value="{{ @$data->associate_certificate->cwm_no }}"
                                        aria-describedby="cwm_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 cwm_upload">
                                <div class="form-group">
                                    <label for="cwm_upload" class="w-100">PROOF</label>
                                    @if(isset($data->associate_certificate->cwm_upload) && !empty($data->associate_certificate->cwm_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->associate_certificate->cwm_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cwm_validity">
                                <div class="form-group">
                                    <label for="cwm_validity">VALIDITY </label>
                                    <input type="text" id="cwm_validity" class="form-control" value="{{ @$data->associate_certificate->cwm_validity }}"
                                        name="cwm_validity" aria-describedby="cwm_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- CA CERTIFICATE  -->
                        @if (isset($data->associate_certificate->ca_no) && !empty($data->associate_certificate->ca_no))
                        <div class="row" id="ca_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CA DETAILS</h4>
                            </div>
                            <div class="col-sm-8 ca_no">
                                <div class="form-group">
                                    <label for="ca_no">CA CERTIFICATE NO </label>
                                    <input type="text" id="ca_no" class="form-control" name="ca_no" value="{{ @$data->associate_certificate->ca_no }}"
                                        aria-describedby="ca_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 ca_upload">
                                <div class="form-group">
                                    <label for="ca_upload" class="w-100">PROFF</label>
                                    @if(isset($data->associate_certificate->ca_upload) && !empty($data->associate_certificate->ca_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->associate_certificate->ca_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 ca_validity">
                                <div class="form-group">
                                    <label for="ca_validity">VALIDITY (IF ANY)</label>
                                    <input type="text" id="ca_validity" class="form-control" value="{{ @$data->associate_certificate->ca_validity }}"
                                        name="ca_validity" aria-describedby="ca_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- CS CERTIFICATE  -->
                        @if (isset($data->associate_certificate->cs_no) && !empty($data->associate_certificate->cs_no))
                        <div class="row" id="cs_details">
                            <div class="col-sm-12">
                                <h4 class="card-title">CS DETAILS</h4>
                            </div>
                            <div class="col-sm-8 cs_no">
                                <div class="form-group">
                                    <label for="cs_no">CS CERTIFICATE NO </label>
                                    <input type="text" id="cs_no" class="form-control" name="cs_no" value="{{ @$data->associate_certificate->cs_no }}"
                                        aria-describedby="cs_no" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4 cs_upload">
                                <div class="form-group">
                                    <label for="cs_upload" class="w-100">PROOF</label>
                                    @if(isset($data->associate_certificate->cs_upload) && !empty($data->associate_certificate->cs_upload))
                                        <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->associate_certificate->cs_upload }}')">View</button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 cs_validity">
                                <div class="form-group">
                                    <label for="cs_validity">VALIDITY  (IF ANY)</label>
                                    <input type="text" id="cs_validity" class="form-control" value="{{ @$data->associate_certificate->cs_validity }}"
                                        name="cs_validity" aria-describedby="cs_validity" disabled>

                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- OTHER CERTIFICATE  -->
                        @if (isset($data->associate_certificate->course_no) && !empty($data->associate_certificate->course_no))
                            <div class="row" id="course_details">
                                <div class="col-sm-12">
                                    <h4 class="card-title">Degree/Course Details</h4>
                                </div>
                                <div class="col-sm-8 course_name">
                                    <div class="form-group">
                                        <label for="course_name">Name of Course/Degree </label>
                                        <input type="text" id="course_name" class="form-control" value="{{ @$data->associate_certificate->course_name }}"
                                            name="course_name" aria-describedby="course_name" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4 course_upload">
                                    <div class="form-group">
                                        <label for="course_upload" class="w-100">PROOF</label>
                                        @if(isset($data->associate_certificate->course_upload) && !empty($data->associate_certificate->course_upload))
                                            <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->associate_certificate->course_upload }}')">View</button>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-8 course_no">
                                    <div class="form-group">
                                        <label for="course_no">COURSE CERTIFICATE NO </label>
                                        <input type="text" id="course_no" class="form-control" value="{{ @$data->associate_certificate->course_no }}"
                                            name="course_no" aria-describedby="course_no" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-8 course_validity">
                                    <div class="form-group">
                                        <label for="course_validity">VALIDITY (IF ANY)</label>
                                        <input type="text" id="course_validity" class="form-control" value="{{ @$data->associate_certificate->course_validity }}"
                                            name="course_validity" aria-describedby="course_validity" disabled>

                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- End -->
                        <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                    </section>
                    @endif
                    @if($data->entitytype_id == 4)
                    <section class="trial" id="nominee-detail" data-step="9" autocomplete="off">
                        <input type="hidden" name="nominee_state_code" id="nominee_state_code" value="{{ @$data->associate_nominee->nominee_state }}">
                        <input type="hidden" name="is_minor" id="is_minor" value="{{ isset($data->associate_nominee->is_minor) ?  $data->associate_nominee->is_minor : 0 }}">
                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Nominee </h3>
                        <div class="row">
                            <div class="col-sm-6 nominee_name">
                                <div class="form-group">
                                    <label for="nominee_name">Nominee Name </label>
                                    <input type="text" id="nominee_name" class="form-control text-capitalize" value="{{ @$data->associate_nominee->nominee_name }}"
                                        name="nominee_name" aria-describedby="nominee_name" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_birth_date">
                                <div class="form-group">
                                    <label for="nominee_birth_date">Date of Birth <span class="minor">(If Nominee Minor)</span></label>
                                    <input type="text" id="nominee_birth_date" class="form-control" value="{{ @$data->associate_nominee->nominee_birth_date }}"
                                        name="nominee_birth_date" aria-describedby="nominee_birth_date" disabled>
                                </div>
                            </div>
                            <!--
                            <div class="col-12">
                                    <div class="form-group custom-checkbox">
                                    <input type="checkbox" id="nominee_primary_address" name="nominee_primary_address" value="{{ @$data->associate_nominee->nominee_primary_address }}" @if(isset($data->associate_nominee->nominee_primary_address) && $data->associate_nominee->nominee_primary_address == 1){{'checked'}} @endif>
                                    <label for="nominee_primary_address">Address same as per Primary Holder</label>
                                </div>


                            </div>
                                -->
                            <div class="col-sm-6 nominee_address1">
                                <div class="form-group">
                                    <label for="nominee_address1">Address 1 </label>
                                    <input type="text" class="form-control text-capitalize" id="nominee_address1" value="{{ @$data->associate_nominee->nominee_address1 }}"
                                        aria-describedby="nominee_address1" name="nominee_address1" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_address2">
                                <div class="form-group">
                                    <label for="nominee_address2">Address 2</label>
                                    <input type="text" class="form-control text-capitalize" id="nominee_address2" value="{{ @$data->associate_nominee->nominee_address2 }}"
                                        aria-describedby="nominee_address2" name="nominee_address2" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_address3">
                                <div class="form-group">
                                    <label for="nominee_address3">Address 3</label>
                                    <input type="text" class="form-control text-capitalize" id="nominee_address3" value="{{ @$data->associate_nominee->nominee_address3 }}"
                                        aria-describedby="nominee_address3" name="nominee_address3" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_city">
                                <div class="form-group">
                                    <label for="nominee_city">City </label>
                                    <input type="text" class="form-control text-capitalize" id="nominee_city" value="{{ @$data->associate_nominee->nominee_city }}"
                                        aria-describedby="nominee_city" name="nominee_city" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_state">
                                <div class="form-group">
                                    <label for="nominee_state">State </label>
                                    <input type="text" class="form-control text-capitalize" id="nominee_state" value="{{ @$data->associate_nominee->nominee_state }}"
                                        aria-describedby="nominee_state" name="nominee_state" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_country">
                                <div class="form-group">
                                    <label for="nominee_country">Country </label>
                                    <input type="text" class="form-control text-capitalize" id="nominee_country" value="{{ @$data->associate_nominee->nominee_country }}"
                                        aria-describedby="nominee_country" name="nominee_country" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_pincode">
                                <div class="form-group">
                                    <label for="nominee_pincode">Pincode </label>
                                    <input type="text" id="nominee_pincode" class="form-control" value="{{ @$data->associate_nominee->nominee_pincode }}"
                                        aria-describedby="nominee_pincode" name="nominee_pincode" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_mobile">
                                <div class="form-group">
                                    <label for="nominee_mobile">Mobile Number</label>
                                    <input type="text" class="form-control" id="nominee_mobile" value="{{ @$data->associate_nominee->nominee_mobile }}"
                                        aria-describedby="nominee_mobile" name="nominee_mobile" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_telephone">
                                <div class="form-group">
                                    <label for="nominee_telephone">TELEPHONE NO</label>
                                    <input type="text" class="form-control" id="nominee_telephone" value="{{ @$data->associate_nominee->nominee_telephone }}"
                                        aria-describedby="nominee_telephone" name="nominee_telephone" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6 nominee_email">
                                <div class="form-group">
                                    <label for="nominee_email">EMAIL ADDRESS</label>
                                    <input type="text" class="form-control" id="nominee_email" value="{{ @$data->associate_nominee->nominee_email }}"
                                        aria-describedby="nominee_email" name="nominee_email" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                    </section>
                        @if(isset($data->associate_nominee->assoicate_guardian->guardian_nominee_relation) && !empty($data->associate_nominee->assoicate_guardian->guardian_nominee_relation))
                        <section class="trial" id="guardian-detail" data-step="10" autocomplete="off">

                            <input type="hidden" name="nominee_state_code" id="guardian_state_code" value="{{ @$data->associate_nominee->assoicate_guardian->state }}">
                            <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Guardian Details</h3>
                            <div class="row">
                                <div class="col-sm-8 guardian_name">
                                    <div class="form-group">
                                        <label for="guardian_name">Guardian Name </label>
                                        <input type="text" id="guardian_name" class="form-control text-capitalize" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_name }}"
                                            name="guardian_name" aria-describedby="guardian_name" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-8 guardian_pan_no">
                                            <div class="form-group">
                                                <label for="guardian_pan_no">PAN Number</label>
                                                <input type="text" class="form-control text-uppercase" id="guardian_pan_no" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}"
                                                    name="guardian_pan_no"
                                                    aria-describedby="guardian_pan_no" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 guardian_pan_upload">
                                            <div class="form-group">
                                                <label for="guardian_pan_upload" class="w-100">Upload PAN</label>
                                                @if(isset($data->guardian_pan_upload) && !empty($data->guardian_pan_upload))
                                                    <button type="button" class="btn btn-primary btn-sm form-control" onclick="showImage('{{ @$data->guardian_pan_upload }}')">View</button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm form-control">N/A</button>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-8 guardian_nominee_relation">

                                            <div class="form-group">
                                                <label for="guardian_nominee_relation">Relation With Nominee </label>
                                                <input type="text" class="form-control text-capitalize" id="guardian_nominee_relation" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_nominee_relation_name }}"
                                                    aria-describedby="guardian_nominee_relation" name="guardian_nominee_relation" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="col-12">
                                    <div class="form-group custom-checkbox">
                                        <input type="checkbox" id="guardian_primary_address" name="guardian_primary_address" value="{{ @$data->associate_nominee->nominee_primary_address }}" @if(isset($data->associate_nominee->nominee_primary_address) && $data->associate_nominee->nominee_primary_address == 1){{'checked'}} @endif>
                                        <label for="guardian_primary_address">Address same as per Primary Holder</label>
                                    </div>
                                </div>
                                -->
                                <div class="col-sm-6 guardian_address1">
                                    <div class="form-group">
                                        <label for="guardian_address1">Address 1 </label>
                                        <input type="text" class="form-control text-capitalize" id="guardian_address1" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}"
                                            aria-describedby="guardian_address1" name="guardian_address1" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_address2">
                                    <div class="form-group">
                                        <label for="guardian_address2">Address 2</label>
                                        <input type="text" class="form-control text-capitalize" id="guardian_address2" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}"
                                            aria-describedby="guardian_address2" name="guardian_address2" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_address3">
                                    <div class="form-group">
                                        <label for="guardian_address3">Address 3</label>
                                        <input type="text" class="form-control text-capitalize" id="guardian_address3" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}"
                                            aria-describedby="guardian_address3" name="guardian_address3" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_city">
                                    <div class="form-group">
                                        <label for="guardian_city">City </label>
                                        <input type="text" class="form-control text-capitalize" id="guardian_city" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pan_no }}"
                                            aria-describedby="guardian_city" name="guardian_city" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_state">
                                    <div class="form-group">
                                        <label for="guardian_state">State </label>
                                        <input type="text" id="guardian_state" class="form-control" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_state }}"
                                            aria-describedby="guardian_state" name="guardian_state" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_country">
                                    <div class="form-group">
                                        <label for="guardian_country">Country </label>
                                        <input type="text" id="guardian_country" class="form-control" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_country }}"
                                            aria-describedby="guardian_country" name="guardian_country" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_pincode">
                                    <div class="form-group">
                                        <label for="guardian_pincode">Pincode </label>
                                        <input type="text" id="guardian_pincode" class="form-control" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_pincode }}"
                                            aria-describedby="guardian_pincode" name="guardian_pincode" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_mobile">
                                    <div class="form-group">
                                        <label for="guardian_mobile">Mobile Number </label>
                                        <input type="text" class="form-control" id="guardian_mobile" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_mobile }}"
                                            aria-describedby="guardian_mobile" name="guardian_mobile" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_telephone">
                                    <div class="form-group">
                                        <label for="guardian_telephone">TELEPHONE NO</label>
                                        <input type="text" class="form-control" id="guardian_telephone" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_telephone }}"
                                            aria-describedby="guardian_telephone" name="guardian_telephone" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6 guardian_email">
                                    <div class="form-group">
                                        <label for="guardian_email">EMAIL ADDRESS </label>
                                        <input type="text" class="form-control" id="guardian_email" value="{{ @$data->associate_nominee->assoicate_guardian->guardian_email }}"
                                            aria-describedby="guardian_email" name="guardian_email" disabled>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="proceed btn btn-primary btn-lg">Next</button>
                        </section>
                        @endif
                    @endif

                    <section class="trial" id="commercial-detail" data-step="11" autocomplete="off">
                        <h3 class="card-title">Commercials</h3>
                        <div class="row" id="commercials">
                            <!--Testing-->
                            @foreach ($commercials as $commercial)
                                <div class="col-sm-12 {{ $commercial->field_name }}">
                                    <div class="form-group">
                                        <label for="commercials">{{ $commercial->name }} <span
                                            class="required-sign">*</span></label>
                                        <div class="multi-input">
                                            @foreach ($commercialtypes as $commercialtype)
                                                @php
                                                    $name = $commercial->field_name.'_'.$commercialtype->field_name;
                                                @endphp
                                            <div class="{{ $name }}">
                                                <div class="input-group">
                                                    <input type="number" name="{{ $name }}" class="form-control share_in"
                                                    id="{{ $name }}" class="form-control" value="{{ @$data->$name }}" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            @if($commercialtype->field_name == 'perc')
                                                            {{'%'}}
                                                            @else
                                                            {{$commercialtype->field_name}}
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
                            <div class="col-12 user_agree mt-20">
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
                        <div class="col-12 d-flex justify-content-center" id="show_doc">
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
<script type="text/javascript" src="{{ asset('external/js/associate.js') }}"></script>
<script>

</script>
@endsection
