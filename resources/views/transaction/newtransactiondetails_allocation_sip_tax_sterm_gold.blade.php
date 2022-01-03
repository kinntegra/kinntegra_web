<div class="tab-pane  fade show  @if($j == 1){{'active'}}@endif" id="{{$portfolio->fund_category}}-{{ $client->type }}" role="tabpanel">
    <form class="trial active" action="{{ route('transaction.update',[$client->id]) }}" id="{{$portfolio->fund_category}}_portfolio_details" method="POST">
        @method('put')
        @csrf
        {{-- @php
            dd($client);
        @endphp --}}
        <input type="hidden" name="{{ $portfolio->fund_category }}-transaction_id" value="{{ $client->id }}">
        <input type="hidden" name="{{ $portfolio->fund_category }}-transaction_client_id" value="{{ $client->client_account_id }}">
        <input type="hidden" name="{{ $portfolio->fund_category }}-transaction_type" value="{{ $portfolio->fund_category }}">
        <input type="hidden" name="{{ $portfolio->fund_category }}-transaction_buy_client_id" value="{{ $portfolio->id }}">
        <input type="hidden" name="{{ $portfolio->fund_category }}-transaction_custom" value="{{ $portfolio->allocation_type == 'Custom' ? 1 : 0 }}">
        <input type="hidden" name="{{ $portfolio->fund_category }}_sip_allocation_equity_ratio_recommended" id="{{ $portfolio->fund_category }}_sip_allocation_equity_ratio_recommended" value="{{ $portfolio->recommended_equity }}">

        <div class="row">
            <div class="col-md-6">
                <div class="card small-card option-2 option-2 mb-4">
                    <div class="card-header">
                        <h6 class="card-title">Total Amount</h6>
                        <span class="edit-now float-right mt-1">Edit</span>
                        <span class="save-now {{ $portfolio->fund_category }} float-right mt-1 d-none" data-category="{{ $portfolio->fund_category }}" data-maincategory="{{ $client->type }}">Save</span>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="{{ $portfolio->fund_category }}-portfolio" id="{{ $portfolio->fund_category }}-portfolio" value="{{ $portfolio->id }}">
                        <div class="row">
                            <div class="col-xl-5 col-sm-6">
                                <div class="form-group mb-3 mb-sm-0">
                                    <label>Amount (₹)</label>
                                    <input type="text" readonly class="form-control-plaintext showhide font-bold amount"
                                        value="{{$portfolio->amount_format}}" name="{{ $portfolio->fund_category }}-amount" id="{{ $portfolio->fund_category }}-amount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card small-card option-2 option-2 mb-4">
                    <div class="card-header">
                        <h6 class="card-title">Pending Amount</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-5 col-sm-6">
                                <div class="form-group mb-3 mb-sm-0">
                                    <label>Amount (₹)</label>
                                    <input type="text" readonly class="form-control-plaintext font-bold"
                                        value="{{$portfolio->amount_format}}" name="{{ $portfolio->fund_category }}_pending_amount" id="{{ $portfolio->fund_category }}_pending_amount">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card small-card option-2 option-2 mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table normal-table">
                                <thead>
                                    <tr>
                                        <th>Scheme Name</th>
                                        <th>Folio</th>
                                        <th>Fund Category</th>
                                        <th>Minimum Amount</th>
                                        <th>Sip Date</th>
                                        <th>Amount</th>
                                        <th>Allocation</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($portfolio->modelportfolios as $mportfolio)

                                        @foreach ($mportfolio->asset_model_portfolios as $amportfolio)
                                            <tr data-id="{{ $amportfolio->fund_detail->id }}" id="schemetype_{{ $amportfolio->id }}_{{ $portfolio->fund_category }}" data-type = '{{ $portfolio->fund_category }}'>
                                                <input type="hidden" name="scheme_isin_{{ $amportfolio->fund_detail->id }}" value="{{ $amportfolio->isin }}">
                                                <td data-title="Scheme Name">
                                                    {{ $amportfolio->master_scheme->scheme_nav_name }}
                                                </td>
                                                <td data-title="Folio">
                                                    New Folio
                                                </td>
                                                <td data-title="Fund Category">
                                                    {{ $amportfolio->master_scheme->scheme_name }}
                                                </td>
                                                <td>{{ $amportfolio->master_scheme->scheme_minimum_amount }}</td>
                                                <td data-title="Sip Date">
                                                    <input type="text" name="scheme_sip_date_{{$amportfolio->fund_detail->id}}" id="scheme_sip_date_{{$amportfolio->fund_detail->id}}" class="form-control-plaintext scheme_custom_date_sip" value="@if($amportfolio->fund_detail->sip_start_date){{ \Carbon\Carbon::parse($amportfolio->fund_detail->sip_start_date)->format('d-m-Y') }}@endif">
                                                </td>
                                                <td data-title="Amount">
                                                    <input type="text" name="scheme_amount_{{ $amportfolio->fund_detail->id }}" class="form-control amount scheme_amount_common scheme_amount_{{$portfolio->fund_category}} text-left" value="{{ $amportfolio->fund_detail->fund_amount }}">
                                                </td>
                                                <td data-title="Allocation">
                                                    {{ $amportfolio->fund_detail->allocation_percentage }}
                                                </td>
                                            </tr>
                                            @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card small-card option-2 option-2 mb-4">
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
                <div class="card small-card option-2 option-2 mb-4">
                    <div class="card-header">
                        <h6 class="card-title">Comments</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3" data-des-id = {{ $portfolio->id }}>
                            <label>Add Comment</label>
                            <textarea class="form-control description" name="sip-description" id="sip-description">{{ $portfolio->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right">
                <button type="@if($j == $total_portfolio_count){{'submit'}}@else{{ 'button' }}@endif" class="btn btn-primary btn-lg" @if($j != $total_portfolio_count) onclick="save_next('{{ $portfolio->fund_category }}')" @endif>
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
