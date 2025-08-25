@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Laporan Mingguan Service</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.cms.Report.index') }}">Laporan</a></li>
                @if(request()->has('from_monthly'))
                    <li class="breadcrumb-item"><a href="{{ route('admin.cms.Report.monthly') }}">Laporan Bulanan</a></li>
                @endif
                <li class="breadcrumb-item active">Laporan Mingguan</li>
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
                                <label for="report-week">Minggu:</label>
                                <input type="week" id="report-week" class="form-control" value="{{ $week }}">
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
        <div class="col-md-4">
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
        <div class="col-md-4">
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
        <div class="col-md-4">
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
            <h6 class="m-0 font-weight-bold text-primary">Ringkasan Service Mingguan - <span id="report-title">Minggu {{ $week }}</span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Hari</th>
                            <th>Total Service</th>
                            <th>Selesai</th>
                            <th>Revenue</th>
                            <th>Aksi</th>
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
</style>
@endpush

@push('js')
<script>
$(function() {
    let table = $('#dataTable').DataTable({
        responsive: true,
        processing: false,
        serverSide: false,
        autoWidth: false,
        pageLength: 7, // 7 days in a week
        paging: false, // Disable pagination for weekly view
        searching: false,
        ordering: false,
        info: false,
        columnDefs: [
            { orderable: false, targets: 5 } // Disable ordering for action column
        ]
    });

    // Load initial data
    loadWeeklyData();

    function loadWeeklyData() {
        let week = $('#report-week').val();
        
        $.ajax({
            url: "{{ route('admin.cms.Report.weekly.data') }}",
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: { week: week },
            success: function(response) {
                // Update summary cards
                if (response.summary) {
                    $('#total-services').text(response.summary.total_services);
                    $('#completed-services').text(response.summary.completed_services);
                    $('#total-revenue').text(response.summary.total_revenue);
                    $('#report-title').text(response.summary.week_period);
                }

                // Clear and populate table
                table.clear();
                if (response.data && response.data.length > 0) {
                    response.data.forEach(function(item) {
                        let fromMonthlyParam = new URLSearchParams(window.location.search).get('from_monthly') ? '&from_monthly=1' : '';
                        let detailButton = `<a href="{{ route('admin.cms.Report.daily') }}?date=${item.raw_date}&from_weekly=1${fromMonthlyParam}" class="btn btn-primary btn-sm">
                                               <i class="fas fa-eye"></i> Lihat Detail
                                           </a>`;
                        
                        table.row.add([
                            item.date,
                            item.day,
                            item.total_services,
                            item.completed,
                            item.revenue,
                            detailButton
                        ]);
                    });
                }
                table.draw();
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
                alert('Error loading weekly report data');
            }
        });
    }

    // Filter button click
    $('#filter-btn').click(function() {
        loadWeeklyData();
    });

    // Week change auto filter
    $('#report-week').change(function() {
        loadWeeklyData();
    });
});
</script>
@endpush
