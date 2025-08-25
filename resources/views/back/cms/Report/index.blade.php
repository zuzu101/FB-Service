@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Laporan & Monitoring Service</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Laporan & Monitoring</li>
            </ol>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="container-fluid">
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h4 class="text-primary" id="total-today">-</h4>
                            <small>Service Hari Ini</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4 class="text-success" id="completed-today">-</h4>
                            <small>Selesai Hari Ini</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4 class="text-warning" id="pending-total">-</h4>
                            <small>Total Menunggu</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4 class="text-info" id="revenue-today">-</h4>
                            <small>Omset Hari Ini</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Laporan Harian -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Laporan Harian
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                Service per Hari
                            </div>
                            <small class="text-muted">Laporan service harian dengan detail transaksi</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.cms.Report.daily') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Mingguan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Laporan Mingguan
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                Service per Minggu
                            </div>
                            <small class="text-muted">Ringkasan service mingguan dan performa</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.cms.Report.weekly') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Bulanan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Laporan Bulanan
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                Service per Bulan
                            </div>
                            <small class="text-muted">Analisis bulanan dan trend service</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.cms.Report.monthly') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Brand -->
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Laporan per Brand
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                Analisis Brand Device
                            </div>
                            <small class="text-muted">Statistik service berdasarkan merk perangkat</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-mobile-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.cms.Report.brand') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-chart-pie"></i> Lihat Analisis
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan per Tipe Service -->
        <div class="col-lg-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Riwayat Semua Transaksi Service
                            </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                Laporan Lengkap Transaksi 
                            </div>
                            <small class="text-muted">Riwayat lengkap semua transaksi service dengan filter advanced dan export data</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-history fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.cms.Report.history') }}" class="btn btn-dark btn-sm">
                            <i class="fas fa-chart-pie"></i> Lihat Analisis
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Riwayat Semua Transaksi -->
        
    </div>

    <!-- Tabel -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Lengkap Transaksi Service</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="historyTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nota</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>SN</th>
                            <th>Masalah</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th>Target Selesai</th>
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
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    .border-left-danger {
        border-left: 0.25rem solid #e74a3b !important;
    }
</style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    // Load quick stats
    loadQuickStats();
    
    function loadQuickStats() {
        // Get today's data
        $.ajax({
            url: "{{ route('admin.cms.Report.daily.data') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                date: new Date().toISOString().split('T')[0]
            },
            success: function(response) {
                if (response.summary) {
                    $('#total-today').text(response.summary.total_services);
                    $('#completed-today').text(response.summary.completed_services);
                    $('#pending-total').text(response.summary.pending_services);
                    $('#revenue-today').text(response.summary.total_revenue);
                }
            },
            error: function() {
                console.log('Failed to load quick stats');
            }
        });
    }
});
</script>
@endpush

@push('js')
<script>
$(function() {
    let table = $('#historyTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        autoWidth: false,
        pageLength: 10,
        scrollX: true,
        ajax: {
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ route('admin.cms.Report.history.data') }}",
            dataType: "json",
            type: "POST",
            data: function(d) {
                return {
                    status: $('#status-filter').val(),
                    brand: $('#brand-filter').val(),
                    date_from: $('#date-from').val(),
                    date_to: $('#date-to').val(),
                    _token: '{{ csrf_token() }}'
                };
            },
            dataSrc: function(json) {
                console.log('Response data:', json); // Debug line
                // Update summary cards
                if (json.summary) {
                    $('#total-transactions').text(json.summary.total_transactions);
                    $('#completed-transactions').text(json.summary.completed_transactions);
                    $('#pending-transactions').text(json.summary.pending_transactions);
                    $('#total-revenue').text(json.summary.total_revenue);
                }
                console.log('Data array:', json.data); // Debug line
                return json.data;
            }
        },
        columns: [
            {data: 'no', name: 'no', orderable: false, searchable: false, width: '50px'},
            {data: 'nota_number', name: 'nota_number'},
            {data: 'created_date', name: 'created_date'},
            {data: 'pelanggan', name: 'pelanggan'},
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
            {data: 'brand', name: 'brand'},
            {data: 'model', name: 'model'},
            {data: 'serial_number', name: 'serial_number'},
            {data: 'reported_issue', name: 'reported_issue', 
             render: function(data) {
                 return data.length > 30 ? data.substring(0, 30) + '...' : data;
             }},
            {data: 'status', name: 'status', orderable: false},
            {data: 'price', name: 'price'},
            {data: 'complete_in', name: 'complete_in'}
        ],
        columnDefs: [
            {
                targets: [10], // Status column index
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).html(cellData);
                }
            }
        ]
    });
});
</script>
@endpush
