@extends('layouts.master')

@section('style')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" /> --}}

<style>
    .members-tab .nav-item .nav-link, .income-tab .nav-item .nav-link, .accounts-tab .nav-item .nav-link, .companys-tab .nav-item .nav-link{
        padding-right: 1rem;
    }
    .w-40 {
    width: 40% !important;
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

</style>
<style>

/* .slick-prev {
    left: -10px;
}
.slick-prev, .slick-next{
    top: 60%;
}
.slick-prev:before, .slick-next:before{
    color: #365b58;
}
 .items {
     width: 94%;
     margin: 0px auto;
 }

 .slick-slide {
     margin: 10px
 } */
</style>
@endsection

@section('content')
<div class="panel-wrapper">
    @include('admin.adminmenu')
    <div class="container-fluid">
        <div class="table-top-section">
            <div class="section-header mb-4">
                @include('partials.top')
            </div>
        </div>
        <h3 class="section-title mb-4 d-flex justify-content-between">View PortFolio

        </h3>
            <div class="card mb-4">

                <div class="card-body">

                    {{-- <div class="row mb-2 col-12" id="family_detail">
                        <div class="form-sections mb-0 col-12">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button">Previous</button>
                            <ul class="items nav nav-tabs members-tab" role="tablist">
                                @foreach ($scheme_dates as $date)
                                <li class="nav-item mb-3" role="presentation">
                                    <a class="nav-link member_tab"  data-toggle="tab" data-target-id="{{ $date->id }}"  role="tab" aria-selected="false">{{ $date->wef_date }}</a>
                                </li>
                                @endforeach

                            </ul>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none">Next</button>
                        </div>

                    </div> --}}
                    @php
                        $equity = '';
                        $debt = '';
                        $shortterm = '';
                        $tax = '';
                        $gold = '';
                        $selected_date = '';
                        foreach ($scheme_view as $view) {

                            if($view->main_category == 'Equity'){$equity = $view;$selected_date = Carbon\Carbon::parse($view->wef_date)->format('d-m-Y'); }
                            if($view->main_category == 'Debt'){$debt = $view;}
                            if($view->main_category == 'Shortterm'){$shortterm = $view;}
                            if($view->main_category == 'Tax'){$tax = $view;}
                            if($view->main_category == 'Gold'){$gold = $view;}
                        }

                    @endphp
                    <div class="row flex-row-reverse">

                        <div class="col-lg-12">
                            <div class="admin-body">
                                <div class="row">
                                <div class="col-xl-7 mb-3 mb-xl-0">
                                    <ul class="nav nav-tabs mb-4" id="lead-generation" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link add-equity active" data-toggle="tab" data-type="equity" href="#admin-equity"
                                                role="tab" aria-selected="true">Wealth-Equity</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link add-debt" data-toggle="tab" data-type="debt" href="#admin-debt"
                                                role="tab" aria-selected="true">Wealth-Debt</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link add-shortterm" data-toggle="tab" data-type="shortterm" href="#admin-shortterm"
                                                role="tab" aria-selected="true">Short Term</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link add-tax" data-toggle="tab" data-type="tax" href="#admin-tax"
                                                role="tab" aria-selected="true">Tax</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link add-gold" data-toggle="tab" data-type="gold" href="#admin-gold"
                                                role="tab" aria-selected="true">Gold</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-5 pl-xl-0">
                                    <div class="table-options float-right">
                                        <form action="{{ route('viewportfolio.index') }}" method="get">
                                        <select class="form-control selected_date w-100" id="selected_date" data-type="date" name="selected_date">
                                            <option value="" selected disabled>-- Select Date --</option>

                                            @foreach ($scheme_dates as $date)
                                                @php
                                                    $curr_date = Carbon\Carbon::parse($date->wef_date)->format('d-m-Y');
                                                @endphp
                                                <option value="{{ $curr_date }}" @if($curr_date == $selected_date){{ 'selected' }} @endif>{{ $curr_date }}</option>
                                            @endforeach
                                        </select>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                <div class="tab-content" id="leadsContent">
                                    <div class="tab-pane fade show active" id="admin-equity" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex justify-content-between">Equity</h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="45%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="25%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>
                                                                <th width="30%" colspan="3">SWP</th>
                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="10%">Residence %</th>
                                                                <th width="10%" class="border-right">NRI %</th>
                                                                <th width="10%">Priority</th>
                                                                <th width="10%">Residence %</th>
                                                                <th width="10%">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($equity->allocations as $allocation)
                                                            <tr>
                                                                <td data-title="Scheme Name">
                                                                    {{ $allocation->master_scheme_name }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth Residence">
                                                                    {{ $allocation->allocation_ratio }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth NRI">
                                                                    {{ $allocation->allocation_ratio_nri }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular SWP Priority">
                                                                    @if($allocation->swp_priority == 1)
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
                                                                </td>
                                                                <td class="text-center" data-title="Regular SWP Residence">
                                                                    {{ $allocation->swp_allocation_ratio }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular SWP NRI">
                                                                    {{ $allocation->swp_allocation_ratio_nri }}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        {{-- <tfoot>
                                                            <tr class="default_scheme_equity_total">
                                                                <td data-title="Total" class="text-center bold">
                                                                    <h5>Total</h5>
                                                                </td>

                                                                <td data-title="Amc Code Equity Regular Residence Total">
                                                                    <input type="text" class="form-control schemecode_regular_residence_total" id="scheme_code_equity_regular_residence_total" data-type="equity_residence_total" name="scheme_code_equity_regular_residence_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Scheme Code Equity Regular NRI Total">
                                                                    <input type="text" class="form-control schemecode_regular_nri_total" id="scheme_code_equity_regular_nri_total" data-type="equity_nri_total" name="scheme_code_equity_regular_nri_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Amc Code Equity SWP Residence Total">
                                                                    <input type="text" class="form-control amccode_swp_residence_total" data-type="equity_residence_total" id="amc_code_equity_swp_residence_total" name="amc_code_equity_swp_residence_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Scheme Code Equity SWP NRI Total">
                                                                    <input type="text" class="form-control schemecode_swp_nri_total" id="scheme_code_equity_swp_nri_total" data-type="equity_nri_total" name="scheme_code_equity_swp_nri_total" value="0" readonly>
                                                                </td>
                                                            </tr>
                                                        </tfoot> --}}
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_equity" name="rational_trade_equity" placeholder="Add Rational for trade" readonly>{!! $equity->rational !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="admin-debt" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex justify-content-between">Debt</h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="45%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="25%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>
                                                                <th width="30%" colspan="3">SWP</th>
                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="10%">Residence %</th>
                                                                <th width="10%" class="border-right">NRI %</th>
                                                                <th width="10%">Priority</th>
                                                                <th width="10%">Residence %</th>
                                                                <th width="10%">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($debt->allocations as $allocation)
                                                            <tr>
                                                                <td data-title="Scheme Name">
                                                                    {{ $allocation->master_scheme_name }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth Residence">
                                                                    {{ $allocation->allocation_ratio }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth NRI">
                                                                    {{ $allocation->allocation_ratio_nri }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular SWP Priority">
                                                                    @if($allocation->swp_priority == 1)
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
                                                                </td>
                                                                <td class="text-center" data-title="Regular SWP Residence">
                                                                    {{ $allocation->swp_allocation_ratio }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular SWP NRI">
                                                                    {{ $allocation->swp_allocation_ratio_nri }}
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        {{-- <tfoot>
                                                            <tr class="default_scheme_debt_total">
                                                                <td data-title="Total" class="text-center bold">
                                                                    <h5>Total</h5>
                                                                </td>

                                                                <td data-title="Amc Code Debt Regular Residence Total">
                                                                    <input type="text" class="form-control schemecode_regular_residence_total" id="scheme_code_debt_regular_residence_total" data-type="debt_residence_total" name="scheme_code_debt_regular_residence_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Scheme Code Debt Regular NRI Total">
                                                                    <input type="text" class="form-control schemecode_regular_nri_total" id="scheme_code_debt_regular_nri_total" data-type="debt_nri_total" name="scheme_code_debt_regular_nri_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Amc Code Debt SWP Residence Total">
                                                                    <input type="text" class="form-control amccode_swp_residence_total" data-type="debt_residence_total" id="amc_code_debt_swp_residence_total" name="amc_code_debt_swp_residence_total" value="0" readonly>
                                                                </td>
                                                                <td data-title="Scheme Code Debt SWP NRI Total">
                                                                    <input type="text" class="form-control schemecode_swp_nri_total" id="scheme_code_debt_swp_nri_total" data-type="debt_nri_total" name="scheme_code_debt_swp_nri_total" value="0" readonly>
                                                                </td>
                                                            </tr>
                                                        </tfoot> --}}
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_debt" name="rational_trade_debt" placeholder="Add Rational for trade" readonly>{!! $debt->rational !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="admin-shortterm" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex flex-row-reverse">

                                            <button type="button" class="btn btn-link" id="add_new_data_shortterm" style="padding: 0px">Add New</button>
                                        </h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="50%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="50%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>

                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="25%">Residence %</th>
                                                                <th width="25%" class="border-right">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($shortterm->allocations as $allocation)
                                                            <tr>
                                                                <td data-title="Scheme Name">
                                                                    {{ $allocation->master_scheme_name }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth Residence">
                                                                    @if($allocation->allocation_ratio == 1)
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth NRI">
                                                                    @if($allocation->allocation_ratio_nri == 1)
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_shortterm" name="rational_trade_shortterm" placeholder="Add Rational for trade" readonly>{!! $shortterm->rational !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="admin-tax" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex justify-content-between">Tax
                                            <button type="button" class="btn btn-link" id="add_new_data_tax" style="padding: 0px">Add New</button>
                                        </h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="50%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="50%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>

                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="25%">Residence %</th>
                                                                <th width="25%" class="border-right">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($tax->allocations as $allocation)
                                                            <tr>
                                                                <td data-title="Scheme Name">
                                                                    {{ $allocation->master_scheme_name }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth Residence">
                                                                    @if($allocation->allocation_ratio == 1)
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth NRI">
                                                                    @if($allocation->allocation_ratio_nri == 1)
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_tax" name="rational_trade_tax" placeholder="Add Rational for trade" readonly>{!! $tax->rational !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show" id="admin-gold" role="tabpanel">
                                        {{-- <h5 class="card-title mb-4 d-flex justify-content-between">Short Term
                                            <button type="button" class="btn btn-link" id="add_new_data_gold" style="padding: 0px">Add New</button>
                                        </h5> --}}
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table normal-table">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th width="50%" rowspan="2" class="align-middle border-right">Scheme Name</th>
                                                                <th width="50%" colspan="2" class="border-right">Regular(Wealth & SIP)</th>

                                                            </tr>
                                                            <tr class="text-center">

                                                                <th width="25%">Residence %</th>
                                                                <th width="25%" class="border-right">NRI %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($gold->allocations as $allocation)
                                                            <tr>
                                                                <td data-title="Scheme Name">
                                                                    {{ $allocation->master_scheme_name }}
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth Residence">
                                                                    @if($allocation->allocation_ratio == 1)
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
                                                                </td>
                                                                <td class="text-center" data-title="Regular Wealth NRI">
                                                                    @if($allocation->allocation_ratio_nri == 1)
                                                                        Yes
                                                                    @else
                                                                        No
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card small-card option-2 mb-4">
                                            <div class="card-header">
                                                <h6 class="card-title">RATIONAL FOR TRADE</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" id="rational_trade_gold" name="rational_trade_gold" placeholder="Add Rational for trade" readonly>{!! $gold->rational !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div> --}}

        </div>
    </div>
</div>

@endsection

@section('modal')

@endsection

@section('script')

<script type="text/javascript" src="{{ asset('assets/javascript/setportfolio.js') }}"></script>
<script>
    $(document).ready(function () {
        // $.fn.isHScrollable = function () {
        //     return this[0].scrollWidth > this[0].clientWidth;
        // };

        // $.fn.isVScrollable = function () {
        //     return this[0].scrollHeight > this[0].clientHeight;
        // };

        // $.fn.isScrollable = function () {
        //     return this[0].scrollWidth > this[0].clientWidth || this[0].scrollHeight > this[0].clientHeight;
        // };

        // let check_scroll = $('ul.items').isScrollable();
        // if(check_scroll == true)
        // {
        //     $('button.slick-next').show();
        // }else{
        //     $('button.slick-next').hide();
        // }
        $('#toggleMenu').on('click', function () {
            $(".panel-option").toggleClass('open');
        });
        $('#closeMenu').on('click', function () {
            $(".panel-option").removeClass('open');
        });

    });
</script>
<script>
    $('#selected_date').on('change', function(e){
        $(this).closest('form').submit();
});
    // $('.slick-prev').on('click', function () {
    //     $('ul.items').scrollLeft($('ul.items').scrollLeft() - 100);
    // })

    // $(".slick-next").click(function () {
    //     $('ul.items').scrollLeft($('ul.items').scrollLeft() + 100);
    // });
</script>
@endsection
