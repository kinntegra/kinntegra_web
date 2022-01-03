@extends('layouts.master')

@section('style')
<style>
    table.sortable thead {
  /* background-color: #eee;
  color: #666666;
  font-weight: bold; */
  cursor: default;
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
    input[readonly] {
        background-color: #f6f6f6 !important;
    }
</style>
@endsection


@section('content')

    <div class="container-fluid">
        <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
            <a class="back-btn" href="{{ url()->previous() }}">
                <i class="icon-left-arrow"></i>
                Allocation for {{$client->client_profile->name}}
            </a>
            {{-- <div class="section-header ">
                <a class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                        <use xlink:href="#allocation"></use>
                    </svg>View Logic</a>
            </div> --}}
        </div>
        <ul class="nav nav-tabs mb-4" id="transactions" role="tablist">
            @php
                //dd($client);
                $i = 1;
            @endphp
        @foreach ($client->portfolios as $portfolio)

            @if($portfolio->trans_status == 1 && $portfolio->fund_category == 'wealth')
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($i == 1){{'active'}}@endif text-capitalize" data-toggle="tab" href="#{{$portfolio->fund_category}}-{{ $client->type }}" role="tab">{{$portfolio->fund_category}} ({{ $client->type }})</a>
            </li>
            @php
                $i++;
            @endphp
            @endif
        @endforeach
        {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#sip" role="tab">Wealth (SIP)</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#taxLumpsum" role="tab">Tax (Lumpsum)</a>
                </li> --}}
        </ul>
        <div class="tab-content" id="transactions">
            @php
               // dd($client);
                $j = 1;
            @endphp
            @foreach ($client->portfolios as $portfolio)
            @if($portfolio->trans_status == 1)
            @if($portfolio->fund_category == 'wealth')
            <div class="tab-pane fade show  @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card small-card option-2 mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table normal-table sortable">
                                        <thead>
                                            <tr>

                                                <th>Scheme Name</th>
                                                <th>Rational</th>
                                                <th>Amount Calculation</th>
                                                <th class="text-right">Amount</th>
                                                {{-- <th>Allocation Calculation</th> --}}
                                                {{-- <th class="text-right">Allocation</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($portfolio->modelportfolios as $mportfolio)

                                                @if($mportfolio->fund_category == 'Wealth' && ($mportfolio->main_category == 'Equity' || $mportfolio->main_category == 'Debt'))
                                                    @foreach ($mportfolio->asset_model_portfolios as $amportfolio)

                                                        {{-- @if($amportfolio->send_to_bse == true) --}}
                                                        @php
                                                           // dd($portfolio);
                                                        @endphp
                                                        <tr>

                                                            <td data-title="Scheme Name">
                                                                <span class="text-uppercase" data-toggle="tooltip" data-placement="right" data-html="true"
                                            title="{{$amportfolio->master_scheme->isin}} |
                                             {{$amportfolio->master_scheme->code}}">{{ $amportfolio->master_scheme->scheme_nav_name }}</span>

                                                            </td>
                                                            <td>
                                                                @if($mportfolio->main_category == 'Equity')
                                                                if 100% is {{$amportfolio->allocation_ratio}}% then {{$portfolio->equity}}% of {{$amportfolio->allocation_ratio}}% is  <span class="font-weight-bold" style="color: #dc3545"> {{ $amportfolio->scheme_percentage }}% </span>
                                                                @else
                                                                if 100% is {{$amportfolio->allocation_ratio}}% then {{$portfolio->debt}}% of {{$amportfolio->allocation_ratio}}% is <span class="font-weight-bold" style="color: #dc3545"> {{ $amportfolio->scheme_percentage }}%</span>
                                                                @endif

                                                            </td>
                                                            <td>
                                                                @if($mportfolio->main_category == 'Equity')
                                                                {{ $portfolio->amount_format }} * {{ $amportfolio->scheme_percentage }}%
                                                                @else
                                                                {{ $portfolio->amount_format }} * {{ $amportfolio->scheme_percentage }}%
                                                                @endif
                                                            </td>

                                                            <td class="text-right" data-title="Amount">
                                                                ₹{{ $amportfolio->scheme_amount }}
                                                            </td>
                                                            {{-- <td>({{ $amportfolio->scheme_amount }} * 100) \ {{ $portfolio->amount_format }}</td> --}}
                                                            {{-- <td data-title="Allocation" class="text-right">
                                                                {{ $amportfolio->scheme_percentage }}%
                                                            </td> --}}
                                                        </tr>
                                                        {{-- @endif --}}
                                                    @endforeach
                                                @endif
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-right">
                        <button class="btn btn-primary btn-lg">Bank to Allocation</button>
                    </div>
                </div>
            </div>
            @endif


            @php
                $j++;
            @endphp
            @endif
            @endforeach
        </div>
    </div>

@endsection


@section('modal')
@endsection


@section('script')
<script type="text/javascript" src="{{ asset('assets/javascript/sorttable.js') }}"></script>
<script>
    $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    });
    $(".edit-now").click(function(e){
        $(this).parent().next().children().find('input').attr('readonly',false);

    });

    $(document).on('change', '#wealth-amount', function (e) {
        //console.log();
        $portfolio_id = $("#wealth-portfolio").val();
        $amount = e.target.value;
        $.get("/transaction/create?id="+$portfolio_id+"&amount="+$amount, function(data, status){
            location.reload();
        });
    });
    $('input[type=radio][name=allocation_wealth]').change(function() {
        if (this.value == 'recommended') {
            $("#custom_equity_ratio").attr('readonly',true);
        }
        else if (this.value == 'custom') {
            $("#custom_equity_ratio").attr('readonly',false);
        }

    });

    $(document).on('change', '#custom_equity_ratio', function (e) {

        $portfolio_id = $("#wealth-portfolio").val();
        $equity = e.target.value;
        $.get("/transaction/create?id="+$portfolio_id+"&equity="+$equity, function(data, status){
            location.reload();
           // console.log(data);
        });
    });
</script>
@endsection
