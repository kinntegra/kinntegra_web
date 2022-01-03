<div class="tab-pane fade show  @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
    <form class="trial active" action="{{ route('transaction.update',[$client->id]) }}" id="swp_portfolio_details" method="POST">
        @method('put')
        @csrf
        <input type="hidden" name="transaction_id" value="{{ $client->id }}">
        <input type="hidden" name="transaction_client_id" value="{{ $client->client_account_id }}">
        <input type="hidden" name="transaction_type" value="SWP">
        <input type="hidden" name="transaction_buy_client_id" value="{{ $portfolio->id }}">
        <input type="hidden" name="transaction_custom" value="{{ $portfolio->allocation_type == 'Custom' ? 1 : 0 }}">
        <input type="hidden" name="swp_allocation_equity_ratio_recommended" id="swp_allocation_equity_ratio_recommended" value="{{ $portfolio->recommended_equity }}">
        <div class="row">
            <div class="col-md-6">
                <div class="card small-card option-2 option-2 mb-4 pb-1">
                    <div class="card-header">
                        <h6 class="card-title">Portfolio Details</h6>
                        <span class="edit-now float-right mt-1">Edit</span>
                        <span class="save-now float-right mt-1 d-none" data-category="{{ $portfolio->fund_category }}" data-maincategory="{{ $client->type }}">Save</span>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="swp-portfolio" id="swp-portfolio" value="{{ $portfolio->id }}">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="form-group mb-3 mb-sm-0">
                                    <label>Amount (₹) </label>
                                    <input type="text" readonly name="swp_amount" id="swp-amount" class="form-control-plaintext amount font-bold showhide"
                                        value="{{ $portfolio->amount_format }}">
                                </div>
                                {{-- <div class="mb-3 mb-sm-0">
                                    (@if($portfolio->custom_equity != null){{$portfolio->custom_equity}}@else{{$portfolio->equity}}@endif:@if($portfolio->custom_debt != null){{$portfolio->custom_debt}}@else{{$portfolio->debt}}@endif)
                                </div> --}}
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="form-group mb-3 mb-sm-0">
                                    <label>Withdrawal (₹) </label>
                                    <input type="text" readonly name="withdrawal_amount" id="withdrawal_amount" class="form-control-plaintext amount font-bold showhide"
                                        value="{{ $portfolio->withdrawal_amount }}">
                                    <input type="hidden" name="previous_withdrawal_amount" id="previous_withdrawal_amount" value="{{ $portfolio->withdrawal_amount }}">
                                </div>
                            </div>


                            <div class="col-xl-3 col-sm-6 equity-swp-amount">
                                <div class="form-group mb-3 mb-sm-0">
                                    <label>Equity Amount (₹) </label>
                                    <input type="text" readonly name="equity-swp-amount" id="equity-swp-amount" class="form-control-plaintext amount font-bold"
                                        value="{{ $portfolio->allocation_type == 'Custom' ? $portfolio->equity_amount : '' }}">
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 debt-swp-amount">
                                <div class="form-group mb-3 mb-sm-0">
                                    <label>Debt Amount (₹) </label>
                                    <input type="text" readonly name="debt-swp-amount" id="debt-swp-amount" class="form-control-plaintext amount font-bold"
                                        value="{{ $portfolio->allocation_type == 'Custom' ? $portfolio->debt_amount : '' }}">
                                </div>
                            </div>
                                @php
                                    //dd($portfolio->swp_start_date);
                                @endphp
                            <div class="col-xl-4 col-sm-6 d-none">
                                <div class="form-group mb-3 mb-sm-0">
                                    <label>SWP Start date </label>
                                    <input type="hidden" readonly name="swp_start_date" id="swp_start_date" class="form-control-plaintext swp_start_date font-bold"
                                        value="{{ Carbon\Carbon::parse($portfolio->swp_start_date)->format('d-m-Y') }}">
                                    <input type="hidden" readonly name="swp_manage_date" id="swp_manage_date" class="form-control-plaintext swp_start_date font-bold"
                                        value="{{ Carbon\Carbon::parse($portfolio->swp_start_date)->format('d-m-Y') }}">
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 mt-2 d-none" id="mismatch_amount">
                                <label class="error">SWP Withdrawal amount should not be Zero</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card small-card option-2 mb-4 pb-1">
                    <div class="card-header">
                        <h6 class="card-title">Select Allocation</h6>
                        <span class="reset-now float-right mt-1">Reset</span>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-5 col-sm-6">
                                <div class="form-group custom-radio-btn mb-0">
                                    <div class="form-check form-check-inline m-0">
                                        <input class="form-check-input" type="radio" name="allocation_wealth_swp"
                                            id="recommended" value="recommended" @if($portfolio->allocation_type == 'Recommended') checked @endif>
                                        <label class="form-check-label" for="recommended" @if($portfolio->allocation_type == 'Recommended') {{'checked'}} @endif>
                                            <span class="label">Recommended Portfolio</span>
                                            <h6 class="mb-0">@if($portfolio->allocation_type == 'Recommended') @if($portfolio->custom_equity != null){{$portfolio->custom_equity}}@else{{$portfolio->equity}}@endif:@if($portfolio->custom_debt != null){{$portfolio->custom_debt}}@else{{$portfolio->debt}}@endif @else {{$portfolio->recommended_equity}}:{{$portfolio->recommended_debt}} @endif</h6>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6">
                                <div class="form-group custom-radio-btn mb-0">
                                    <div class="form-check form-check-inline m-0">
                                        <input class="form-check-input" type="radio" name="allocation_wealth_swp"
                                            id="custom" value="custom" @if($portfolio->allocation_type == 'Custom') checked @endif>
                                        <label class="form-check-label" for="custom">
                                            <span class="label">Custom Portfolio</span>
                                            <h6 class="mb-0 custom_swp">@if($portfolio->allocation_type == 'Custom') @if($portfolio->custom_equity != null){{$portfolio->custom_equity}}@else{{$portfolio->equity}}@endif:@if($portfolio->custom_debt != null){{$portfolio->custom_debt}}@else{{$portfolio->debt}}@endif @else 0:0 @endif</h6>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="select-wrapper">
                                    @php
                                        if($portfolio->custom_equity != null || $portfolio->allocation_type == 'Recommended'){$equity = $portfolio->custom_equity; }
                                        else{$equity =  $portfolio->equity; }
                                    @endphp

                                    <select class="form-control" id="custom_equity_ratio_swp" name="custom_equity_ratio_swp" @if($portfolio->allocation_type == 'Recommended' ) {{'readonly'}} @endif>
                                        @if($portfolio->allocation_type == 'Recommended' )
                                        @include('transaction.transaction_ratio', ['val' => 0])
                                        @else
                                        @include('transaction.transaction_ratio', ['val' => $portfolio->custom_equity])
                                        @endif
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
                            <table class="table normal-table sortable" id="allocation_swp">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Scheme Name</th>
                                        <th>Priority</th>
                                        <th>Max SWP</th>
                                        <th>Start Date</th>
                                        <th>SWP Count</th>
                                        <th class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
                                        <th>Allocation</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($portfolio->modelportfolios as $mportfolio)
                                    @php
                                        $swp_count =  count($portfolio->swp_allocated) + 1;
                                        //dd($swp_count);
                                    @endphp
                                        @if($mportfolio->fund_category == 'SWP' && ($mportfolio->main_category == 'Equity' || $mportfolio->main_category == 'Debt'))
                                            @foreach ($mportfolio->asset_model_portfolios as $amportfolio)
                                                <input type="hidden" name="scheme_isin_{{$amportfolio->fund_detail->id}}" value="{{ $amportfolio->isin }}">
                                                {{-- @if($amportfolio->send_to_bse == true) --}}
                                                <tr data-fund-id="{{$amportfolio->fund_detail->id}}" id="folio_{{$amportfolio->fund_detail->id}}">
                                                    <td data-title="Folio">
                                                        New Folio
                                                    </td>
                                                    <td data-title="Scheme Name" class="swp_scheme_{{$amportfolio->fund_detail->id}}">
                                                        <span class="text-capitalize" data-toggle="tooltip" data-placement="right" data-html="true" title="{{$amportfolio->master_scheme->isin}} |
                                    {{$amportfolio->master_scheme->code}}">{{ $amportfolio->master_scheme->scheme_nav_name }}</span>
                                                        <span class="s_info d-none" data-toggle="tooltip" data-placement="right" data-html="true" title="">&#x1F6C8;</span>
                                                    </td>
                                                    <td data-title="Proirity">
                                                        @if($amportfolio->priority == 1)
                                                        <select data-val="" class="form-control scheme_priority" id="scheme_priority_{{$amportfolio->fund_detail->id}}" name="scheme_priority_{{$amportfolio->fund_detail->id}}" @if(isset($amportfolio->swp_allocation)) {{ 'readonly' }} @endif>
                                                            <option value="" disabled selected>- Select -</option>
                                                            @if(isset($amportfolio->swp_allocation))
                                                                @for ($i = 1;$i <= $client->priority;$i++)
                                                                    <option value="{{ $i }}" @if($amportfolio->swp_allocation->swp_priority == $i) {{'selected'}} @endif>{{$i}}</option>
                                                                @endfor
                                                            @else

                                                                @for ($i = $swp_count;$i <= $client->priority;$i++)
                                                                    <option value="{{ $i }}">{{$i}}</option>
                                                                @endfor
                                                            @endif
                                                        </select>
                                                        @else
                                                        @endif
                                                    </td>
                                                    <td data-title="MAX SWP">
                                                        @if($amportfolio->priority == 1)
                                                            @php
                                                                $availability =(int) round($amportfolio->scheme_og_amount / $portfolio->withdrawal_amount);
                                                       // dd($availability);
                                                                if($amportfolio->swp_allocation != null && $availability == $amportfolio->swp_allocation->swp_max){

                                                                    $availability = $amportfolio->swp_allocation->swp_max;
                                                                }
                                                            @endphp
                                                            {{$availability}}
                                                        @endif
                                                    </td>
                                                    <td data-title="START DATE">
                                                        @if($amportfolio->priority == 1)
                                                        <input type="text" id="swp_start_end_date_{{$amportfolio->fund_detail->id}}" name="swp_start_end_date_{{$amportfolio->fund_detail->id}}" class="form-control swp_start_end_date char-5" value="{{ @$amportfolio->swp_allocation->swp_start_date }}" readonly>
                                                        <input type="hidden" id="swp_start_date_{{$amportfolio->fund_detail->id}}" name="swp_start_date_{{$amportfolio->fund_detail->id}}" value="{{ @$amportfolio->swp_allocation->swp_start_date }}">
                                                        <input type="hidden" id="swp_end_date_{{$amportfolio->fund_detail->id}}" name="swp_end_date_{{$amportfolio->fund_detail->id}}" value="{{ @$amportfolio->swp_allocation->swp_start_date }}">
                                                        <input type="hidden" id="swp_max_{{$amportfolio->fund_detail->id}}" name="swp_max_{{$amportfolio->fund_detail->id}}" value="{{$availability}}">

                                                        @endif
                                                    </td>
                                                    <td data-title="SWP COUNT">
                                                        @if($amportfolio->priority == 1)
                                                        <input type="text" id="scheme_month_{{$amportfolio->fund_detail->id}}" name="scheme_month_{{$amportfolio->fund_detail->id}}" class="form-control scheme_custom_month char-5" value="{{ @$amportfolio->swp_allocation->months }}" @if(!isset($amportfolio->swp_allocation)) {{'readonly'}} @endif>
                                                        @endif
                                                    </td>
                                                    @if($mportfolio->main_category == 'Equity')
                                                    <td class="text-right scheme_amount_equity" data-title="Amount">
                                                        <input type="text" @if($portfolio->allocation_type == 'Recommended') {{'readonly'}} @endif name="scheme_amount_{{$amportfolio->fund_detail->id}}" class="form-control-plaintext  scheme_custom_amount_equity_swp text-right char-5" value="₹{{ $amportfolio->scheme_amount }}">
                                                    </td>
                                                    @elseif($mportfolio->main_category == 'Debt')
                                                    <td class="text-right scheme_amount_debt" data-title="Amount">
                                                        <input type="text" @if($portfolio->allocation_type == 'Recommended') {{'readonly'}} @endif name="scheme_amount_{{$amportfolio->fund_detail->id}}" class="form-control-plaintext  scheme_custom_amount_debt_swp text-right char-5" value="₹{{ $amportfolio->scheme_amount }}">
                                                    </td>
                                                    @endif
                                                    <td data-title="Allocation" class="text-right scheme_percentage_swp">
                                                        <input type="text" class="form-control-plaintext text-right char-5" id="scheme_percentage_{{$amportfolio->fund_detail->id}}" name="scheme_percentage_{{$amportfolio->fund_detail->id}}" value="{{$amportfolio->scheme_percentage}}%">

                                                    </td>
                                                    {{-- <td data-title="Future Amount" id="future_amount_{{$amportfolio->id}}">
                                                        @if($amportfolio->priority == 1)
                                                        0
                                                        @endif
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
