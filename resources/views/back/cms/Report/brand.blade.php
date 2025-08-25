@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Laporan per Brand Device</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.cms.Report.index') }}">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Brand</li>
            </ol>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="container-fluid">
    <!-- Filter & Export Options -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="brand-filter">Filter Brand:</label>
                            <select name="brand_filter" id="brand-filter" class="form-control">
                                <option value="">Semua Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand }}">{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8 d-flex align-items-end">
                            <button type="button" id="refresh-data" class="btn btn-info mr-2">
                                <i class="fas fa-sync"></i> Refresh Data
                            </button>
                            <button type="button" id="reset-filter" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Reset Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Brand Statistics -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Statistik Service per Brand Device</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="brandTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Brand</th>
                            <th>Total Service</th>
                            <th>Selesai</th>
                            <th>Pending</th>
                            <th>Tingkat Penyelesaian</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Brand Chart -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Distribusi Service per Brand</h6>
                </div>
                <div class="card-body">
                    <canvas id="brandChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue per Brand</h6>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let brandChart, revenueChart;

$(function() {
    let table = $('#brandTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 25,
        ajax: {
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ route('admin.cms.Report.brand.data') }}",
            dataType: "json",
            type: "POST",
            data: function(d) {
                d.brand_filter = $('#brand-filter').val();
            },
            dataSrc: function(json) {
                return json.data;
            }
        },
        columns: [
            {data: 'no', name: 'no', orderable: false, searchable: false},
            {data: 'brand', name: 'brand'},
            {data: 'total_services', name: 'total_services'},
            {data: 'completed', name: 'completed'},
            {data: 'pending', name: 'pending'},
            {data: 'completion_rate', name: 'completion_rate'},
            {data: 'revenue', name: 'revenue'}
        ],
        order: [[2, 'desc']] // Order by total_services descending
    });

    // Handle filter change
    $('#brand-filter').on('change', function() {
        table.ajax.reload();
    });

    $('#refresh-data').click(function() {
        table.ajax.reload();
        // Reload charts with all data (no filter)
        loadChartData();
    });

    // Reset filter
    $('#reset-filter').click(function() {
        $('#brand-filter').val('');
        table.ajax.reload();
    });

    // Initialize charts
    initializeCharts();
    
    // Load chart data on page load
    loadChartData();

    function initializeCharts() {
        // Brand Distribution Chart
        const brandCtx = document.getElementById('brandChart').getContext('2d');
        brandChart = new Chart(brandCtx, {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                        '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF',
                        '#4BC0C0', '#FF6384'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Revenue (Rp)',
                    data: [],
                    backgroundColor: '#36A2EB'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

    // Load chart data separately (without filter)
    function loadChartData() {
        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ route('admin.cms.Report.brand.data') }}",
            type: "POST",
            dataType: "json",
            success: function(response) {
                updateCharts(response.data);
            }
        });
    }

    function updateCharts(data) {
        if (!data || data.length === 0) return;

        // Update Brand Chart
        const brandLabels = data.map(item => item.brand);
        const brandData = data.map(item => item.total_services);
        
        brandChart.data.labels = brandLabels;
        brandChart.data.datasets[0].data = brandData;
        brandChart.update();

        // Update Revenue Chart
        const revenueData = data.map(item => {
            // Convert revenue string to number (remove "Rp " and dots)
            return parseFloat(item.revenue.replace(/[Rp\s.]/g, '')) || 0;
        });

        revenueChart.data.labels = brandLabels;
        revenueChart.data.datasets[0].data = revenueData;
        revenueChart.update();
    }
});
</script>
@endpush
