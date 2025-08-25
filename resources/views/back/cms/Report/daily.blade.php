@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Laporan Harian Service</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.cms.Report.index') }}">Laporan</a></li>
                @if(request()->has('from_monthly'))
                    <li class="breadcrumb-item"><a href="{{ route('admin.cms.Report.monthly') }}">Laporan Bulanan</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.cms.Report.weekly') }}">Laporan Mingguan</a></li>
                @elseif(request()->has('from_weekly'))
                    <li class="breadcrumb-item"><a href="{{ route('admin.cms.Report.weekly') }}">Laporan Mingguan</a></li>
                @endif
                <li class="breadcrumb-item active">Laporan Harian</li>
            </ol>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="container-fluid">
    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
                </div>
                <div class="card-body">
                    <form id="filter-form">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="report-date">Tanggal:</label>
                                <input type="date" id="report-date" class="form-control" value="{{ $date }}">
                            </div>
                            <div class="col-md-4">
                                <label>&nbsp;</label><br>
                                <button type="button" id="filter-btn" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Service</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-services">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-success shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="completed-services">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-warning shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="pending-services">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total-revenue">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Service Harian - <span id="report-title">{{ \Carbon\Carbon::parse($date)->format('d F Y') }}</span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nota</th>
                            <th>Pelanggan</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Masalah</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<style>
    .border-left-primary { border-left: 0.25rem solid #4e73df !important; }
    .border-left-success { border-left: 0.25rem solid #1cc88a !important; }
    .border-left-info { border-left: 0.25rem solid #36b9cc !important; }
    .border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
</style>
@endpush

@push('js')
<script>
$(function() {
    let table = $('#dataTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 25,
        ajax: {
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ route('admin.cms.Report.daily.data') }}",
            dataType: "json",
            type: "POST",
            data: function(d) {
                d.date = $('#report-date').val();
            },
            dataSrc: function(json) {
                // Update summary cards
                if (json.summary) {
                    $('#total-services').text(json.summary.total_services);
                    $('#completed-services').text(json.summary.completed_services);
                    $('#pending-services').text(json.summary.pending_services);
                    $('#total-revenue').text(json.summary.total_revenue);
                    $('#report-title').text(json.summary.date);
                }
                return json.data;
            }
        },
        columns: [
            {data: 'no', name: 'no', orderable: false, searchable: false},
            {data: 'nota', name: 'nota'},
            {data: 'pelanggan', name: 'pelanggan'},
            {data: 'brand', name: 'brand'},
            {data: 'model', name: 'model'},
            {data: 'issue', name: 'issue'},
            {data: 'status', name: 'status'},
            {data: 'price', name: 'price'},
            {data: 'created_at', name: 'created_at'}
        ],
        order: [[8, 'desc']] // Order by created_at descending
    });

    // Filter button click
    $('#filter-btn').click(function() {
        table.ajax.reload();
    });

    // Date change auto filter
    $('#report-date').change(function() {
        table.ajax.reload();
    });
});
</script>
@endpush
