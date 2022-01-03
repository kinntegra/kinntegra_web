<div class="tab-pane fade show  @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
<form class="trial active" action="{{ route('transaction.update',[$client->id]) }}" id="swp_portfolio_details" method="POST">
    @method('put')
    @csrf

    <input type="hidden" name="sip-transaction_id" value="{{ $client->id }}">
    <input type="hidden" name="sip-transaction_client_id" value="{{ $client->client_account_id }}">
    <input type="hidden" name="sip-transaction_type" value="wealth-sip">
    <input type="hidden" name="sip-transaction_buy_client_id" value="{{ $portfolio->id }}">
    <input type="hidden" name="sip-transaction_custom" value="{{ $portfolio->allocation_type == 'Custom' ? 1 : 0 }}">
    <input type="hidden" name="wealthsip_allocation_equity_ratio_recommended" id="wealthsip_allocation_equity_ratio_recommended" value="{{ $portfolio->recommended_equity }}">
    <div class="row">
        <div class="col-md-6">
            <div class="card small-card option-2 option-2 mb-4">
                <div class="card-header">
                    <h6 class="card-title">Portfolio Details</h6>
                    <span class="edit-now float-right mt-1">Edit</span>
                    <span class="save-now wealthsip float-right mt-1 d-none">Save</span>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sip-portfolio" id="sip-portfolio" value="{{ $portfolio->id }}">
                    <div class="row">
                        <div class="col-xl-5 col-sm-6">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Amount (₹) </label>
                                <input type="text" readonly name="sip-amount" id="sip-amount" class="form-control-plaintext amount font-bold"
                                    value="{{ $portfolio->amount_format }}">
                            </div>

                        </div>
                        <div class="col-xl-4 col-sm-6 equity-sip-amount">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Equity Amount (₹) </label>
                                <input type="text" readonly name="equity-sip-amount" id="equity-sip-amount" class="form-control-plaintext amount font-bold"
                                    value="">
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 debt-sip-amount">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Debt Amount (₹) </label>
                                <input type="text" readonly name="debt-sip-amount" id="debt-sip-amount" class="form-control-plaintext amount font-bold"
                                    value="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card small-card option-2 mb-4">
                <div class="card-header">
                    <h6 class="card-title">Select Allocation</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5 col-sm-6">
                            <div class="form-group custom-radio-btn mb-0">
                                <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input" type="radio" name="allocation_wealth_sip"
                                        id="recommended_sip" value="recommended" checked>
                                    <label class="form-check-label" for="recommended_sip" @if($portfolio->allocation_type == 'Recommended') {{'checked'}} @endif>
                                        <span class="label">Recommended Portfolio</span>
                                        <h6 class="mb-0">@if($portfolio->custom_equity != null){{$portfolio->custom_equity}}@else{{$portfolio->equity}}@endif:@if($portfolio->custom_debt != null){{$portfolio->custom_debt}}@else{{$portfolio->debt}}@endif</h6>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="form-group custom-radio-btn mb-0">
                                <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input" type="radio" name="allocation_wealth_sip"
                                        id="custom_sip" value="custom">
                                    <label class="form-check-label" for="custom_sip">
                                        <span class="label">Custom Portfolio</span>
                                        <h6 class="mb-0 custom_wealth_sip">0:0</h6>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="select-wrapper">
                                @php
                                    if($portfolio->custom_equity != null || $portfolio->allocation_type == 'Recommended'){$equity = $portfolio->custom_equity; }
                                    else{$equity =  $portfolio->equity; }
                                    //dd($equity);
                                @endphp

                                <select class="form-control" id="custom_equity_ratio_sip" name="custom_equity_ratio_sip" readonly>
                                    @include('transaction.transaction_ratio', ['val' => 0])
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card small-card option-2 mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table normal-table sortable">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Scheme Name</th>
                                    <th>Fund Category</th>
                                    <th>Sip date</th>
                                    <th class="text-right">Amount</th>
                                    <th class="text-right">Allocation</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($portfolio->modelportfolios as $mportfolio)

                                    @if($mportfolio->fund_category == 'Wealth' && ($mportfolio->main_category == 'Equity' || $mportfolio->main_category == 'Debt'))
                                        @foreach ($mportfolio->asset_model_portfolios as $amportfolio)


                                            @php
                                                //dd($amportfolio);
                                            @endphp
                                            <tr data-fund-id="{{$amportfolio->fund_detail->id}}">
                                                <td data-title="Folio Number">
                                                    New Folio
                                                </td>
                                                @php
                                                   // dd($amportfolio);
                                                @endphp
                                                <td data-title="Scheme Name">
                                                    <span class="text-capitalize" data-toggle="tooltip" data-placement="right" data-html="true"
                                title="{{$amportfolio->master_scheme_sip->isin}} |
                                {{$amportfolio->master_scheme_sip->scheme_code}}">{{ $amportfolio->master_scheme_sip->scheme_name }}</span>

                                                </td>

                                                <td data-title="Fund Category">
                                                    {{ $amportfolio->master_scheme_sip->amc_name }}
                                                </td>
                                                <td data-title="Sip Date">
                                                    <input type="text" name="scheme_sip_date_{{$amportfolio->fund_detail->id}}" id="scheme_sip_date_{{$amportfolio->fund_detail->id}}" class="form-control-plaintext scheme_custom_date_equity" value="{{ \Carbon\Carbon::parse($amportfolio->fund_detail->sip_start_date)->format('d-m-Y') }}">
                                                </td>
                                                @if($mportfolio->main_category == 'Equity')
                                                <td class="text-right scheme_amount_equity" data-title="Amount">
                                                    <input type="text" readonly name="scheme_amount_{{$amportfolio->fund_detail->id}}" class="form-control-plaintext amount scheme_custom_amount_equity text-right" value="₹{{ $amportfolio->scheme_amount }}">
                                                </td>
                                                @elseif($mportfolio->main_category == 'Debt')
                                                <td class="text-right scheme_amount_debt" data-title="Amount">
                                                    <input type="text" readonly name="scheme_amount_{{$amportfolio->fund_detail->id}}" class="form-control-plaintext amount scheme_custom_amount_debt text-right" value="₹{{ $amportfolio->scheme_amount }}">
                                                </td>
                                                @endif
                                                <td data-title="Allocation" class="text-right scheme_percentage">
                                                    {{ $amportfolio->scheme_percentage }}%
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card small-card option-2 mb-4">
                <div class="card-header">
                    <h6 class="card-title">Rational For Trade</h6>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat justo
                        lacus, eget auctor erat mollis eget. Maecenas egestas tempor volutpat. Ut
                        risus orci, commodo in ex ut, fermentum accumsan nisl.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card small-card option-2 mb-4">
                <div class="card-header">
                    <h6 class="card-title">Comments</h6>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3" data-des-id = {{ $portfolio->id }}>
                        <label>Add Comment</label>
                        <textarea class="form-control description" name="wealth-description" id="wealth-description">{{ $portfolio->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 text-right">

            <button type="@if($j == $total_portfolio_count){{'submit'}}@else{{ 'button' }}@endif" class="btn btn-primary btn-lg">
                @if($j == $total_portfolio_count)
                Go for Payment
                @else
                Save and Next
                @endif
            </button>
        </div>
    </div>
</form>
</div>
