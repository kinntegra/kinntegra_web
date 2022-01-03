<div class="tab-pane fade show  @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
<form class="trial active" action="{{ route('transaction.update',[$client->id]) }}" id="wealth_portfolio_details" method="POST">
    @method('put')
    @csrf
    {{-- @php
        dd($client);
    @endphp --}}
    <input type="hidden" name="wealth-transaction_id" value="{{ $client->id }}">
    <input type="hidden" name="wealth-transaction_client_id" value="{{ $client->client_account_id }}">
    <input type="hidden" name="wealth-transaction_type" value="wealth">
    <input type="hidden" name="wealth-transaction_buy_client_id" value="{{ $portfolio->id }}">
    <input type="hidden" name="wealth-transaction_custom" value="{{ $portfolio->allocation_type == 'Custom' ? 1 : 0 }}">
    <input type="hidden" name="wealth-transaction_custom_equity_ratio" value="{{ @$portfolio->custom_equity }}">
    <input type="hidden" name="wealth-transaction_custom_debt_ratio" value="{{ @$portfolio->custom_debt }}">
    <input type="hidden" name="wealth_allocation_equity_ratio_recommended" id="wealth_allocation_equity_ratio_recommended" value="{{ $portfolio->recommended_equity }}">
    <div class="row">
        <div class="col-md-6">
            <div class="card small-card option-2 option-2 mb-4">
                <div class="card-header">
                    <h6 class="card-title">Portfolio Details</h6>
                    <span class="edit-now float-right mt-1">Edit</span>
                    <span class="save-now wealth float-right mt-1 d-none" data-category="{{ $portfolio->fund_category }}" data-maincategory="{{ $client->type }}">Save</span>
                </div>
                <div class="card-body">
                    <input type="hidden" name="wealth-portfolio" id="wealth-portfolio" value="{{ $portfolio->id }}">
                    <div class="row">
                        <div class="col-xl-5 col-sm-6">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Amount (₹) </label>
                                <input type="text" readonly name="wealth-amount" id="wealth-amount" class="form-control-plaintext amount font-bold showhide"
                                    value="{{ $portfolio->amount_format }}">
                            </div>
                            {{-- <div class="mb-3 mb-sm-0">
                                (@if($portfolio->custom_equity != null){{$portfolio->custom_equity}}@else{{$portfolio->equity}}@endif:@if($portfolio->custom_debt != null){{$portfolio->custom_debt}}@else{{$portfolio->debt}}@endif)
                            </div> --}}
                        </div>

                        <div class="col-xl-4 col-sm-6 equity-wealth-amount" style="display:none;">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Equity Amount (₹) </label>
                                <input type="text" readonly name="equity-wealth-amount" id="equity-wealth-amount" class="form-control-plaintext amount font-bold"
                                    value="{{ $portfolio->equity_amount }}">
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 debt-wealth-amount" style="display:none;">
                            <div class="form-group mb-3 mb-sm-0">
                                <label>Debt Amount (₹) </label>
                                <input type="text" readonly name="debt-wealth-amount" id="debt-wealth-amount" class="form-control-plaintext amount font-bold"
                                    value="{{ $portfolio->debt_amount }}">
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
                                    <input class="form-check-input" type="radio" name="allocation_wealth"
                                        id="recommended" value="recommended" @if($portfolio->allocation_type == 'Recommended') {{'checked'}} @endif>
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
                                    <input class="form-check-input" type="radio" name="allocation_wealth"
                                        id="custom" value="custom" @if($portfolio->allocation_type == 'Custom') {{'checked'}} @endif>
                                    <label class="form-check-label" for="custom" @if($portfolio->allocation_type == 'Custom') {{'checked'}} @endif>
                                        <span class="label">Custom Portfolio</span>
                                        <h6 class="mb-0 custom_wealth">@if($portfolio->allocation_type == 'Custom') @if($portfolio->custom_equity != null){{$portfolio->custom_equity}}@else{{$portfolio->equity}}@endif:@if($portfolio->custom_debt != null){{$portfolio->custom_debt}}@else{{$portfolio->debt}}@endif @else 0:0 @endif</h6>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="select-wrapper">
                                @php
                                    $cequity = 0;
                                    if($portfolio->allocation_type == 'Custom'){$cequity = $portfolio->equity; }
                                    //dd($equity);
                                @endphp

                                <select class="form-control" id="custom_equity_ratio" name="custom_equity_ratio" @if($portfolio->allocation_type == 'Recommended'){{'readonly'}}@endif>
                                    @include('transaction.transaction_ratio', ['val' => $cequity])
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
                    <div class="table-responsive tableFixHead">
                        <table class="table normal-table sortable">
                            <thead>


                                <tr>
                                    <th>Folio</th>
                                    <th>Scheme Name</th>
                                    <th>Fund Category</th>
                                    <th class="text-right">Amount</th>
                                    <th class="text-right">Allocation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($portfolio->modelportfolios as $mportfolio)
                                    @if($mportfolio->fund_category == 'Wealth' && ($mportfolio->main_category == 'Equity' || $mportfolio->main_category == 'Debt'))
                                        @php
                                            $tpercentage = 0;
                                            $tamount = 0;
                                        @endphp
                                        @foreach ($mportfolio->asset_model_portfolios as $amportfolio)

                                            {{-- @if($amportfolio->send_to_bse == true) --}}
                                            @php
                                                $tpercentage = $amportfolio->scheme_percentage + $tpercentage;
                                                $tamount = (int)str_replace( ',', '', $amportfolio->scheme_amount) + $tamount;

                                                //
                                                $decimal = (string)($tamount - floor($tamount));
                                                $money = floor($tamount);
                                                $length = strlen($money);
                                                $delimiter = '';
                                                $money = strrev($money);
                                                for($i=0;$i<$length;$i++){
                                                    if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                                                        $delimiter .=',';
                                                    }
                                                    $delimiter .=$money[$i];
                                                }
                                                $total_amount = strrev($delimiter);
                                                $decimal = preg_replace("/0\./i", ".", $decimal);
                                                $decimal = substr($decimal, 0, 3);

                                                if( $decimal != '0'){
                                                    $total_amount = $total_amount.$decimal;
                                                }
                                                //

                                            @endphp
                                            <tr data-fund-id="{{$amportfolio->fund_detail->id}}" id="folio_{{$amportfolio->fund_detail->id}}">
                                                <input type="hidden" name="scheme_isin_{{ $amportfolio->fund_detail->id }}" value="{{ $amportfolio->isin }}">
                                                <td data-title="Folio">
                                                    New Folio
                                                </td>
                                                <td data-title="Scheme Name" class="wealth_scheme_{{$amportfolio->fund_detail->id}}">
                                                    <span class="text-capitalize" data-toggle="tooltip" data-placement="right" data-html="true"
                                                        title="{{$amportfolio->master_scheme->isin}} |
                                                        {{$amportfolio->master_scheme->code}}">
                                                        {{ $amportfolio->master_scheme->scheme_nav_name }}
                                                    </span>
                                                </td>

                                                <td data-title="Fund Category">
                                                    {{ $amportfolio->master_scheme->scheme_category }}
                                                </td>
                                                @if($mportfolio->main_category == 'Equity')
                                                <td class="text-right scheme_amount_equity" data-title="Amount">
                                                    <input type="text" @if($portfolio->allocation_type == 'Recommended'){{'readonly'}} @endif name="scheme_amount_{{$amportfolio->fund_detail->id}}" class="form-control-plaintext amount scheme_custom_amount_equity d-inline text-right" value="₹{{ $amportfolio->scheme_amount }}">
                                                </td>
                                                @elseif($mportfolio->main_category == 'Debt')
                                                <td class="text-right scheme_amount_debt" data-title="Amount">
                                                    <input type="text" @if($portfolio->allocation_type == 'Recommended'){{'readonly'}} @endif name="scheme_amount_{{$amportfolio->fund_detail->id}}" class="form-control-plaintext amount scheme_custom_amount_debt d-inline text-right" value="₹{{ $amportfolio->scheme_amount }}">
                                                </td>
                                                @endif
                                                <td data-title="Allocation" class="text-right scheme_percentage">
                                                    {{ $amportfolio->scheme_percentage }}%
                                                </td>
                                            </tr>
                                            {{-- @endif --}}
                                        @endforeach
                                        @if($portfolio->allocation_type == 'Custom')
                                        <thead class="table-dark">
                                        <tr class="total_{{strtolower($mportfolio->main_category)}} thead-light border-bottom">
                                            <td colspan="3" class="text-center font-weight-bold">Total</td>
                                            <td class="text-right font-weight-bold" data-title="Total Amount"><span class="total_{{strtolower($mportfolio->main_category)}}_amount">{{ $total_amount }}</span></td>
                                            <td class="text-right font-weight-bold" data-title="Total %" ><span class="total_{{strtolower($mportfolio->main_category)}}_percentage">{{$tpercentage}}</span>%</td>
                                        </tr>
                                        </thead>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot class="table-error" id="mismatch_equity_debt" style="display: none">
                                <tr>
                                    <th colspan="5" class="text-center font-weight-bold">
                                        Total Equity and Debt percentage must be 100%
                                    </th>
                                </tr>
                            </tfoot>
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

            <button type="@if($j == $total_portfolio_count){{'submit'}}@else{{ 'button' }}@endif" @if($j != $total_portfolio_count) onclick="wealth_save()" @endif class="btn btn-primary btn-lg">
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
