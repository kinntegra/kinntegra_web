@extends('layouts.master')

@section('style')
@endsection

@section('content')
<div class="container-fluid">
    <div class="table-top-section d-flex justify-content-between align-items-center mb-4">
        <a class="back-btn" href="#">
            <i class="icon-left-arrow"></i>
            {{ $client->name }} - Trade Details <span
                class="badge badge-primary badge-pill ml-2">Pending</span>
        </a>
        <div class="section-header ">
            {{-- <a class="btn btn-link"><svg width="30" height="30" viewBox="0 0 24 24">
                    <use xlink:href="#allocation"></use>
                </svg>View Logic</a> --}}
        </div>
    </div>

    <ul class="nav nav-tabs mb-4" id="transactions" role="tablist">
        @php
            //dd($client);
            $total_portfolio_count = 0;
            foreach ($client->portfolios as $portfolio) {
                if($portfolio->trans_status == 1)
                {
                    $total_portfolio_count++;
                }
            }

            //dd($total_portfolio_count);
            //$total_portfolio_count = count($client->portfolios);

            $i = 0;
        @endphp
        @foreach ($client->portfolios as $portfolio)

            @if($portfolio->trans_status == 1)
            @php
                $i++;
            @endphp
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($i == 1){{'active'}}@endif text-uppercase" data-count={{$i}} data-toggle="tab" href="#{{$portfolio->fund_category}}-{{ $client->type }}" role="tab">{{$portfolio->fund_category}}</a>
            </li>

            @endif
        @endforeach
    </ul>
    <div class="tab-content" id="transactions">
        @php
            $j = 1;
        @endphp
        @foreach ($client->portfolios as $portfolio)
        @if($portfolio->trans_status == 1)
        <div class="tab-pane fade show active" id="tax" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <div class="card small-card option-2 option-2 mb-4">
                        <div class="card-header">
                            <h6 class="card-title">Portfolio Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-4">
                                    <div class="form-group mb-3 mb-sm-0">
                                        <label>Amount</label>
                                        {{-- <input type="text" readonly class="form-control-plaintext font-bold"
                                            value="₹ 50.32K"> --}}
                                        <span class="form-control-plaintext font-bold">
                                            {{ $client->total_amount }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-4">
                                    <div class="form-group mb-3 mb-sm-0">
                                        <label>Transaction Type</label>
                                        {{-- <input type="text" readonly class="form-control-plaintext font-bold"
                                            value=""> --}}
                                        <span class="form-control-plaintext font-bold text-capitalize">
                                            {{ $client->type }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-4">
                                    <div class="form-group mb-3 mb-sm-0">
                                        <label>Mode Of Payment</label>
                                        {{-- <input type="text" readonly class="form-control-plaintext font-bold"
                                            value="₹ 50.32K"> --}}
                                        <span class="form-control-plaintext font-bold text-capitalize">
                                            OTM
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card small-card option-2 mb-4">
                        <div class="card-header">
                            <h6 class="card-title">Client Review</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="form-group mb-3 mb-sm-0">
                                        <label>Remark</label>
                                        <span class="form-control-plaintext font-bold">
                                            Change in payment mode to netbanking for the further status
                                        </span>
                                        {{-- <input type="text" readonly class="form-control-plaintext font-bold"
                                            value="Change in payment mode to netbanking for the further status. Change in payment mode to netbanking for the further status"> --}}
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
                                <table class="table normal-table">
                                    <thead>
                                        <tr>
                                            <th>Folio Number</th>
                                            <th>Scheme Name</th>
                                            <th>Amount</th>
                                            <th>Allocation</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select>
                                                    <option selected>New Folio</option>
                                                </select>
                                            </td>
                                            <td>
                                                Reliance Large Cap Fund - Growth Plan - Growth
                                            </td>
                                            <td>
                                                ₹10L
                                            </td>
                                            <td>
                                                10%
                                            </td>
                                            <td>
                                                01/04/2020
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select>
                                                    <option selected>New Folio</option>
                                                </select>
                                            </td>
                                            <td>
                                                Reliance Large Cap Fund - Growth Plan - Growth
                                            </td>
                                            <td>
                                                ₹10L
                                            </td>
                                            <td>
                                                10%
                                            </td>
                                            <td>
                                                01/04/2020
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select>
                                                    <option selected>New Folio</option>
                                                </select>
                                            </td>
                                            <td>
                                                Reliance Large Cap Fund - Growth Plan - Growth
                                            </td>
                                            <td>
                                                ₹10L
                                            </td>
                                            <td>
                                                10%
                                            </td>
                                            <td>
                                                01/04/2020
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select>
                                                    <option selected>New Folio</option>
                                                </select>
                                            </td>
                                            <td>
                                                Reliance Large Cap Fund - Growth Plan - Growth
                                            </td>
                                            <td>
                                                ₹10L
                                            </td>
                                            <td>
                                                10%
                                            </td>
                                            <td>
                                                01/04/2020
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select>
                                                    <option selected>New Folio</option>
                                                </select>
                                            </td>
                                            <td>
                                                Reliance Large Cap Fund - Growth Plan - Growth
                                            </td>
                                            <td>
                                                ₹10L
                                            </td>
                                            <td>
                                                10%
                                            </td>
                                            <td>
                                                01/04/2020
                                            </td>
                                        </tr>
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
                            <div class="form-group mb-3">
                                <label>Add Comment</label>
                                <textarea class="form-control" placeholder="Add Comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button class="btn btn-outline-primary btn-lg mr-3">Cancel</button>
                    <button class="btn btn-primary btn-lg">Save</button>
                </div>
            </div>
        </div>
        @endif
        @endforeach

    </div>
</div>
@endsection

@section('modal')
@endsection

@section('script')
@endsection
