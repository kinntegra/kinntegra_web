<h3 class="card-title">Create New Client</h3>
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
    $skip = '';

    if($client->is_introduction == 1 && $client->is_comprehensive == 0 && $client->is_kyc_detail == 1)
    {
        $skip = 'skip';
    }
   // dd($skip);
@endphp
<ul class="form-lists">
    <li data-form="introduction" class="@if(route('introduction.show',$client->id) == Request::url()) {{ 'active' }} @endif @if($client->is_introduction == 1) {{ 'completed' }} @endif">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Introduction
    </li>
    <li data-form="comprehensive-plan" class="isParent @if(route('comprehensive.show',$client->id) == Request::url()) {{ 'active' }} @else {{$skip}} @endif @if($client->is_comprehensive == 1) {{ 'completed' }} @endif">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Comprehensive plan
        <ul>
            <li class="isChild" data-form="income-details">Income Details</li>
            <li class="isChild" data-form="goal-details">Goal Details</li>
            <li class="isChild" data-form="expense-details">Expense</li>
            <!-- <li class="isChild" data-form="lifestyle-expense">Lifestyle Expense</li>
            <li class="isChild" data-form="dependent">Dependent</li> -->
            <li class="isChild" data-form="insurance-details">Insurance Premium</li>
            <li class="isChild" data-form="liability-details">Liability</li>
            <li class="isChild" data-form="surplus-details">Surplus</li>
            <li class="isChild" data-form="allocation-details">Allocation</li>
            <li class="isChild" data-form="cash-flow-details">Cash Flow</li>
            <li class="isChild" data-form="recommendation-details">Recommendation</li>
        </ul>
    </li>

    <li data-form="kyc-information" class="isParent @if(route('kycdetail.show',$client->id) == Request::url()) {{ 'active' }} @elseif(route('kycinformation.show',$client->id) == Request::url()) {{ 'active' }} @endif @if($client->is_kyc_detail == 1) {{'completed'}} @endif">
        <div class="indicator">
            <div class="check"></div>
        </div>
        KYC Information

        @if(Request::url() == route('kycinformation.show',$client->id))
        @php $k = 1;@endphp
        @foreach ($profiles as $profile)

        <ul>
            <h6 class="sameLevel">{{$profile->name}}</h6>
            @php $pid = $profile->id; $step = 'step'.$k;@endphp
            <li class="isChild @if($$step == 'completed'){{'sub-completed sub-active'}} @endif" data-curr-pid = "{{$pid}}" data-curr-step-id="{{$k}}" data-form="profile_{{$pid}}">Profile</li>
            @php $k++; $step = 'step'.$k;@endphp
            <li class="isChild @if($$step == 'completed'){{'sub-completed sub-active'}} @endif" data-curr-pid = "{{$pid}}" data-curr-step-id="{{$k}}" data-form="communication_{{$pid}}">Communication</li>
            @php $k++;$step = 'step'.$k;@endphp
            <li class="isChild @if($$step == 'completed'){{'sub-completed sub-active'}} @endif" data-curr-pid = "{{$pid}}" data-curr-step-id="{{$k}}" data-form="bank-details_{{$pid}}">Bank Details</li>
            @php $k++;@endphp
        </ul>
        @endforeach
        @endif
    </li>
    @if($client->is_kyc_detail == 1)
    <li data-form="allocation_details" class="@if(route('assetallocation.show',$client->id) == Request::url()) {{ 'active' }} @endif @if($client->is_allocation == 1) {{ 'completed' }} @endif">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Asset Allocation
    </li>
    <li data-form="account_creation" class="@if(route('creation.show',$client->id) == Request::url()) {{ 'active' }} @endif @if($client->is_account_opened == 1) {{ 'completed' }} @endif">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Account Creation
    </li>
    @endif
    @php
        //dd($client);
    @endphp
    @if($client->is_account_opened == 1 && $client->is_mandate == 1) {{-- && $is_verify == 0 --}}
    <li data-form="mandate" class="@if(route('mandate.show',$client->id) == Request::url()) {{ 'active' }} @endif @if($client->is_mandate == 1) {{ 'completed' }} @endif">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Mandate
    </li>
    @endif

    @if($client->is_mandate == 1){{-- && $is_verify == 0 --}}
    <li data-form="download" class="@if(route('download.show',$client->id) == Request::url()) {{ 'active' }} @endif @if($client->is_download == 1) {{ 'completed' }} @endif">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Download
    </li>
    @endif
    @if($client->is_download == 1){{-- && $is_verify == 0 --}}
    <li data-form="upload" class="@if(route('upload.show',$client->id) == Request::url()) {{ 'active' }} @endif @if($client->is_upload == 1) {{ 'completed' }} @endif">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Upload
    </li>
    @endif
 {{--

    <li data-form="download" class="">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Download
    </li>
    <li data-form="upload" class="">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Upload
    </li>
    <li data-form="login Preference" class="isParent">
        <div class="indicator">
            <div class="check"></div>
        </div>
        Login Preference
        <ul>
            <li class="isChild" data-form="report-preference">Report Preference</li>
        </ul>
    </li> --}}

</ul>
