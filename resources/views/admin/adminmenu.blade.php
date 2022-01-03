<div class="panel-option">
    <div class="my-3 d-flex justify-content-between align-items-center  border-bottom pb-2">
        <h3 class="">Admin Menu</h3>
        <a id="closeMenu"><i class="icon-close"></i></a>
    </div>


    <div class="accordion normal-accordion" id="accordionExample">
        <!--Model Portfolio-->
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        Model Portfolio <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li class="active">
                            <a href="{{ route('viewportfolio.index') }}">View Portfolio Logs</a>
                        </li>
                        <li>
                            <a href="{{ route('setportfolio.index') }}">Set Portfolio</a>
                        </li>
                        <li>
                            <a href="{{ route('viewschemelog.index') }}">Set Scheme Log</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Cost Inflation Indices-->
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                        Master BSE <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        {{-- <li>
                            <a href="#">Introduction</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('grossannualincome.index') }}">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="{{ route('wealthsource.index') }}">Wealth Source</a>
                        </li>
                        <li>
                            <a href="{{ route('addresstype.index') }}">Address Type</a>
                        </li>
                        <li>
                            <a href="{{ route('accounttype.index') }}">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="{{ route('incomecategory.index') }}">Other Income Category</a>
                        </li>
                        <li>
                            <a href="{{ route('taxstatus.index') }}">Tax Status</a>
                        </li>
                        <li>
                            <a href="{{ route('countries.index') }}">Country & State</a>
                        </li>
                        <li>
                            <a href="{{ route('occupation.index') }}">Occupations</a>
                        </li>
                        <li>
                            <a href="{{ route('department.index') }}">Department</a>
                        </li>
                        <li>
                            <a href="{{ route('designation.index') }}">Designation</a>
                        </li>
                        <li>
                            <a href="{{ route('kycstatus.index') }}">Kyc Status</a>
                        </li>
                        <li>
                            <a href="{{ route('taxslab.index') }}">Tax Slab</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--AMC-->
        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">
                        BSE Holidays <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">View</a>
                        </li>
                        <li>
                            <a href="#">Add</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Gross Annual Income-->
        <div class="card">
            <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                        aria-controls="collapseFour">
                        Master Uploads <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="{{ route('bank_upload.create') }}">Bank Master</a>
                        </li>
                        <li>
                            <a href="{{ route('scheme_upload.create') }}">Scheme Master</a>
                        </li>
                        <li>
                            <a href="{{ route('sipscheme_upload.create') }}">SIP Scheme Master</a>
                        </li>
                        <li>
                            <a href="{{ route('nav_upload.create') }}">NAV Master</a>
                        </li>
                        <li>
                            <a href="{{ route('amfiindia_upload.create') }}">AMFI INDIA Master</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                        aria-controls="collapseFive">
                        Master View <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="{{ route('bank_upload.index') }}">Bank Master</a>
                        </li>
                        <li>
                            <a href="{{ route('scheme_upload.index') }}">Scheme Master</a>
                        </li>
                        <li>
                            <a href="{{ route('sipscheme_upload.index') }}">SIP Scheme Master</a>
                        </li>
                        <li>
                            <a href="{{ route('nav_upload.index') }}">NAV Master</a>
                        </li>
                        <li>
                            <a href="{{ route('amfiindia_upload.index') }}">AMFI INDIA Master</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- <!--Wealth Source-->
        <div class="card">
            <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                        aria-controls="collapseFive">
                        Wealth Source <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Address type-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Address type <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Bank Account Type-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Bank Account Type <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Other Income Category-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Other Income Category <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Tax status-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Tax status <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Country-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Country <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Master Bank-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Master Bank <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--States-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        States <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Occupations-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Occupations <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--BSE Holidays-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        BSE Holidays <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Additional 1-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Additional 1 <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Additional 2-->
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                        data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                        Additional 2 <i class="icon-down-arrow"></i>
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="admin-list">
                        <li>
                            <a href="#">Introduction</a>
                        </li>
                        <li>
                            <a href="#">Income & Investment Returns</a>
                        </li>
                        <li>
                            <a href="#">Expense & Liabilities</a>
                        </li>
                        <li>
                            <a href="#">Goals</a>
                        </li>
                        <li>
                            <a href="#">Insurance</a>
                        </li>
                        <li>
                            <a href="#">Gross Annual Income</a>
                        </li>
                        <li>
                            <a href="#">Wealth Source</a>
                        </li>
                        <li>
                            <a href="#">Address Type</a>
                        </li>
                        <li>
                            <a href="#">Bank Account Type</a>
                        </li>
                        <li>
                            <a href="#">Tax Status</a>
                        </li>
                        <li>
                            <a href="#">Country</a>
                        </li>
                        <li>
                            <a href="#">Master Bank</a>
                        </li>
                        <li>
                            <a href="#">States</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>
</div>
