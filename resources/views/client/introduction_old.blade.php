@extends('layouts.master')

@section('style')
<style>
    #family_detail,#company_detail {display: none;}
</style>
<style>
    .companys-tab .nav-item:last-child {
margin-right: 0;
}
.companys-tab .nav-item+.nav-item {
margin-left: 0;
}
.companys-tab .nav-item {
position: relative;
margin-right: 1.25rem;
}
    .companys-tab .nav-item .nav-link.add-company, .companys-tab .nav-item .nav-link.add-account, .income-tab .nav-item .nav-link.add-companys, .income-tab .nav-item .nav-link.add-account, .accounts-tab .nav-item .nav-link.add-company, .accounts-tab .nav-item .nav-link.add-account {
color: #545454;
padding-right: 1.25rem;
border: 1px dashed #545454;
background-color: transparent;
}
.companys-tab .nav-item .nav-link.active{
border: 1px solid var(--primary, #365b58);
background-color: var(--primary, #365b58);
color: #fff;
}
.companys-tab .nav-item .nav-link {
border: 1px solid var(--primary, #365b58);
border-radius: 20px;
text-transform: uppercase;
padding: 4px 1.25rem;
font-size: 0.875rem;
color: var(--primary, #365b58);
padding-right: 3rem;
}
.companys-tab .nav-item .remove-company {
position: absolute;
right: 1rem;
top: 50%;
transform: translateY(-50%);
font-weight: bold;
color: var(--primary, #365b58);
cursor: pointer;
font-size: 8px;
}
.companys-tab .nav-item .nav-link.add-company{
color: #545454;
padding-right: 1.25rem;
border: 1px dashed #545454;
background-color: transparent;
}
</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
        <a class="back-btn" href="#">
            <i class="icon-left-arrow"></i>
            Go Back
        </a>
        <div class="section-header ">

            <div class="dropdown text-right">
                <a class="dropdown-toggle profile-img" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="/assets/images/analytics.svg">
                    <span>Ashton Maxwell</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">View Profile</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </div>
            <button class="btn btn-icon outline-dark notification-bell">
                <span class="count">2</span>
                <svg width="30" height="30" viewBox="0 -1 17 25">
                    <use xlink:href="#notification" />
                </svg>
            </button>

        </div>
    </div>
    <div class="card w-100">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4">
                    @include('client.leftbar')
                </div>
                <form class="col-lg-8 col-xl-9 step-forms col-md-8">
                    <section id="introduction" autocomplete="off" class=" trial active">
                        <h3 class="card-title">Introduction</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="associate-name">Associate</label>
                                    <div class="select-wrapper">
                                        <select class="form-control" id="associate_name" name="associate_name">
                                            <option value="" disabled selected>Select Associate</option>
                                            <option>Associate 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="employee-name">Employee</label>
                                    <div class="select-wrapper">
                                        <select class="form-control" id="employee_name" name="employee_name">
                                            <option value="" disabled selected>Select Employee</option>
                                            <option>Employee 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 inline-form" id="accounttype">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    <label for="accounttype" style="margin-bottom: 13px;">Account Type</label>
                                    <div class="d-flex ">
                                        <div class="form-group custom-checkbox mb-0">
                                            <input type="checkbox" id="individual" name="accounttype[]" value="individual">
                                            <label for="individual">Individual</label>
                                        </div>
                                        <div class="form-group custom-checkbox mb-0">
                                            <input type="checkbox" id="nonindividual" name="accounttype[]" value="nonindividual">
                                            <label for="nonindividual">Non Individual</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" id="family_detail">
                                <hr>
                                <div class="form-sections mb-0">

                                    <h4 class="form-section-title text-uppercase">FAMILY Details - Shashikant Varma & Family</h4>
                                    <ul class="nav nav-tabs members-tab " id="lead-generation"
                                        role="tablist">
                                        <li class="nav-item add-member-item mb-4" role="presentation">
                                            <a class="nav-link active add-member" id="add-tab"
                                                data-toggle="tab" href="#add" role="tab"
                                                aria-selected="true">Add Member</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="family-tab">
                                        <div class="tab-pane fade show active" id="add" role="tabpanel"
                                            aria-labelledby="add-tab">
                                            <div class="addTab row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="Enter Name" name="name" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="birthdate">Date of Birth</label>
                                                        <input type="text" class="form-control"
                                                            id="birthdate" name="birthdate" placeholder="Enter Name" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 relation">
                                                    <div class="form-group">
                                                        <label for="relation">Relation</label>
                                                        <div class="select-wrapper">
                                                            <select class="form-control" id="relation" name="relation">
                                                                <option value="" disabled selected>Select
                                                                    Relation</option>
                                                                <option value="Brother">Brother</option>
                                                                <option value="Father">Father</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="tax-status">Tax Status</label>
                                                        <select class="form-control tax-slab" id="taxstatus" name="taxstatus">
                                                            <option value="" disabled selected>Select
                                                                Tax status</option>
                                                            <option value="50">50%
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="tax-slab">Tax Slab</label>
                                                        <select class="form-control tax-slab" id="taxslab" name="taxslab">
                                                            <option value="" disabled selected>Select
                                                                Tax Slab</option>
                                                            <option value="50">50%
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="expectancy">Life Expectancy</label>
                                                        <input type="text" class="form-control"
                                                            id="lifeexpectancy" name="lifeexpectancy"
                                                            placeholder="Enter Life Expectancy" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="company_detail">
                                <hr>
                                <div class="form-sections mb-0">
                                    <h4 class="form-section-title text-uppercase">Company Details</h4>
                                    <ul class="nav nav-tabs companys-tab " id="add_company"
                                        role="tablist">
                                        <li class="nav-item add-company-item mb-3" role="presentation">
                                            <a class="nav-link active add-company" id="addcompany-tab"
                                                data-toggle="tab" href="#addcompany" role="tab"
                                                aria-selected="true">Add Company</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="company-tab">
                                        <div class="tab-pane fade show active" id="addcompany" role="tabpanel" aria-labelledby="addcompany-tab">
                                            <div class="addCompanyTab row" style="margin-bottom: 10px;">
                                                <div class="col-sm-4 cname">
                                                    <div class="form-group">
                                                        <label for="cname">Company Name</label>
                                                        <input type="text" class="form-control" id="cname"
                                                            name="cname" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 cincorpdate">
                                                    <div class="form-group">
                                                        <label for="cincorpdate">Date of Incorporation</label>
                                                        <input type="text" name="cincorpdate" class="form-control"
                                                            id="cincorpdate" placeholder="Enter Name" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 ctaxstatus">
                                                    <div class="form-group">
                                                        <label for="ctaxstatus">Entity Type</label>
                                                        <div class="select-wrapper">
                                                            <select class="form-control" id="ctaxstatus" name="ctaxstatus">
                                                                <option value="" disabled selected>Select Entity Type</option>
                                                                <option value="huf">HUF</option>
                                                                <option value="trust">Trust</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 ctaxslab">
                                                    <div class="form-group">
                                                        <label for="ctaxslab">Tax Slab</label>
                                                        <select class="form-control ctaxslab" id="ctaxslab" name="ctaxslab">
                                                            <option value="" disabled selected>Select Tax Slab</option>
                                                            <option value="50">50%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h4 class="form-section-title text-uppercase">AUTHORIZED Personel Details</h4>
                                                </div>
                                                <div class="col-sm-4 cauthname1">
                                                    <div class="form-group">
                                                        <label for="cauthname1">AUTHORIZED SIGNITORY NAME - 1</label>
                                                        <input type="text" class="form-control" id="cauthname1" name="cauthname1"
                                                            />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 cauthdesignation1">
                                                    <div class="form-group">
                                                        <label for="cauthdesignation1">Designation</label>
                                                        <input type="text" class="form-control" id="cauthdesignation1" name="cauthdesignation1"
                                                            />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12"></div>
                                                <div class="col-sm-4 cauthname2">
                                                    <div class="form-group">
                                                        <label for="cauthname2">AUTHORIZED SIGNITORY NAME - 2</label>
                                                        <input type="text" class="form-control" id="cauthname2" name="cauthname2"
                                                            />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 cauthdesignation2">
                                                    <div class="form-group">
                                                        <label for="cauthdesignation2">Designation</label>
                                                        <input type="text" class="form-control" id="cauthdesignation2" name="cauthdesignation2"
                                                            />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <hr>
                                <div class="form-sections">
                                    <h4 class="form-section-title text-uppercase">Select Next Step</h4>
                                    <div class="row">
                                        <div class="col-sm-4 proceedto">
                                            <div class="form-group">
                                                <label for="proceedto">Proceed to</label>
                                                <div class="select-wrapper">
                                                    <select class="form-control" id="proceedto" name="proceedto">
                                                        <option value="" disabled selected>Proceed to
                                                        </option>
                                                        <option value="1">Comprehensive plan
                                                        </option>
                                                        <option value="2">Account Opening</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-lg proceed">Proceed</button>
                    </section>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('modal')

@endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascript/introduction.js') }}"></script>

@endsection
