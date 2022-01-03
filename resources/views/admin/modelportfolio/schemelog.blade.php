@extends('layouts.master')

@section('style')

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
        <h3 class="section-title mb-4 d-flex justify-content-between">Manage Scheme Logs
            <button class="btn btn-link d-md-none" id="toggleMenu">Admin Menu</button>
        </h3>
            <div class="card mb-4">
            <div class="card-body">
                <div class="row flex-row-reverse ">

                    <div class="col-lg-12">
                        <div class="admin-body">
                            <div class="row">
                                <div class="col-xl-7 mb-3 mb-xl-0">
                                    <ul class="nav nav-tabs mb-4" id="lead-generation" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-toggle="tab" href="#admin-tax"
                                                role="tab" aria-selected="true">Scheme Log</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-5 pl-xl-0">
                                    <div class="table-options float-right">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="leadsContent">
                                <div class="tab-pane fade show active" id="admin-tax" role="tabpanel">
                                    <div class="card small-card option-2 mb-4">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table normal-table">
                                                    <thead>
                                                        <tr class="text-center">

                                                            <th width="40%">Scheme Category</th>
                                                            <th width="15%">Scheme Type</th>
                                                            <th width="15%">Buy Type</th>
                                                            <th width="15%">Sell Type</th>
                                                            <th width="15%">Portfolio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($logs as $log)
                                                        <tr>
                                                            <td data-title="Scheme Name">
                                                                {{ $log->scheme_category }}
                                                            </td>
                                                            <td class="text-center" data-title="Regular Wealth Residence">
                                                                {{ $log->scheme_type }}
                                                            </td>
                                                            <td class="text-center" data-title="Regular Wealth NRI">
                                                                {{ $log->buy_type }}
                                                            </td>
                                                            <td class="text-center" data-title="Regular SWP Residence">
                                                                {{ $log->sell_type }}
                                                            </td>
                                                            <td class="text-center" data-title="Regular SWP NRI">
                                                                {{ $log->portfolio }}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary btn-lg">Save Changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

@endsection

@section('script')
<script>
   $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('input[name="dates"]').daterangepicker();
        var activeTab;
        var table = $('.show table').DataTable({
            bInfo: true,
            sDom: 'lrtip',
            bLengthChange: false,
            retrieve: true,
            autoWidth: false,

            columnDefs: [{
                responsivePriority: 1,
                targets: 0
            },
            {
                responsivePriority: 1,
                targets: -1,
                orderable: false
            }
            ]
        });
        $('#next').on('click', function () {
            table.page('next').draw('page');
        });
        $('#tableSearch').on('keyup', function () {
            table.search(this.value).draw();
            let info = table.page.info();
            if (info.pages <= 1) {
                $('#next').attr("disabled", true);
                $('#previous').attr("disabled", true);
            } else {
                $('#next').attr("disabled", false);
                $('#previous').attr("disabled", true);
            }
        });
        $('#previous').on('click', function () {
            table.page('previous').draw('page');
        });
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            $('#tableSearch').val('');
            $('#previous').attr("disabled", true);
            table.destroy();
            table = $(".show table").DataTable({
                bInfo: true,
                sDom: 'lrtip',
                bLengthChange: false,
                retrieve: true,
                autoWidth: false,
                columnDefs: [{
                    responsivePriority: 1,
                    targets: 0,
                    searchable: true
                },
                {
                    responsivePriority: 2,
                    targets: 1,
                    searchable: true
                },
                {
                    responsivePriority: 3,
                    targets: 2,
                    searchable: true
                },
                {
                    responsivePriority: 1,
                    targets: -1,
                    orderable: false
                }
                ]
            });
            let info = table.page.info();
            info.pages == 1 ? $('#next').attr("disabled", true) : $('#next').attr("disabled",
                false);

        })
        $('table').on('page.dt', function () {
            let info = table.page.info();
            if (info.pages - 1 == info.page) {
                $('#next').attr("disabled", true);
                $('#previous').attr("disabled", false);
            } else if (info.page == 0) {
                $('#next').attr("disabled", false);
                $('#previous').attr("disabled", true);
            } else {
                $('#next').attr("disabled", false);
                $('#previous').attr("disabled", false);
            }
        });
    });

</script>
@endsection
