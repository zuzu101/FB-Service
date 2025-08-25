@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Preview Data Service</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.cms.Status.index') }}">Status</a>
                    </li>
                    <li class="breadcrumb-item active">Preview</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Transaksi Service</h5>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nota_number">Nomor Nota</label>
                        <input type="text" name="nota_number" value="{{ $status->nota_number }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="status">Status</label>
                        <input type="text" name="status" value="{{ $status->status }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="pelanggan">Nama Pelanggan</label>
                        <input type="text" name="pelanggan" value="{{ $status->customers->name ?? 'N/A' }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone">Telepon</label>
                        <input type="text" name="phone" value="{{ $status->customers->phone ?? 'N/A' }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="{{ $status->customers->email ?? 'N/A' }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="address">Alamat</label>
                        <input type="text" name="address" value="{{ $status->customers->address ?? 'N/A' }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" value="{{ $status->brand }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="model">Model</label>
                        <input type="text" name="model" value="{{ $status->model }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="serial_number">Serial Number</label>
                        <input type="text" name="serial_number" value="{{ $status->serial_number }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="price">Harga</label>
                        <input type="text" name="price" value="Rp. {{ number_format($status->price, 0, ',', '.') }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="created_at">Tanggal Masuk</label>
                        <input type="text" name="created_at" value="{{ $status->created_at->format('d M Y H:i') }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="complete_in">Target Selesai</label>
                        <input type="text" name="complete_in" value="{{ $status->complete_in ? \Carbon\Carbon::parse($status->complete_in)->format('d M Y') : 'Belum ditentukan' }}" class="form-control" readonly>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="reported_issue">Masalah yang Dilaporkan</label>
                        <textarea name="reported_issue" class="form-control" rows="3" readonly>{{ $status->reported_issue }}</textarea>
                    </div>

                    @if($status->technician_note)
                    <div class="form-group col-md-12">
                        <label for="technician_note">Catatan Teknisi</label>
                        <textarea name="technician_note" class="form-control" rows="3" readonly>{{ $status->technician_note }}</textarea>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.cms.Status.index') }}" class="btn btn-secondary">
                    <i class="la la-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
