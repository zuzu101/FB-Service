@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Nota</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Nota</li>
            </ol>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="card">
    <article class="card-header">
        <div class="float-right">
            <span class="text-muted">Cetak Nota / Struk Service</span>
        </div>
    </article>
    <article class="card-body">
        <table class="table table-striped table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Nota</th>
                    <th>Pelanggan</th>
                    <th>Perangkat</th>
                    <th>Kerusakan</th>
                    <th>Status</th>
                    <th>Estimasi Biaya</th>
                    <th>Tanggal Masuk</th>
                    <th>Target Selesai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </article>
</section>
@endsection

@push('js')
<script>
    $(function() {
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            pagingType: "simple_numbers",
            ajax: {
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: "{{ route('admin.cms.Nota.data') }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                { data: 'no', name: 'no', className: "text-center align-middle" },
                { data: 'nota_number', name: 'nota_number', className: "align-middle" },
                { data: 'pelanggan_name', name: 'pelanggan_name', className: "align-middle" },
                { data: 'device_info', name: 'device_info', className: "align-middle" },
                { data: 'reported_issue', name: 'reported_issue', className: "align-middle" },
                { data: 'status', name: 'status', className: "align-middle" },
                { data: 'price_formatted', name: 'price_formatted', className: "align-middle text-right" },
                { data: 'created_date', name: 'created_date', className: "align-middle text-center" },
                { data: 'complete_date', name: 'complete_date', className: "align-middle text-center" },
                { data: 'actions', name: 'actions', className: "align-middle text-center", sortable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
