<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kinntegra</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" href="favicon.ico" type="image/ico" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="{{ asset('assets/stylesheet/colorpicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/stylesheet/style.css') }}" />
    <style>
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
.employee_id,.view-item {display: none;}
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
/*Select2 ReadOnly End*/

    </style>
</head>

<body>
    @include('partials.fonts')

    <div class="body-wrapper">
        <div class="mobile-header">
            <a class="brand-image" href="#">
                <img src="/assets/images/logo.svg">
                <span>Kinntegra</span>
            </a>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="header-wrap">
            <header>
                <a class="brand-image" href="#">
                    <img src="/assets/images/logo.svg">
                    <span>Kinntegra</span>
                </a>
                <nav>
                    <ul>
                        <li>
                            <a href="#">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#dashboard" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#analytics" />
                                </svg>
                                <span>Analytics</span>
                            </a>
                        </li>
                        <li >
                            <a href="#">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#transactions" />
                                </svg>
                                <span>Transactions</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#logs" />
                                </svg>
                                <span>Trade Logs</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#client" />
                                </svg>
                                <span>Client</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#messenger" />
                                </svg>
                                <span>Messenger</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#calendar" />
                                </svg>
                                <span>Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a href="lead-generation.html">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#lead" />
                                </svg>
                                <span>Lead Management</span>
                            </a>
                        </li>
                        <li class="parent active">
                            <a href="javascript:void(0)">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#admin" />
                                </svg>
                                <span>Admin</span>
                            </a>

                            <ul class="children">
                                <li>
                                    <a href="admin.html">Accounts</a>
                                </li>
                                <li>
                                    <a href="#">Universal Reports</a>
                                </li>
                                <li>
                                    <a href="#">Data Modification</a>
                                </li>
                            </ul>

                        </li>
                        <li>
                            <a href="#">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <use xlink:href="#query" />
                                </svg>
                                <span>Query Management</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>
        </div>

        <main>
            <div class="container-fluid">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-4">
                                <h3 class="card-title">Create New Associate</h3>
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
                                    <li data-form="general-information" class="active">
                                        <div class="indicator">
                                            <div class="check"></div>
                                        </div>
                                        General Information
                                    </li>
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
                                    <li data-form="euin-detail">
                                        <div class="indicator">
                                            <div class="check"></div>
                                        </div>
                                        Certification
                                    </li>
                                    <li data-form="nominee-detail" class="isParent"  id="menu_nominee">
                                        <div class="indicator">
                                            <div class="check"></div>
                                        </div>
                                        Nominee
                                        <ul>
                                            <li class="isChild" data-form="guardian-detail">Guardian</li>
                                        </ul>
                                    </li>
                                    <li data-form="commercial-detail">
                                        <div class="indicator">
                                            <div class="check"></div>
                                        </div>
                                        Commercials
                                    </li>
                                </ul>
                            </div>
                            <form class="col-lg-5 col-md-8" enctype="multipart/form-data" id="form-information" method="POST" action="{{ route('associate.store') }}">
                                @csrf
                                <div class="step-forms">
                                <input type="hidden" name="step" value="1">
                                <input type="hidden" name="associate_id" value="">
                                    <section class="trial active" id="general-information" data-step="1" autocomplete="off">
                                        <h3 class="card-title"> General Information</h3>
                                        <div class="row flex-column">
                                            <input type="hidden" name="has_employee" id="has_employee" value="0">

                                            <div class="col-sm-8 introducer_id">

                                                <div class="form-group">
                                                    <!--List of Employee for Selected Associate-->
                                                    <label for="introducer_id">Introduced by <span
                                                            class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="introducer_id"
                                                            name="introducer_id">
                                                            <option value="" disabled selected>Select Introduced By
                                                            </option>
                                                            @empty($associates)
                                                            <option value="0">Kinntegra Business Solution Private
                                                                Limited</option>
                                                            @else
                                                                @foreach ($associates as $associate)
                                                                    <option value="{{$associate->id}}">{{ $associate->entity_name }}</option>
                                                                @endforeach
                                                            @endempty

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 employee_id">
                                                <div class="form-group">
                                                    <!--List of Employee for Selected Associate-->
                                                    <label for="employee_id">Introducer-Employee Name <span
                                                            class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="employee_id" name="employee_id">
                                                            <option value="" disabled selected>Select Employee</option>
                                                            <option value="1">Employee 1</option>
                                                            <option value="2">Employee 2</option>
                                                            <option value="3">Employee 3</option>
                                                            <option value="4">Employee 4</option>
                                                            <option value="5">Employee 5</option>
                                                            <option value="6">Employee 6</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 profession_id">
                                                <div class="form-group">
                                                    <label for="profession_id">Profession <span
                                                            class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="profession_id" name="profession_id">
                                                            <option value="" disabled selected>Select Profession</option>
                                                            @foreach ($professions as $profession)
                                                                <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 business_tag">
                                                <div class="form-group">
                                                    <label for="business_tag">Business Tag <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="business_tag" name="business_tag" readonly="true">
                                                            <option value="" disabled selected>Select Business Tag
                                                            </option>
                                                            <option value="self">Self</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="entity-detail" data-step="2" autocomplete="off">

                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Entity Details
                                        </h3>
                                        <div class="row flex-column">
                                            <div class="col-sm-8 entitytype_id">
                                                <div class="form-group">
                                                    <label for="entitytype_id">Entity Type <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="entitytype_id" name="entitytype_id">
                                                            <option value="" disabled selected>Select Entity Type</option>
                                                            @foreach ($entitytypes as $entitytype)
                                                            <option value="{{ $entitytype->id }}">{{ $entitytype->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 entity_name">
                                                <div class="form-group">
                                                    <label for="entity_name">Entity Name (As per Pancard) <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="entity_name"
                                                        aria-describedby="entity_name" name="entity_name">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 authorised_person1">
                                                <div class="form-group">
                                                    <label for="authorised_person1">Authorised Person 1 <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="authorised_person1"
                                                        aria-describedby="authorised_person1" name="authorised_person1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 authorised_email1">
                                                <div class="form-group">
                                                    <label for="authorised_email1">Email 1 <span
                                                        class="required-sign">*</span></label>
                                                    <input type="email" class="form-control" id="authorised_email1"
                                                        aria-describedby="authorised_email1" name="authorised_email1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 authorised_person2">
                                                <div class="form-group">
                                                    <label for="authorised_person2">Authorised Person 2 <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="authorised_person2"
                                                        aria-describedby="authorised_person2" name="authorised_person2">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 authorised_email2">
                                                <div class="form-group">
                                                    <label for="authorised_email2">Email 2 <span
                                                        class="required-sign">*</span></label>
                                                    <input type="email" class="form-control" id="authorised_email2"
                                                        aria-describedby="authorised_email2" name="authorised_email2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 authorised_person3">
                                                <div class="form-group">
                                                    <label for="authorised_person3">Authorised Person 3</label>
                                                    <input type="text" class="form-control text-capitalize" id="authorised_person3"
                                                        aria-describedby="authorised_person3" name="authorised_person3">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group authorised_email3">
                                                    <label for="authorised_email3">Email 3</label>
                                                    <input type="email" class="form-control" id="authorised_email3"
                                                        aria-describedby="authorised_email3" name="authorised_email3">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="photo-detail" data-step="3" autocomplete="off">

                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Photo ID Details
                                        </h3>
                                        <div class="row">
                                            <!-- For Individual Case :: Name, PANCARD NUMBER, AADHAR CARD NUMBER, Date of Birth field is require-->
                                            <div class="col-sm-8 name">
                                                <div class="form-group">
                                                    <label for="name">Name (As per Pancard) <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="name" name="name"
                                                        aria-describedby="name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 photo_upload">
                                                <div class="form-group">
                                                    <label for="photo_upload">PHOTO <span
                                                        class="required-sign">*</span></label>
                                                    <label for="photo_upload" class="btn input-btn w-100">
                                                        <input id="photo_upload" type="file" name="photo_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 pan_no">
                                                <div class="form-group">
                                                    <label for="pan_no">PANCARD NUMBER <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no"
                                                        aria-describedby="pan_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 pan_upload">
                                                <div class="form-group">
                                                    <label for="pan_upload">PANCARD <span
                                                        class="required-sign">*</span></label>
                                                    <label for="pan_upload" class="btn input-btn w-100">
                                                        <input id="pan_upload" type="file" name="pan_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 aadhar_no">
                                                <div class="form-group">
                                                    <label for="aadhar_no">AADHAR CARD NUMBER <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="aadhar_no"
                                                        name="aadhar_no" aria-describedby="aadhar_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 aadhar_upload">
                                                <div class="form-group">
                                                    <label for="aadhar_upload">AADHAR CARD <span
                                                        class="required-sign">*</span></label>
                                                    <label for="aadhar_upload" class="btn input-btn w-100">
                                                        <input id="aadhar_upload" type="file" name="aadhar_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 birth_incorp_date">
                                                <div class="form-group">
                                                    <label for="birth_incorp_date"><span id="birth_incorp_date">Date of
                                                        Birth</span> <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" name="birth_incorp_date" class="form-control"
                                                        id="birth_incorp_date" aria-describedby="birth_incorp_date">
                                                </div>
                                            </div>

                                        </div>
                                        <button  type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="address-detail" data-step="4" autocomplete="off">

                                        <!-- If Selected Individual on Entity Type, then Address 1, Address 2, Address 3, City, State, Country, Pincode,Mobile Number,Telephone No,Email Address Require -->
                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Address Details
                                        </h3>
                                        <div class="row">
                                            <div class="col-sm-12 address1">
                                                <div class="form-group ">
                                                    <label for="address1">Address 1 <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="address1"
                                                        aria-describedby="address1" name="address1">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 address2">
                                                <div class="form-group ">
                                                    <label for="address2">Address 2 <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="address2"
                                                        aria-describedby="address2" name="address2">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 address3">
                                                <div class="form-group">
                                                    <label for="address3">Address 3</label>
                                                    <input type="text" class="form-control text-capitalize" id="address3"
                                                        aria-describedby="address3" name="address3">
                                                </div>
                                            </div>


                                            <div class="col-sm-6 city">
                                                <div class="form-group">
                                                    <label for="city">City <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="city"
                                                        aria-describedby="city" name="city">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 state">
                                                <div class="form-group">
                                                    <label for="state">State <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="state" name="state">
                                                            <option value="" disabled selected>Select State</option>
                                                            <option value="3345">Maharashtra</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 country">
                                                <div class="form-group">
                                                    <label for="country">Country <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="country" name="country">
                                                            <option value="" disabled selected>Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}" @if($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 pincode">
                                                <div class="form-group">
                                                    <label for="pincode">Pincode <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="pincode" class="form-control"
                                                        aria-describedby="pincode" name="pincode">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 address_upload">
                                                <div class="form-group">
                                                    <label for="address_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="address_upload" class="btn input-btn w-100">
                                                        <input id="address_upload" type="file" name="address_upload"/>
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        UPLOAD
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mobile">
                                                <div class="form-group">
                                                    <label for="mobile">Mobile Number <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="mobile"
                                                        aria-describedby="mobile" name="mobile">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 telephoneno">
                                                <div class="form-group">
                                                    <label for="telephoneno">TELEPHONE NO</label>
                                                    <input type="text" class="form-control" id="telephoneno"
                                                        aria-describedby="telephoneno" name="telephoneno">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 email">
                                                <div class="form-group">
                                                    <label for="email">EMAIL ADDRESS <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="email"
                                                        aria-describedby="email" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="bank-detail" data-step="5" autocomplete="off">

                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Bank Details
                                        </h3>

                                        <div class="row">
                                            <div class="col-sm-12 mdf_ria">
                                                <h4 class="card-title">MFD Bank Details</h4>
                                            </div>
                                            <div class="col-sm-8 ifsc_no">
                                                <div class="form-group">
                                                    <label for="ifsc_no">IFSC Number <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-uppercase" id="ifsc_no" name="ifsc_no"
                                                        aria-describedby="ifsc_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 cheque_upload">
                                                <div class="form-group">
                                                    <label for="cheque_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="cheque_upload" class="btn input-btn w-100">
                                                        <input id="cheque_upload" type="file" name="cheque_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 bank_name">
                                                <div class="form-group">
                                                    <label for="bank_name">Bank Name <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control  text-capitalize" id="bank_name"
                                                        name="bank_name" aria-describedby="bank_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 branch_name">
                                                <div class="form-group">
                                                    <label for="branch_name">Branch <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="branch_name"
                                                        name="branch_name" aria-describedby="branch_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 micr">
                                                <div class="form-group">
                                                    <label for="micr">MICR <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="micr" name="micr"
                                                        aria-describedby="micr" placeholder="Enter MICR">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 account_type">
                                                <div class="form-group">
                                                    <label for="account_type">Account Type <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="account_type"
                                                            name="account_type">
                                                            <option value="" disabled selected>Select Account Type
                                                            </option>
                                                            <option value="Saving">Saving Account</option>
                                                            <option value="Current">Current Account</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 account_no">
                                                <div class="form-group">
                                                    <label for="account_no">Account Number <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="account_no"
                                                        aria-describedby="account_no" name="account_no">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="mfd_ria_bank">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">RIA Bank Details</h4>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_ifsc_no">
                                                <div class="form-group">
                                                    <label for="mfd_ria_ifsc_no">IFSC Number <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-uppercase" id="mfd_ria_ifsc_no" name="mfd_ria_ifsc_no"
                                                        aria-describedby="mfd_ria_ifsc_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 mfd_ria_cheque_upload">
                                                <div class="form-group">
                                                    <label for="mfd_ria_cheque_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="mfd_ria_cheque_upload" class="btn input-btn w-100">
                                                        <input id="mfd_ria_cheque_upload" type="file" name="mfd_ria_cheque_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_bank_name">
                                                <div class="form-group">
                                                    <label for="mfd_ria_bank_name">Bank Name <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_bank_name"
                                                        name="mfd_ria_bank_name" aria-describedby="mfd_ria_bank_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_branch_name">
                                                <div class="form-group">
                                                    <label for="mfd_ria_branch_name">Branch <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_branch_name"
                                                        name="mfd_ria_branch_name" aria-describedby="mfd_ria_branch_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_micr">
                                                <div class="form-group">
                                                    <label for="mfd_ria_micr">MICR <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="mfd_ria_micr" name="mfd_ria_micr"
                                                        aria-describedby="mfd_ria_micr" placeholder="Enter MICR">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_account_type">
                                                <div class="form-group">
                                                    <label for="mfd_ria_account_type">Account Type <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="mfd_ria_account_type"
                                                            name="mfd_ria_account_type">
                                                            <option value="" disabled selected>Select Account Type
                                                            </option>
                                                            <option value="Saving">Saving Account</option>
                                                            <option value="Current">Current Account</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 mfd_ria_account_no">
                                                <div class="form-group">
                                                    <label for="mfd_ria_account_no">Account Number <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="mfd_ria_account_no"
                                                        aria-describedby="mfd_ria_account_no" name="mfd_ria_account_no">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="other-detail" data-step="6" autocomplete="off">

                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Other Details
                                        </h3>
                                        <div class="row" id="gst_details">
                                            <div class="col-sm-12">
                                                <h4 class="form-group">
                                                    GST Details
                                                </h4>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group gst_no">
                                                    <label for="gst_no">GST Number</label>
                                                    <input type="text" class="form-control text-uppercase" id="gst_no" name="gst_no"
                                                        aria-describedby="gst_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group gst_upload">
                                                    <label for="gst_upload">PROOF</label>
                                                    <label for="gst_upload" class="btn input-btn w-100">
                                                        <input id="gst_upload" type="file" name="gst_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group gst_validity">
                                                    <label for="gst_validity">VALIDITY (If ANY)</label>
                                                    <input type="text" class="form-control" id="gst_validity"
                                                        name="gst_validity" aria-describedby="gst_validity">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="shop_est_details">
                                            <div class="col-sm-12">
                                                <h4>SHOP & ESTABLISHMENT Details </h4>
                                            </div>
                                            <div class="col-sm-8 shop_est_no">
                                                <div class="form-group">
                                                    <label for="shop_est_no">SHOP & ESTABLISHMENT CERTIFICATE NO <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="shop_est_no"
                                                        aria-describedby="shop_est_no" name="shop_est_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 shop_est_upload">
                                                <div class="form-group">
                                                    <label for="shop_est_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="shop_est_upload" class="btn input-btn w-100">
                                                        <input id="shop_est_upload" type="file"
                                                            name="shop_est_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 shop_est_validity">
                                                <div class="form-group">
                                                    <label for="shop_est_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="shop_est_validity"
                                                        name="shop_est_validity" aria-describedby="gst_validity">
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
                                                <div class="form-group">
                                                    <label for="pd_upload">PARTNERSHIP DEEP <span
                                                        class="required-sign">*</span></label>
                                                    <label for="pd_upload" class="btn input-btn w-100">
                                                        <input id="pd_upload" type="file" name="pd_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 pd_asl_upload">
                                                <div class="form-group">
                                                    <label for="pd_asl_upload">AUTHORIZED SIGNATORY LIST <span
                                                        class="required-sign">*</span></label>
                                                    <label for="pd_asl_upload" class="btn input-btn w-100">
                                                        <input id="pd_asl_upload" type="file" name="pd_asl_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 pd_coi_upload">
                                                <div class="form-group">
                                                    <label for="pd_coi_upload">CERTIFICATE OF INCORPORATION <span
                                                        class="required-sign">*</span></label>
                                                    <label for="pd_coi_upload" class="btn input-btn w-100">
                                                        <input id="pd_coi_upload" type="file" name="pd_coi_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
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
                                                <div class="form-group">
                                                    <label for="co_moa_upload">MEMORANDUM OF ASSOCIATION <span
                                                        class="required-sign">*</span></label>
                                                    <label for="co_moa_upload" class="btn input-btn w-100">
                                                        <input id="co_moa_upload" type="file" name="co_moa_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 co_aoa_upload">
                                                <div class="form-group">
                                                    <label for="co_aoa_upload">ARTICLE OF ASSOCIATION <span
                                                        class="required-sign">*</span></label>
                                                    <label for="co_aoa_upload" class="btn input-btn w-100">
                                                        <input id="co_aoa_upload" type="file" name="co_aoa_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 co_coi_upload">
                                                <div class="form-group">
                                                    <label for="co_coi_upload">CERTIFICATE OF INCORPORATION <span
                                                        class="required-sign">*</span></label>
                                                    <label for="co_coi_upload" class="btn input-btn w-100">
                                                        <input id="co_coi_upload" type="file" name="co_coi_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 co_asl_upload">
                                                <div class="form-group">
                                                    <label for="co_asl_upload">AUTHORIZED SIGNATORY LIST <span
                                                        class="required-sign">*</span></label>
                                                    <label for="co_asl_upload" class="btn input-btn w-100">
                                                        <input id="co_asl_upload" type="file" name="co_asl_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 co_br_upload">
                                                <div class="form-group">
                                                    <label for="co_br_upload">BOARD RESOLUTION <span
                                                        class="required-sign">*</span></label>
                                                    <label for="co_br_upload" class="btn input-btn w-100">
                                                        <input id="co_br_upload" type="file" name="co_br_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
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
                                                    <input type="text" class="form-control" name="primary_color"
                                                        id="primary_color" aria-describedby="primary_color"
                                                        placeholder="Primary Color">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 logo_upload">
                                                <div class="form-group">
                                                    <label for="logo_upload">Upload Logo</label>
                                                    <label for="logo_upload" class="btn input-btn w-100">
                                                        <input id="logo_upload" type="file" name="logo_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 secondary_color">
                                                <div class="form-group">
                                                    <label for="secondary_color">Secondary Color</label>
                                                    <input type="text" class="form-control" name="secondary_color"
                                                        id="secondary_color" aria-describedby="secondary_color"
                                                        placeholder="Secondary Color">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="license-detail" data-step="7" autocomplete="off">

                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> License Details
                                        </h3>
                                        <!-- Section Start for ARN -->
                                        <!-- If "PROFESSION" Selected :: MFD -->
                                        <div class="row" id="arn_details">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">AMFI Details</h4>
                                            </div>
                                            <div class="col-sm-8 arn_name">
                                                <div class="form-group">
                                                    <label for="arn_name">NAME AS PER ARN <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="arn_name" class="form-control text-capitalize"
                                                        name="arn_name" aria-describedby="arn_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 arn_upload">
                                                <div class="form-group">
                                                    <label for="arn_upload">ARN REGISTRATION <span
                                                        class="required-sign">*</span></label>
                                                    <label for="arn_upload" class="btn input-btn w-100">
                                                        <input id="arn_upload" type="file" name="arn_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        UPLOAD
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 arn_rgn_no">
                                                <div class="form-group">
                                                    <label for="arn_rgn_no">ARN REGISTRATION NUMBER <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="arn_rgn_no" class="form-control"
                                                        name="arn_rgn_no" aria-describedby="arn_rgn_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 arn_validity">
                                                <div class="form-group">
                                                    <label for="arn_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="arn_validity" class="form-control"
                                                        name="arn_validity" aria-describedby="arn_validity">

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
                                                    <label for="euin_name">Name of EUIN Holder <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="euin_name"
                                                        name="euin_name" aria-describedby="euin_name" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4 euin_upload">
                                                <div class="form-group">
                                                    <label for="euin_upload">EUIN Details <span
                                                        class="required-sign">*</span></label>
                                                    <label for="euin_upload" class="btn input-btn w-100">
                                                        <input id="euin_upload" type="file" name="euin_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 euin_no">
                                                <div class="form-group">
                                                    <label for="euin_no">EUIN Number <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="euin_no" class="form-control" name="euin_no"
                                                        aria-describedby="euin_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 euin_validity">
                                                <div class="form-group">
                                                    <label for="euin_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="euin_validity" class="form-control"
                                                        name="euin_validity" aria-describedby="euin_validity">

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
                                                    <label for="ria_name">NAME AS PER RIA <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="ria_name" name="ria_name"
                                                        class="form-control text-capitalize">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ria_upload">
                                                <div class="form-group">
                                                    <label for="ria_upload">RIA CERTIFICATE <span
                                                        class="required-sign">*</span></label>
                                                    <label for="ria_upload" class="btn input-btn w-100">
                                                        <input id="ria_upload" type="file" name="ria_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        UPLOAD
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ria_rgn_no">
                                                <div class="form-group">
                                                    <label for="ria_rgn_no">SEBI REGISTRATION NUMBER <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="ria_rgn_no" class="form-control"
                                                        name="ria_rgn_no" aria-describedby="ria_rgn_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ria_validity">
                                                <div class="form-group">
                                                    <label for="ria_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="ria_validity" class="form-control"
                                                        name="ria_validity" aria-describedby="ria_validity">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- END -->
                                        <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="euin-detail" data-step="8" autocomplete="off">

                                        <!-- NISM VA CERTIFICATE  -->
                                        <!-- If "PROFESSION" Selected :: MFD -->
                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Certification
                                        </h3>

                                        <div class="row" id="nism_va_details">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">NISM VA CERTIFICATE</h4>
                                            </div>
                                            <div class="col-sm-8 nism_va_no">
                                                <div class="form-group">
                                                    <label for="nism_va_no">NISM VA CERTIFICATE NUMBER <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="nism_va_no" class="form-control"
                                                        name="nism_va_no" aria-describedby="nism_va_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 nism_va_upload">
                                                <div class="form-group">
                                                    <label for="nism_va_upload">NISM VA CERTIFICATE <span
                                                        class="required-sign">*</span></label>
                                                    <label for="nism_va_upload" class="btn input-btn w-100">
                                                        <input id="nism_va_upload" type="file" name="nism_va_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 nism_va_validity">
                                                <div class="form-group">
                                                    <label for="nism_va_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="nism_va_validity" class="form-control"
                                                        name="nism_va_validity" aria-describedby="nism_va_validity">

                                                </div>
                                            </div>
                                        </div>


                                        <!-- End -->

                                        <!-- If "PROFESSION" Selected :: RIA -->
                                        <div class="row flex-column" id="ria_type">
                                            <div class="col-sm-8 ria_certificate_type">
                                                <div class="form-group">
                                                    <label for="ria_certificate_type">Certification Type <span
                                                        class="required-sign">*</span></label>
                                                    <div class="dropdown customMulti">
                                                        <a class="dropdown-toggle select-dropdown"
                                                            type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-grey">Select Year</span>
                                                        </a>
                                                        <div id="ria_certificate_type" class="dropdown-menu dropdown-menu-left select-dropdown-list">
                                                            {{-- <div class="data-list view-item">
                                                                <div class="dropdown-item">
                                                                    <span class="d-block">NISM</span>
                                                                    <span class="d-block">NISM</span>
                                                                    <span class="d-block">NISM</span>
                                                                </div>
                                                                <div class="dropdown-divider"></div>
                                                            </div> --}}
                                                            <input type="hidden" name="ria_type_nism" value="0">
                                                            <input type="hidden" name="ria_type_cfp" value="0">
                                                            <input type="hidden" name="ria_type_cwm" value="0">
                                                            <div class="data-list">
                                                                <a class="dropdown-item">
                                                                    <div class="form-group custom-checkbox m-0">
                                                                        <input type="checkbox" name="ria_certificate_type[]" id="nism" value="nism">
                                                                        <label for="nism">NISM</label>
                                                                    </div>
                                                                </a>
                                                                <a class="dropdown-item">
                                                                    <div class="form-group custom-checkbox m-0">
                                                                        <input type="checkbox" name="ria_certificate_type[]" id="cfp" value="cfp">
                                                                        <label for="cfp">CFP</label>
                                                                    </div>
                                                                </a>
                                                                <a class="dropdown-item">
                                                                    <div class="form-group custom-checkbox m-0">
                                                                        <input type="checkbox" name="ria_certificate_type[]" id="cwm" value="cwm">
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
                                                    <input type="text" id="nism_xa_no" class="form-control"
                                                        name="nism_xa_no" aria-describedby="nism_xa_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 nism_xa_upload">
                                                <div class="form-group">
                                                    <label for="nism_xa_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="nism_xa_upload" class="btn input-btn w-100">
                                                        <input id="nism_xa_upload" type="file" name="nism_xa_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 nism_xa_validity">
                                                <div class="form-group">
                                                    <label for="nism_xa_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="nism_xa_validity" class="form-control"
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
                                                    <input type="text" id="nism_xb_no" class="form-control"
                                                        name="nism_xb_no" aria-describedby="nism_xb_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 nism_xb_upload">
                                                <div class="form-group">
                                                    <label for="nism_xb_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="nism_xb_upload" class="btn input-btn w-100">
                                                        <input id="nism_xb_upload" type="file" name="nism_xb_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 nism_xb_validity">
                                                <div class="form-group">
                                                    <label for="nism_xb_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="nism_xb_validity" class="form-control"
                                                        name="nism_xb_validity" aria-describedby="nism_xb_validity">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- CFP CERTIFICATE  -->
                                        <div class="row" id="other_details">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">Note</h4>
                                            </div>
                                            <div class="col-sm-8">
                                                <h6>Kindly Make a note that your CERTIFICATE will be address as per Business TAG</h6>
                                            </div>
                                        </div>
                                        <div class="row" id="cfp_details">
                                            <div class="col-sm-12">
                                                <h4 class="card-title">CFP CERTIFICATE</h4>
                                            </div>
                                            <div class="col-sm-8 cfp_no">
                                                <div class="form-group">
                                                    <label for="cfp_no">CFP CERTIFICATE NUMBER <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="cfp_no" class="form-control" name="cfp_no"
                                                        aria-describedby="cfp_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 cfp_upload">
                                                <div class="form-group">
                                                    <label for="cfp_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="cfp_upload" class="btn input-btn w-100">
                                                        <input id="cfp_upload" type="file" name="cfp_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 cfp_validity">
                                                <div class="form-group">
                                                    <label for="cfp_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="cfp_validity" class="form-control"
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
                                                    <input type="text" id="cwm_no" class="form-control" name="cwm_no"
                                                        aria-describedby="cwm_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 cwm_upload">
                                                <div class="form-group">
                                                    <label for="cwm_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="cwm_upload" class="btn input-btn w-100">
                                                        <input id="cwm_upload" type="file" name="cwm_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 cwm_validity">
                                                <div class="form-group">
                                                    <label for="cwm_validity">VALIDITY <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="cwm_validity" class="form-control"
                                                        name="cwm_validity" aria-describedby="cwm_validity">

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
                                                    <input type="text" id="ca_no" class="form-control" name="ca_no"
                                                        aria-describedby="ca_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ca_upload">
                                                <div class="form-group">
                                                    <label for="ca_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="ca_upload" class="btn input-btn w-100">
                                                        <input id="ca_upload" type="file" name="ca_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 ca_validity">
                                                <div class="form-group">
                                                    <label for="ca_validity">VALIDITY (IF ANY)</label>
                                                    <input type="text" id="ca_validity" class="form-control"
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
                                                    <input type="text" id="cs_no" class="form-control" name="cs_no"
                                                        aria-describedby="cs_no">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 cs_upload">
                                                <div class="form-group">
                                                    <label for="cs_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="cs_upload" class="btn input-btn w-100">
                                                        <input id="cs_upload" type="file" name="cs_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 cs_validity">
                                                <div class="form-group">
                                                    <label for="cs_validity">VALIDITY  (IF ANY)</label>
                                                    <input type="text" id="cs_validity" class="form-control"
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
                                                    <input type="text" id="course_name" class="form-control"
                                                        name="course_name" aria-describedby="course_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 course_upload">
                                                <div class="form-group">
                                                    <label for="course_upload">PROOF <span
                                                        class="required-sign">*</span></label>
                                                    <label for="course_upload" class="btn input-btn w-100">
                                                        <input id="course_upload" type="file" name="course_upload" />
                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                            <use xlink:href="#upload" />
                                                        </svg>
                                                        Upload
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 course_no">
                                                <div class="form-group">
                                                    <label for="course_no">COURSE CERTIFICATE NO <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="course_no" class="form-control"
                                                        name="course_no" aria-describedby="course_no">
                                                </div>
                                            </div>

                                            <div class="col-sm-8 course_validity">
                                                <div class="form-group">
                                                    <label for="course_validity">VALIDITY (IF ANY)</label>
                                                    <input type="text" id="course_validity" class="form-control"
                                                        name="course_validity" aria-describedby="course_validity">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End -->
                                        <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="nominee-detail" data-step="9" autocomplete="off">
                                        <input type="hidden" name="is_minor" value="0">
                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Nominee</h3>
                                        <div class="row">
                                            <div class="col-sm-6 nominee_name">
                                                <div class="form-group">
                                                    <label for="nominee_name">Nominee Name <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="nominee_name" class="form-control text-capitalize"
                                                        name="nominee_name" aria-describedby="nominee_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_birth_date">
                                                <div class="form-group">
                                                    <label for="nominee_birth_date">Date of Birth (If Minor)</label>
                                                    <input type="text" id="nominee_birth_date" class="form-control"
                                                        name="nominee_birth_date" aria-describedby="nominee_birth_date">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group custom-checkbox">
                                                    <input type="checkbox" id="is_primary_address" name="is_primary_address" value="0">
                                                    <label for="is_primary_address">Address same as per Primary
                                                        Holder</label>
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
                                                    <label for="nominee_address1">Address 1 <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="nominee_address1"
                                                        aria-describedby="nominee_address1" name="nominee_address1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_address2">
                                                <div class="form-group">
                                                    <label for="nominee_address2">Address 2</label>
                                                    <input type="text" class="form-control text-capitalize" id="nominee_address2"
                                                        aria-describedby="nominee_address2" name="nominee_address2">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_address3">
                                                <div class="form-group">
                                                    <label for="nominee_address3">Address 3</label>
                                                    <input type="text" class="form-control text-capitalize" id="nominee_address3"
                                                        aria-describedby="nominee_address3" name="nominee_address3">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_city">
                                                <div class="form-group">
                                                    <label for="nominee_city">City <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="nominee_city"
                                                        aria-describedby="nominee_city" name="nominee_city">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_state">
                                                <div class="form-group">
                                                    <label for="nominee_state">State <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="nominee_state"
                                                            name="nominee_state">
                                                            <option value="" disabled selected>Select State</option>
                                                            <option>Maharashtra</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_country">
                                                <div class="form-group">
                                                    <label for="nominee_country">Country <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="nominee_country"
                                                            name="nominee_country">
                                                            <option value="" disabled selected>Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}" @if($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_pincode">
                                                <div class="form-group">
                                                    <label for="nominee_pincode">Pincode <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="nominee_pincode" class="form-control"
                                                        aria-describedby="nominee_pincode" name="nominee_pincode">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_mobile">
                                                <div class="form-group">
                                                    <label for="nominee_mobile">Mobile Number</label>
                                                    <input type="text" class="form-control" id="nominee_mobile"
                                                        aria-describedby="nominee_mobile" name="nominee_mobile">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_telephone">
                                                <div class="form-group">
                                                    <label for="nominee_telephone">TELEPHONE NO</label>
                                                    <input type="text" class="form-control" id="nominee_telephone"
                                                        aria-describedby="nominee_telephone" name="nominee_telephone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 nominee_email">
                                                <div class="form-group">
                                                    <label for="nominee_email">EMAIL ADDRESS</label>
                                                    <input type="text" class="form-control" id="nominee_email"
                                                        aria-describedby="nominee_email" name="nominee_email">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                    </section>
                                    <section class="trial" id="guardian-detail" data-step="10" autocomplete="off">

                                        <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Guardian Details
                                        </h3>
                                        <div class="row">
                                            <div class="col-sm-8 guardian_name">
                                                <div class="form-group">
                                                    <label for="guardian_name">Guardian Name <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="guardian_name" class="form-control text-capitalize"
                                                        name="guardian_name" aria-describedby="guardian_name">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-sm-8 guardian_pan_no">
                                                        <div class="form-group">
                                                            <label for="guardian_pan_no">PAN Number <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-uppercase" id="guardian_pan_no"
                                                                name="guardian_pan_no"
                                                                aria-describedby="guardian_pan_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 guardian_pan_upload">
                                                        <div class="form-group">
                                                            <label for="guardian_pan_upload">Upload PAN <span
                                                                class="required-sign">*</span></label>
                                                            <label for="guardian_pan_upload"
                                                                class="btn input-btn w-100">
                                                                <input id="guardian_pan_upload" type="file"
                                                                    name="guardian_pan_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 guardian_nominee_relation">
                                                        <div class="form-group">
                                                            <label for="guardian_nominee_relation">Relation With Nominee <span
                                                                    class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="guardian_nominee_relation" name="guardian_nominee_relation">
                                                                    <option value="" disabled selected>Select Profession</option>
                                                                    @foreach ($relations as $relation)
                                                                        <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-sm-6 guardian_address1">
                                                <div class="form-group">
                                                    <label for="guardian_address1">Address 1 <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="guardian_address1"
                                                        aria-describedby="guardian_address1" name="guardian_address1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_address2">
                                                <div class="form-group">
                                                    <label for="guardian_address2">Address 2</label>
                                                    <input type="text" class="form-control text-capitalize" id="guardian_address2"
                                                        aria-describedby="guardian_address2" name="guardian_address2">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_address3">
                                                <div class="form-group">
                                                    <label for="guardian_address3">Address 3</label>
                                                    <input type="text" class="form-control text-capitalize" id="guardian_address3"
                                                        aria-describedby="guardian_address3" name="guardian_address3">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_city">
                                                <div class="form-group">
                                                    <label for="guardian_city">City <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control text-capitalize" id="guardian_city"
                                                        aria-describedby="guardian_city" name="guardian_city">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_state">
                                                <div class="form-group">
                                                    <label for="guardian_state">State <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="guardian_state"
                                                            name="guardian_state">
                                                            <option value="" disabled selected>Select State</option>
                                                            <option>Maharashtra</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_country">
                                                <div class="form-group">
                                                    <label for="guardian_country">Country <span
                                                        class="required-sign">*</span></label>
                                                    <div class="select-wrapper">
                                                        <select class="form-control" id="guardian_country"
                                                            name="guardian_country">
                                                            <option value="" disabled selected>Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}" @if($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_pincode">
                                                <div class="form-group">
                                                    <label for="guardian_pincode">Pincode <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" id="guardian_pincode" class="form-control"
                                                        aria-describedby="guardian_pincode" name="guardian_pincode">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_mobile">
                                                <div class="form-group">
                                                    <label for="guardian_mobile">Mobile Number <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="guardian_mobile"
                                                        aria-describedby="guardian_mobile" name="guardian_mobile">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_telephone">
                                                <div class="form-group">
                                                    <label for="guardian_telephone">TELEPHONE NO</label>
                                                    <input type="text" class="form-control" id="guardian_telephone"
                                                        aria-describedby="guardian_telephone" name="guardian_telephone">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 guardian_email">
                                                <div class="form-group">
                                                    <label for="guardian_email">EMAIL ADDRESS <span
                                                        class="required-sign">*</span></label>
                                                    <input type="text" class="form-control" id="guardian_email"
                                                        aria-describedby="guardian_email" name="guardian_email">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-lg">Confirm</button>
                                    </section>
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
                                                            <div class="{{ $commercial->field_name }}_{{$commercialtype->field_name}}">
                                                                <div>
                                                                    <input type="number" name="{{ $commercial->field_name }}_{{$commercialtype->field_name}}" class="form-control share_in"
                                                                    id="{{ $commercial->field_name }}_{{$commercialtype->field_name}}" class="form-control">
                                                                    <span>
                                                                        @if($commercialtype->field_name == 'perc')
                                                                        {{'%'}}
                                                                        @else
                                                                        {{$commercialtype->field_name}}
                                                                        @endif
                                                                    </span>

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

                                        <button type="button" class="btn btn-primary btn-lg">Confirm</button>
                                    </section>

                                </div>
                            </form>
                            <div class="col-xl-4 col-lg-3 d-none d-lg-flex">
                                <lottie-player src="/assets/images/data.json" background="transparent" speed="1"
                                    style="height: 300px;" loop autoplay></lottie-player>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
    <div class="menu-backdrop"></div>

    <script src="{{ asset('modules/jquery/dist/jquery.min.js') }}"></script>
    <!-- <script src="{{ asset('modules/bootstrap-daterangepicker/moment.min.js') }}"></script> -->
    <script src="{{ asset('modules/bootstrap/js/dist/util.js') }}"></script>
    <script src="{{ asset('modules/bootstrap/js/dist/collapse.js') }}"></script>
    <script src="{{ asset('modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('modules/bootstrap/js/dist/dropdown.js') }}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="{{ asset('modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('modules/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/common.js') }}"></script>

    <script type="text/javasc<!DOCTYPE html>
        <html lang="en">

        <head>
            <title>Kinntegra</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
            <link rel="icon" href="favicon.ico" type="image/ico" sizes="16x16">
            <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" media="screen" type="text/css" href="{{ asset('assets/stylesheet/colorpicker.css') }}" />
            <link rel="stylesheet" href="{{ asset('assets/stylesheet/style.css') }}" />
            <style>
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
        .employee_id,.view-item {display: none;}
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
        /*Select2 ReadOnly End*/

            </style>
        </head>

        <body>
            @include('partials.fonts')

            <div class="body-wrapper">
                <div class="mobile-header">
                    <a class="brand-image" href="#">
                        <img src="/assets/images/logo.svg">
                        <span>Kinntegra</span>
                    </a>
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <div class="header-wrap">
                    <header>
                        <a class="brand-image" href="#">
                            <img src="/assets/images/logo.svg">
                            <span>Kinntegra</span>
                        </a>
                        <nav>
                            <ul>
                                <li>
                                    <a href="#">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#dashboard" />
                                        </svg>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#analytics" />
                                        </svg>
                                        <span>Analytics</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="#">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#transactions" />
                                        </svg>
                                        <span>Transactions</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#logs" />
                                        </svg>
                                        <span>Trade Logs</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#client" />
                                        </svg>
                                        <span>Client</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#messenger" />
                                        </svg>
                                        <span>Messenger</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#calendar" />
                                        </svg>
                                        <span>Calendar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="lead-generation.html">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#lead" />
                                        </svg>
                                        <span>Lead Management</span>
                                    </a>
                                </li>
                                <li class="parent active">
                                    <a href="javascript:void(0)">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#admin" />
                                        </svg>
                                        <span>Admin</span>
                                    </a>

                                    <ul class="children">
                                        <li>
                                            <a href="admin.html">Accounts</a>
                                        </li>
                                        <li>
                                            <a href="#">Universal Reports</a>
                                        </li>
                                        <li>
                                            <a href="#">Data Modification</a>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="60" height="60" viewBox="0 0 60 60">
                                            <use xlink:href="#query" />
                                        </svg>
                                        <span>Query Management</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </header>
                </div>

                <main>
                    <div class="container-fluid">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-md-4">
                                        <h3 class="card-title">Create New Associate</h3>
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
                                            <li data-form="general-information" class="active">
                                                <div class="indicator">
                                                    <div class="check"></div>
                                                </div>
                                                General Information
                                            </li>
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
                                            <li data-form="euin-detail">
                                                <div class="indicator">
                                                    <div class="check"></div>
                                                </div>
                                                Certification
                                            </li>
                                            <li data-form="nominee-detail" class="isParent"  id="menu_nominee">
                                                <div class="indicator">
                                                    <div class="check"></div>
                                                </div>
                                                Nominee
                                                <ul>
                                                    <li class="isChild" data-form="guardian-detail">Guardian</li>
                                                </ul>
                                            </li>
                                            <li data-form="commercial-detail">
                                                <div class="indicator">
                                                    <div class="check"></div>
                                                </div>
                                                Commercials
                                            </li>
                                        </ul>
                                    </div>
                                    <form class="col-lg-5 col-md-8" enctype="multipart/form-data" id="form-information" method="POST" action="{{ route('associate.store') }}">
                                        @csrf
                                        <div class="step-forms">
                                        <input type="hidden" name="step" value="1">
                                        <input type="hidden" name="associate_id" value="{{ @$data->id}}">
                                            <section class="trial active" id="general-information" data-step="1" autocomplete="off">
                                                <h3 class="card-title"> General Information</h3>
                                                <div class="row flex-column">
                                                    <input type="hidden" name="has_employee" id="has_employee" value="0">

                                                    <div class="col-sm-8 introducer_id">

                                                        <div class="form-group">
                                                            <!--List of Employee for Selected Associate-->
                                                            <label for="introducer_id">Introduced by <span
                                                                    class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="introducer_id"name="introducer_id">
                                                                    <option value="" disabled selected>Select Introduced By</option>

                                                                    @empty($associates)
                                                                    <option value="0">Kinntegra Business Solution Private
                                                                        Limited</option>
                                                                    @else
                                                                        @foreach ($associates as $associate)
                                                                            <option value="{{$associate->id}}">{{ $associate->entity_name }}</option>
                                                                        @endforeach
                                                                    @endempty

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 employee_id">
                                                        <div class="form-group">
                                                            <!--List of Employee for Selected Associate-->
                                                            <label for="employee_id">Introducer-Employee Name <span
                                                                    class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="employee_id" name="employee_id">
                                                                    <option value="" disabled selected>Select Employee</option>
                                                                    <option value="1">Employee 1</option>
                                                                    <option value="2">Employee 2</option>
                                                                    <option value="3">Employee 3</option>
                                                                    <option value="4">Employee 4</option>
                                                                    <option value="5">Employee 5</option>
                                                                    <option value="6">Employee 6</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 profession_id">
                                                        <div class="form-group">
                                                            <label for="profession_id">Profession <span
                                                                    class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="profession_id" name="profession_id">
                                                                    <option value="" disabled selected>Select Profession</option>
                                                                    @foreach ($professions as $profession)
                                                                        <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 business_tag">
                                                        <div class="form-group">
                                                            <label for="business_tag">Business Tag <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="business_tag" name="business_tag" readonly="true">
                                                                    <option value="" disabled selected>Select Business Tag
                                                                    </option>
                                                                    <option value="self">Self</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="entity-detail" data-step="2" autocomplete="off">

                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Entity Details
                                                </h3>
                                                <div class="row flex-column">
                                                    <div class="col-sm-8 entitytype_id">
                                                        <div class="form-group">
                                                            <label for="entitytype_id">Entity Type <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="entitytype_id" name="entitytype_id">
                                                                    <option value="" disabled selected>Select Entity Type</option>
                                                                    @foreach ($entitytypes as $entitytype)
                                                                    <option value="{{ $entitytype->id }}">{{ $entitytype->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 entity_name">
                                                        <div class="form-group">
                                                            <label for="entity_name">Entity Name (As per Pancard) <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="entity_name"
                                                                aria-describedby="entity_name" name="entity_name">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 authorised_person1">
                                                        <div class="form-group">
                                                            <label for="authorised_person1">Authorised Person 1 <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="authorised_person1"
                                                                aria-describedby="authorised_person1" name="authorised_person1">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 authorised_email1">
                                                        <div class="form-group">
                                                            <label for="authorised_email1">Email 1 <span
                                                                class="required-sign">*</span></label>
                                                            <input type="email" class="form-control" id="authorised_email1"
                                                                aria-describedby="authorised_email1" name="authorised_email1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 authorised_person2">
                                                        <div class="form-group">
                                                            <label for="authorised_person2">Authorised Person 2 <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="authorised_person2"
                                                                aria-describedby="authorised_person2" name="authorised_person2">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 authorised_email2">
                                                        <div class="form-group">
                                                            <label for="authorised_email2">Email 2 <span
                                                                class="required-sign">*</span></label>
                                                            <input type="email" class="form-control" id="authorised_email2"
                                                                aria-describedby="authorised_email2" name="authorised_email2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 authorised_person3">
                                                        <div class="form-group">
                                                            <label for="authorised_person3">Authorised Person 3</label>
                                                            <input type="text" class="form-control text-capitalize" id="authorised_person3"
                                                                aria-describedby="authorised_person3" name="authorised_person3">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group authorised_email3">
                                                            <label for="authorised_email3">Email 3</label>
                                                            <input type="email" class="form-control" id="authorised_email3"
                                                                aria-describedby="authorised_email3" name="authorised_email3">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="photo-detail" data-step="3" autocomplete="off">

                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Photo ID Details
                                                </h3>
                                                <div class="row">
                                                    <!-- For Individual Case :: Name, PANCARD NUMBER, AADHAR CARD NUMBER, Date of Birth field is require-->
                                                    <div class="col-sm-8 name">
                                                        <div class="form-group">
                                                            <label for="name">Name (As per Pancard) <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="name" name="name"
                                                                aria-describedby="name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 photo_upload">
                                                        <div class="form-group">
                                                            <label for="photo_upload">PHOTO <span
                                                                class="required-sign">*</span></label>
                                                            <label for="photo_upload" class="btn input-btn w-100">
                                                                <input id="photo_upload" type="file" name="photo_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 pan_no">
                                                        <div class="form-group">
                                                            <label for="pan_no">PANCARD NUMBER <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no"
                                                                aria-describedby="pan_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 pan_upload">
                                                        <div class="form-group">
                                                            <label for="pan_upload">PANCARD <span
                                                                class="required-sign">*</span></label>
                                                            <label for="pan_upload" class="btn input-btn w-100">
                                                                <input id="pan_upload" type="file" name="pan_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 aadhar_no">
                                                        <div class="form-group">
                                                            <label for="aadhar_no">AADHAR CARD NUMBER <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="aadhar_no"
                                                                name="aadhar_no" aria-describedby="aadhar_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 aadhar_upload">
                                                        <div class="form-group">
                                                            <label for="aadhar_upload">AADHAR CARD <span
                                                                class="required-sign">*</span></label>
                                                            <label for="aadhar_upload" class="btn input-btn w-100">
                                                                <input id="aadhar_upload" type="file" name="aadhar_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 birth_incorp_date">
                                                        <div class="form-group">
                                                            <label for="birth_incorp_date"><span id="birth_incorp_date">Date of
                                                                Birth</span> <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" name="birth_incorp_date" class="form-control"
                                                                id="birth_incorp_date" aria-describedby="birth_incorp_date">
                                                        </div>
                                                    </div>

                                                </div>
                                                <button  type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="address-detail" data-step="4" autocomplete="off">

                                                <!-- If Selected Individual on Entity Type, then Address 1, Address 2, Address 3, City, State, Country, Pincode,Mobile Number,Telephone No,Email Address Require -->
                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Address Details
                                                </h3>
                                                <div class="row">
                                                    <div class="col-sm-12 address1">
                                                        <div class="form-group ">
                                                            <label for="address1">Address 1 <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="address1"
                                                                aria-describedby="address1" name="address1">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 address2">
                                                        <div class="form-group ">
                                                            <label for="address2">Address 2 <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="address2"
                                                                aria-describedby="address2" name="address2">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 address3">
                                                        <div class="form-group">
                                                            <label for="address3">Address 3</label>
                                                            <input type="text" class="form-control text-capitalize" id="address3"
                                                                aria-describedby="address3" name="address3">
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6 city">
                                                        <div class="form-group">
                                                            <label for="city">City <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="city"
                                                                aria-describedby="city" name="city">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 state">
                                                        <div class="form-group">
                                                            <label for="state">State <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="state" name="state">
                                                                    <option value="" disabled selected>Select State</option>
                                                                    <option value="3345">Maharashtra</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 country">
                                                        <div class="form-group">
                                                            <label for="country">Country <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="country" name="country">
                                                                    <option value="" disabled selected>Select Country</option>
                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}" @if($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 pincode">
                                                        <div class="form-group">
                                                            <label for="pincode">Pincode <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="pincode" class="form-control"
                                                                aria-describedby="pincode" name="pincode">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 address_upload">
                                                        <div class="form-group">
                                                            <label for="address_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="address_upload" class="btn input-btn w-100">
                                                                <input id="address_upload" type="file" name="address_upload"/>
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                UPLOAD
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 mobile">
                                                        <div class="form-group">
                                                            <label for="mobile">Mobile Number <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="mobile"
                                                                aria-describedby="mobile" name="mobile">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 telephoneno">
                                                        <div class="form-group">
                                                            <label for="telephoneno">TELEPHONE NO</label>
                                                            <input type="text" class="form-control" id="telephoneno"
                                                                aria-describedby="telephoneno" name="telephoneno">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 email">
                                                        <div class="form-group">
                                                            <label for="email">EMAIL ADDRESS <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="email"
                                                                aria-describedby="email" name="email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="bank-detail" data-step="5" autocomplete="off">

                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Bank Details
                                                </h3>

                                                <div class="row">
                                                    <div class="col-sm-12 mdf_ria">
                                                        <h4 class="card-title">MFD Bank Details</h4>
                                                    </div>
                                                    <div class="col-sm-8 ifsc_no">
                                                        <div class="form-group">
                                                            <label for="ifsc_no">IFSC Number <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-uppercase" id="ifsc_no" name="ifsc_no"
                                                                aria-describedby="ifsc_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 cheque_upload">
                                                        <div class="form-group">
                                                            <label for="cheque_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="cheque_upload" class="btn input-btn w-100">
                                                                <input id="cheque_upload" type="file" name="cheque_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 bank_name">
                                                        <div class="form-group">
                                                            <label for="bank_name">Bank Name <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control  text-capitalize" id="bank_name"
                                                                name="bank_name" aria-describedby="bank_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 branch_name">
                                                        <div class="form-group">
                                                            <label for="branch_name">Branch <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="branch_name"
                                                                name="branch_name" aria-describedby="branch_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 micr">
                                                        <div class="form-group">
                                                            <label for="micr">MICR <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="micr" name="micr"
                                                                aria-describedby="micr" placeholder="Enter MICR">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 account_type">
                                                        <div class="form-group">
                                                            <label for="account_type">Account Type <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="account_type"
                                                                    name="account_type">
                                                                    <option value="" disabled selected>Select Account Type
                                                                    </option>
                                                                    <option value="Saving">Saving Account</option>
                                                                    <option value="Current">Current Account</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 account_no">
                                                        <div class="form-group">
                                                            <label for="account_no">Account Number <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="account_no"
                                                                aria-describedby="account_no" name="account_no">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="mfd_ria_bank">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title">RIA Bank Details</h4>
                                                    </div>
                                                    <div class="col-sm-8 mfd_ria_ifsc_no">
                                                        <div class="form-group">
                                                            <label for="mfd_ria_ifsc_no">IFSC Number <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-uppercase" id="mfd_ria_ifsc_no" name="mfd_ria_ifsc_no"
                                                                aria-describedby="mfd_ria_ifsc_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 mfd_ria_cheque_upload">
                                                        <div class="form-group">
                                                            <label for="mfd_ria_cheque_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="mfd_ria_cheque_upload" class="btn input-btn w-100">
                                                                <input id="mfd_ria_cheque_upload" type="file" name="mfd_ria_cheque_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 mfd_ria_bank_name">
                                                        <div class="form-group">
                                                            <label for="mfd_ria_bank_name">Bank Name <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="mfd_ria_bank_name"
                                                                name="mfd_ria_bank_name" aria-describedby="mfd_ria_bank_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 mfd_ria_branch_name">
                                                        <div class="form-group">
                                                            <label for="mfd_ria_branch_name">Branch <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="mfd_ria_branch_name"
                                                                name="mfd_ria_branch_name" aria-describedby="mfd_ria_branch_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 mfd_ria_micr">
                                                        <div class="form-group">
                                                            <label for="mfd_ria_micr">MICR <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="mfd_ria_micr" name="mfd_ria_micr"
                                                                aria-describedby="mfd_ria_micr" placeholder="Enter MICR">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 mfd_ria_account_type">
                                                        <div class="form-group">
                                                            <label for="mfd_ria_account_type">Account Type <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="mfd_ria_account_type"
                                                                    name="mfd_ria_account_type">
                                                                    <option value="" disabled selected>Select Account Type
                                                                    </option>
                                                                    <option value="Saving">Saving Account</option>
                                                                    <option value="Current">Current Account</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 mfd_ria_account_no">
                                                        <div class="form-group">
                                                            <label for="mfd_ria_account_no">Account Number <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="mfd_ria_account_no"
                                                                aria-describedby="mfd_ria_account_no" name="mfd_ria_account_no">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="other-detail" data-step="6" autocomplete="off">

                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Other Details
                                                </h3>
                                                <div class="row" id="gst_details">
                                                    <div class="col-sm-12">
                                                        <h4 class="form-group">
                                                            GST Details
                                                        </h4>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-group gst_no">
                                                            <label for="gst_no">GST Number</label>
                                                            <input type="text" class="form-control text-uppercase" id="gst_no" name="gst_no"
                                                                aria-describedby="gst_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group gst_upload">
                                                            <label for="gst_upload">PROOF</label>
                                                            <label for="gst_upload" class="btn input-btn w-100">
                                                                <input id="gst_upload" type="file" name="gst_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="form-group gst_validity">
                                                            <label for="gst_validity">VALIDITY (If ANY)</label>
                                                            <input type="text" class="form-control" id="gst_validity"
                                                                name="gst_validity" aria-describedby="gst_validity">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="shop_est_details">
                                                    <div class="col-sm-12">
                                                        <h4>SHOP & ESTABLISHMENT Details </h4>
                                                    </div>
                                                    <div class="col-sm-8 shop_est_no">
                                                        <div class="form-group">
                                                            <label for="shop_est_no">SHOP & ESTABLISHMENT CERTIFICATE NO <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="shop_est_no"
                                                                aria-describedby="shop_est_no" name="shop_est_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 shop_est_upload">
                                                        <div class="form-group">
                                                            <label for="shop_est_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="shop_est_upload" class="btn input-btn w-100">
                                                                <input id="shop_est_upload" type="file"
                                                                    name="shop_est_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 shop_est_validity">
                                                        <div class="form-group">
                                                            <label for="shop_est_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="shop_est_validity"
                                                                name="shop_est_validity" aria-describedby="gst_validity">
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
                                                        <div class="form-group">
                                                            <label for="pd_upload">PARTNERSHIP DEEP <span
                                                                class="required-sign">*</span></label>
                                                            <label for="pd_upload" class="btn input-btn w-100">
                                                                <input id="pd_upload" type="file" name="pd_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 pd_asl_upload">
                                                        <div class="form-group">
                                                            <label for="pd_asl_upload">AUTHORIZED SIGNATORY LIST <span
                                                                class="required-sign">*</span></label>
                                                            <label for="pd_asl_upload" class="btn input-btn w-100">
                                                                <input id="pd_asl_upload" type="file" name="pd_asl_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 pd_coi_upload">
                                                        <div class="form-group">
                                                            <label for="pd_coi_upload">CERTIFICATE OF INCORPORATION <span
                                                                class="required-sign">*</span></label>
                                                            <label for="pd_coi_upload" class="btn input-btn w-100">
                                                                <input id="pd_coi_upload" type="file" name="pd_coi_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
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
                                                        <div class="form-group">
                                                            <label for="co_moa_upload">MEMORANDUM OF ASSOCIATION <span
                                                                class="required-sign">*</span></label>
                                                            <label for="co_moa_upload" class="btn input-btn w-100">
                                                                <input id="co_moa_upload" type="file" name="co_moa_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 co_aoa_upload">
                                                        <div class="form-group">
                                                            <label for="co_aoa_upload">ARTICLE OF ASSOCIATION <span
                                                                class="required-sign">*</span></label>
                                                            <label for="co_aoa_upload" class="btn input-btn w-100">
                                                                <input id="co_aoa_upload" type="file" name="co_aoa_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 co_coi_upload">
                                                        <div class="form-group">
                                                            <label for="co_coi_upload">CERTIFICATE OF INCORPORATION <span
                                                                class="required-sign">*</span></label>
                                                            <label for="co_coi_upload" class="btn input-btn w-100">
                                                                <input id="co_coi_upload" type="file" name="co_coi_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 co_asl_upload">
                                                        <div class="form-group">
                                                            <label for="co_asl_upload">AUTHORIZED SIGNATORY LIST <span
                                                                class="required-sign">*</span></label>
                                                            <label for="co_asl_upload" class="btn input-btn w-100">
                                                                <input id="co_asl_upload" type="file" name="co_asl_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 co_br_upload">
                                                        <div class="form-group">
                                                            <label for="co_br_upload">BOARD RESOLUTION <span
                                                                class="required-sign">*</span></label>
                                                            <label for="co_br_upload" class="btn input-btn w-100">
                                                                <input id="co_br_upload" type="file" name="co_br_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
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
                                                            <input type="text" class="form-control" name="primary_color"
                                                                id="primary_color" aria-describedby="primary_color"
                                                                placeholder="Primary Color">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 logo_upload">
                                                        <div class="form-group">
                                                            <label for="logo_upload">Upload Logo</label>
                                                            <label for="logo_upload" class="btn input-btn w-100">
                                                                <input id="logo_upload" type="file" name="logo_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 secondary_color">
                                                        <div class="form-group">
                                                            <label for="secondary_color">Secondary Color</label>
                                                            <input type="text" class="form-control" name="secondary_color"
                                                                id="secondary_color" aria-describedby="secondary_color"
                                                                placeholder="Secondary Color">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="license-detail" data-step="7" autocomplete="off">

                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> License Details
                                                </h3>
                                                <!-- Section Start for ARN -->
                                                <!-- If "PROFESSION" Selected :: MFD -->
                                                <div class="row" id="arn_details">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title">AMFI Details</h4>
                                                    </div>
                                                    <div class="col-sm-8 arn_name">
                                                        <div class="form-group">
                                                            <label for="arn_name">NAME AS PER ARN <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="arn_name" class="form-control text-capitalize"
                                                                name="arn_name" aria-describedby="arn_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 arn_upload">
                                                        <div class="form-group">
                                                            <label for="arn_upload">ARN REGISTRATION <span
                                                                class="required-sign">*</span></label>
                                                            <label for="arn_upload" class="btn input-btn w-100">
                                                                <input id="arn_upload" type="file" name="arn_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                UPLOAD
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 arn_rgn_no">
                                                        <div class="form-group">
                                                            <label for="arn_rgn_no">ARN REGISTRATION NUMBER <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="arn_rgn_no" class="form-control"
                                                                name="arn_rgn_no" aria-describedby="arn_rgn_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 arn_validity">
                                                        <div class="form-group">
                                                            <label for="arn_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="arn_validity" class="form-control"
                                                                name="arn_validity" aria-describedby="arn_validity">

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
                                                            <label for="euin_name">Name of EUIN Holder <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="euin_name"
                                                                name="euin_name" aria-describedby="euin_name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 euin_upload">
                                                        <div class="form-group">
                                                            <label for="euin_upload">EUIN Details <span
                                                                class="required-sign">*</span></label>
                                                            <label for="euin_upload" class="btn input-btn w-100">
                                                                <input id="euin_upload" type="file" name="euin_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 euin_no">
                                                        <div class="form-group">
                                                            <label for="euin_no">EUIN Number <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="euin_no" class="form-control" name="euin_no"
                                                                aria-describedby="euin_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 euin_validity">
                                                        <div class="form-group">
                                                            <label for="euin_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="euin_validity" class="form-control"
                                                                name="euin_validity" aria-describedby="euin_validity">

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
                                                            <label for="ria_name">NAME AS PER RIA <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="ria_name" name="ria_name"
                                                                class="form-control text-capitalize">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 ria_upload">
                                                        <div class="form-group">
                                                            <label for="ria_upload">RIA CERTIFICATE <span
                                                                class="required-sign">*</span></label>
                                                            <label for="ria_upload" class="btn input-btn w-100">
                                                                <input id="ria_upload" type="file" name="ria_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                UPLOAD
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ria_rgn_no">
                                                        <div class="form-group">
                                                            <label for="ria_rgn_no">SEBI REGISTRATION NUMBER <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="ria_rgn_no" class="form-control"
                                                                name="ria_rgn_no" aria-describedby="ria_rgn_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ria_validity">
                                                        <div class="form-group">
                                                            <label for="ria_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="ria_validity" class="form-control"
                                                                name="ria_validity" aria-describedby="ria_validity">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END -->
                                                <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="euin-detail" data-step="8" autocomplete="off">

                                                <!-- NISM VA CERTIFICATE  -->
                                                <!-- If "PROFESSION" Selected :: MFD -->
                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Certification
                                                </h3>

                                                <div class="row" id="nism_va_details">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title">NISM VA CERTIFICATE</h4>
                                                    </div>
                                                    <div class="col-sm-8 nism_va_no">
                                                        <div class="form-group">
                                                            <label for="nism_va_no">NISM VA CERTIFICATE NUMBER <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="nism_va_no" class="form-control"
                                                                name="nism_va_no" aria-describedby="nism_va_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 nism_va_upload">
                                                        <div class="form-group">
                                                            <label for="nism_va_upload">NISM VA CERTIFICATE <span
                                                                class="required-sign">*</span></label>
                                                            <label for="nism_va_upload" class="btn input-btn w-100">
                                                                <input id="nism_va_upload" type="file" name="nism_va_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 nism_va_validity">
                                                        <div class="form-group">
                                                            <label for="nism_va_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="nism_va_validity" class="form-control"
                                                                name="nism_va_validity" aria-describedby="nism_va_validity">

                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- End -->

                                                <!-- If "PROFESSION" Selected :: RIA -->
                                                <div class="row flex-column" id="ria_type">
                                                    <div class="col-sm-8 ria_certificate_type">
                                                        <div class="form-group">
                                                            <label for="ria_certificate_type">Certification Type <span
                                                                class="required-sign">*</span></label>
                                                            <div class="dropdown customMulti">
                                                                <a class="dropdown-toggle select-dropdown"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <span class="text-grey">Select Year</span>
                                                                </a>
                                                                <div id="ria_certificate_type" class="dropdown-menu dropdown-menu-left select-dropdown-list">
                                                                    {{-- <div class="data-list view-item">
                                                                        <div class="dropdown-item">
                                                                            <span class="d-block">NISM</span>
                                                                            <span class="d-block">NISM</span>
                                                                            <span class="d-block">NISM</span>
                                                                        </div>
                                                                        <div class="dropdown-divider"></div>
                                                                    </div> --}}
                                                                    <input type="hidden" name="ria_type_nism" value="0">
                                                                    <input type="hidden" name="ria_type_cfp" value="0">
                                                                    <input type="hidden" name="ria_type_cwm" value="0">
                                                                    <div class="data-list">
                                                                        <a class="dropdown-item">
                                                                            <div class="form-group custom-checkbox m-0">
                                                                                <input type="checkbox" name="ria_certificate_type[]" id="nism" value="nism">
                                                                                <label for="nism">NISM</label>
                                                                            </div>
                                                                        </a>
                                                                        <a class="dropdown-item">
                                                                            <div class="form-group custom-checkbox m-0">
                                                                                <input type="checkbox" name="ria_certificate_type[]" id="cfp" value="cfp">
                                                                                <label for="cfp">CFP</label>
                                                                            </div>
                                                                        </a>
                                                                        <a class="dropdown-item">
                                                                            <div class="form-group custom-checkbox m-0">
                                                                                <input type="checkbox" name="ria_certificate_type[]" id="cwm" value="cwm">
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
                                                            <input type="text" id="nism_xa_no" class="form-control"
                                                                name="nism_xa_no" aria-describedby="nism_xa_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 nism_xa_upload">
                                                        <div class="form-group">
                                                            <label for="nism_xa_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="nism_xa_upload" class="btn input-btn w-100">
                                                                <input id="nism_xa_upload" type="file" name="nism_xa_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 nism_xa_validity">
                                                        <div class="form-group">
                                                            <label for="nism_xa_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="nism_xa_validity" class="form-control"
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
                                                            <input type="text" id="nism_xb_no" class="form-control"
                                                                name="nism_xb_no" aria-describedby="nism_xb_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 nism_xb_upload">
                                                        <div class="form-group">
                                                            <label for="nism_xb_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="nism_xb_upload" class="btn input-btn w-100">
                                                                <input id="nism_xb_upload" type="file" name="nism_xb_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 nism_xb_validity">
                                                        <div class="form-group">
                                                            <label for="nism_xb_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="nism_xb_validity" class="form-control"
                                                                name="nism_xb_validity" aria-describedby="nism_xb_validity">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- CFP CERTIFICATE  -->
                                                <div class="row" id="other_details">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title">Note</h4>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <h6>Kindly Make a note that your CERTIFICATE will be address as per Business TAG</h6>
                                                    </div>
                                                </div>
                                                <div class="row" id="cfp_details">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title">CFP CERTIFICATE</h4>
                                                    </div>
                                                    <div class="col-sm-8 cfp_no">
                                                        <div class="form-group">
                                                            <label for="cfp_no">CFP CERTIFICATE NUMBER <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="cfp_no" class="form-control" name="cfp_no"
                                                                aria-describedby="cfp_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 cfp_upload">
                                                        <div class="form-group">
                                                            <label for="cfp_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="cfp_upload" class="btn input-btn w-100">
                                                                <input id="cfp_upload" type="file" name="cfp_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 cfp_validity">
                                                        <div class="form-group">
                                                            <label for="cfp_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="cfp_validity" class="form-control"
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
                                                            <input type="text" id="cwm_no" class="form-control" name="cwm_no"
                                                                aria-describedby="cwm_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 cwm_upload">
                                                        <div class="form-group">
                                                            <label for="cwm_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="cwm_upload" class="btn input-btn w-100">
                                                                <input id="cwm_upload" type="file" name="cwm_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 cwm_validity">
                                                        <div class="form-group">
                                                            <label for="cwm_validity">VALIDITY <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="cwm_validity" class="form-control"
                                                                name="cwm_validity" aria-describedby="cwm_validity">

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
                                                            <input type="text" id="ca_no" class="form-control" name="ca_no"
                                                                aria-describedby="ca_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 ca_upload">
                                                        <div class="form-group">
                                                            <label for="ca_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="ca_upload" class="btn input-btn w-100">
                                                                <input id="ca_upload" type="file" name="ca_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 ca_validity">
                                                        <div class="form-group">
                                                            <label for="ca_validity">VALIDITY (IF ANY)</label>
                                                            <input type="text" id="ca_validity" class="form-control"
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
                                                            <input type="text" id="cs_no" class="form-control" name="cs_no"
                                                                aria-describedby="cs_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 cs_upload">
                                                        <div class="form-group">
                                                            <label for="cs_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="cs_upload" class="btn input-btn w-100">
                                                                <input id="cs_upload" type="file" name="cs_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 cs_validity">
                                                        <div class="form-group">
                                                            <label for="cs_validity">VALIDITY  (IF ANY)</label>
                                                            <input type="text" id="cs_validity" class="form-control"
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
                                                            <input type="text" id="course_name" class="form-control"
                                                                name="course_name" aria-describedby="course_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 course_upload">
                                                        <div class="form-group">
                                                            <label for="course_upload">PROOF <span
                                                                class="required-sign">*</span></label>
                                                            <label for="course_upload" class="btn input-btn w-100">
                                                                <input id="course_upload" type="file" name="course_upload" />
                                                                <svg width="24" height="24" viewBox="0 0 24 24">
                                                                    <use xlink:href="#upload" />
                                                                </svg>
                                                                Upload
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 course_no">
                                                        <div class="form-group">
                                                            <label for="course_no">COURSE CERTIFICATE NO <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="course_no" class="form-control"
                                                                name="course_no" aria-describedby="course_no">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-8 course_validity">
                                                        <div class="form-group">
                                                            <label for="course_validity">VALIDITY (IF ANY)</label>
                                                            <input type="text" id="course_validity" class="form-control"
                                                                name="course_validity" aria-describedby="course_validity">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                                <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="nominee-detail" data-step="9" autocomplete="off">
                                                <input type="hidden" name="is_minor" value="0">
                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Nominee</h3>
                                                <div class="row">
                                                    <div class="col-sm-6 nominee_name">
                                                        <div class="form-group">
                                                            <label for="nominee_name">Nominee Name <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="nominee_name" class="form-control text-capitalize"
                                                                name="nominee_name" aria-describedby="nominee_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_birth_date">
                                                        <div class="form-group">
                                                            <label for="nominee_birth_date">Date of Birth (If Minor)</label>
                                                            <input type="text" id="nominee_birth_date" class="form-control"
                                                                name="nominee_birth_date" aria-describedby="nominee_birth_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group custom-checkbox">
                                                            <input type="checkbox" id="is_primary_address" name="is_primary_address" value="0">
                                                            <label for="is_primary_address">Address same as per Primary
                                                                Holder</label>
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
                                                            <label for="nominee_address1">Address 1 <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="nominee_address1"
                                                                aria-describedby="nominee_address1" name="nominee_address1">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_address2">
                                                        <div class="form-group">
                                                            <label for="nominee_address2">Address 2</label>
                                                            <input type="text" class="form-control text-capitalize" id="nominee_address2"
                                                                aria-describedby="nominee_address2" name="nominee_address2">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_address3">
                                                        <div class="form-group">
                                                            <label for="nominee_address3">Address 3</label>
                                                            <input type="text" class="form-control text-capitalize" id="nominee_address3"
                                                                aria-describedby="nominee_address3" name="nominee_address3">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_city">
                                                        <div class="form-group">
                                                            <label for="nominee_city">City <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="nominee_city"
                                                                aria-describedby="nominee_city" name="nominee_city">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_state">
                                                        <div class="form-group">
                                                            <label for="nominee_state">State <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="nominee_state"
                                                                    name="nominee_state">
                                                                    <option value="" disabled selected>Select State</option>
                                                                    <option>Maharashtra</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_country">
                                                        <div class="form-group">
                                                            <label for="nominee_country">Country <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="nominee_country"
                                                                    name="nominee_country">
                                                                    <option value="" disabled selected>Select Country</option>
                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}" @if($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_pincode">
                                                        <div class="form-group">
                                                            <label for="nominee_pincode">Pincode <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="nominee_pincode" class="form-control"
                                                                aria-describedby="nominee_pincode" name="nominee_pincode">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_mobile">
                                                        <div class="form-group">
                                                            <label for="nominee_mobile">Mobile Number</label>
                                                            <input type="text" class="form-control" id="nominee_mobile"
                                                                aria-describedby="nominee_mobile" name="nominee_mobile">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_telephone">
                                                        <div class="form-group">
                                                            <label for="nominee_telephone">TELEPHONE NO</label>
                                                            <input type="text" class="form-control" id="nominee_telephone"
                                                                aria-describedby="nominee_telephone" name="nominee_telephone">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 nominee_email">
                                                        <div class="form-group">
                                                            <label for="nominee_email">EMAIL ADDRESS</label>
                                                            <input type="text" class="form-control" id="nominee_email"
                                                                aria-describedby="nominee_email" name="nominee_email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-lg">Proceed</button>
                                            </section>
                                            <section class="trial" id="guardian-detail" data-step="10" autocomplete="off">

                                                <h3 class="card-title"><i class="icon-left-arrow back-btn"></i> Guardian Details
                                                </h3>
                                                <div class="row">
                                                    <div class="col-sm-8 guardian_name">
                                                        <div class="form-group">
                                                            <label for="guardian_name">Guardian Name <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="guardian_name" class="form-control text-capitalize"
                                                                name="guardian_name" aria-describedby="guardian_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-sm-8 guardian_pan_no">
                                                                <div class="form-group">
                                                                    <label for="guardian_pan_no">PAN Number <span
                                                                        class="required-sign">*</span></label>
                                                                    <input type="text" class="form-control text-uppercase" id="guardian_pan_no"
                                                                        name="guardian_pan_no"
                                                                        aria-describedby="guardian_pan_no">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 guardian_pan_upload">
                                                                <div class="form-group">
                                                                    <label for="guardian_pan_upload">Upload PAN <span
                                                                        class="required-sign">*</span></label>
                                                                    <label for="guardian_pan_upload"
                                                                        class="btn input-btn w-100">
                                                                        <input id="guardian_pan_upload" type="file"
                                                                            name="guardian_pan_upload" />
                                                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                                                            <use xlink:href="#upload" />
                                                                        </svg>
                                                                        Upload
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-8 guardian_nominee_relation">
                                                                <div class="form-group">
                                                                    <label for="guardian_nominee_relation">Relation With Nominee <span
                                                                            class="required-sign">*</span></label>
                                                                    <div class="select-wrapper">
                                                                        <select class="form-control" id="guardian_nominee_relation" name="guardian_nominee_relation">
                                                                            <option value="" disabled selected>Select Profession</option>
                                                                            @foreach ($relations as $relation)
                                                                                <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-sm-6 guardian_address1">
                                                        <div class="form-group">
                                                            <label for="guardian_address1">Address 1 <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="guardian_address1"
                                                                aria-describedby="guardian_address1" name="guardian_address1">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_address2">
                                                        <div class="form-group">
                                                            <label for="guardian_address2">Address 2</label>
                                                            <input type="text" class="form-control text-capitalize" id="guardian_address2"
                                                                aria-describedby="guardian_address2" name="guardian_address2">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_address3">
                                                        <div class="form-group">
                                                            <label for="guardian_address3">Address 3</label>
                                                            <input type="text" class="form-control text-capitalize" id="guardian_address3"
                                                                aria-describedby="guardian_address3" name="guardian_address3">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_city">
                                                        <div class="form-group">
                                                            <label for="guardian_city">City <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control text-capitalize" id="guardian_city"
                                                                aria-describedby="guardian_city" name="guardian_city">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_state">
                                                        <div class="form-group">
                                                            <label for="guardian_state">State <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="guardian_state"
                                                                    name="guardian_state">
                                                                    <option value="" disabled selected>Select State</option>
                                                                    <option>Maharashtra</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_country">
                                                        <div class="form-group">
                                                            <label for="guardian_country">Country <span
                                                                class="required-sign">*</span></label>
                                                            <div class="select-wrapper">
                                                                <select class="form-control" id="guardian_country"
                                                                    name="guardian_country">
                                                                    <option value="" disabled selected>Select Country</option>
                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}" @if($country->id == 98) {{'selected'}} @endif>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_pincode">
                                                        <div class="form-group">
                                                            <label for="guardian_pincode">Pincode <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" id="guardian_pincode" class="form-control"
                                                                aria-describedby="guardian_pincode" name="guardian_pincode">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_mobile">
                                                        <div class="form-group">
                                                            <label for="guardian_mobile">Mobile Number <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="guardian_mobile"
                                                                aria-describedby="guardian_mobile" name="guardian_mobile">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_telephone">
                                                        <div class="form-group">
                                                            <label for="guardian_telephone">TELEPHONE NO</label>
                                                            <input type="text" class="form-control" id="guardian_telephone"
                                                                aria-describedby="guardian_telephone" name="guardian_telephone">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 guardian_email">
                                                        <div class="form-group">
                                                            <label for="guardian_email">EMAIL ADDRESS <span
                                                                class="required-sign">*</span></label>
                                                            <input type="text" class="form-control" id="guardian_email"
                                                                aria-describedby="guardian_email" name="guardian_email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-lg">Confirm</button>
                                            </section>
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
                                                                    <div class="{{ $commercial->field_name }}_{{$commercialtype->field_name}}">
                                                                        <div>
                                                                            <input type="number" name="{{ $commercial->field_name }}_{{$commercialtype->field_name}}" class="form-control share_in"
                                                                            id="{{ $commercial->field_name }}_{{$commercialtype->field_name}}" class="form-control">
                                                                            <span>
                                                                                @if($commercialtype->field_name == 'perc')
                                                                                {{'%'}}
                                                                                @else
                                                                                {{$commercialtype->field_name}}
                                                                                @endif
                                                                            </span>

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

                                                <button type="button" class="btn btn-primary btn-lg">Confirm</button>
                                            </section>

                                        </div>
                                    </form>
                                    <div class="col-xl-4 col-lg-3 d-none d-lg-flex">
                                        <lottie-player src="/assets/images/data.json" background="transparent" speed="1"
                                            style="height: 300px;" loop autoplay></lottie-player>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>
            </div>
            <div class="menu-backdrop"></div>

            <script src="{{ asset('modules/jquery/dist/jquery.min.js') }}"></script>
            <!-- <script src="{{ asset('modules/bootstrap-daterangepicker/moment.min.js') }}"></script> -->
            <script src="{{ asset('modules/bootstrap/js/dist/util.js') }}"></script>
            <script src="{{ asset('modules/bootstrap/js/dist/collapse.js') }}"></script>
            <script src="{{ asset('modules/popper.js/dist/umd/popper.min.js') }}"></script>
            <script src="{{ asset('modules/bootstrap/js/dist/dropdown.js') }}"></script>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <script src="{{ asset('modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
            <script src="{{ asset('modules/select2/dist/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('modules/jquery-validation/dist/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
            <script src="{{ asset('assets/javascript/common.js') }}"></script>

            <script type="text/javascript" src="{{ asset('assets/javascript/colorpicker.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/javascript/associate.js') }}"></script>


        </body>

        </html>
        ript" src="{{ asset('assets/javascript/colorpicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/javascript/associate.js') }}"></script>


</body>

</html>
