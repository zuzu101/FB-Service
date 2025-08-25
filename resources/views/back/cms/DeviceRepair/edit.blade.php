@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Device</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.cms.DeviceRepair.index') }}">Device</a>
                    </li>
                    <li class="breadcrumb-item active">Perbaharui Device</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form method="POST" action="{{ route('admin.cms.DeviceRepair.update', $deviceRepair) }}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @method('PATCH')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customer_id">Pelanggan</label>
                            <select name="customer_id" id="customer_id" class="form-control select2" required>
                                <option value="">Ketik nama pelanggan...</option>
                                @foreach(\App\Models\Cms\Customers::all() as $customer)
                                    <option value="{{ $customer->id }}" {{ $deviceRepair->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="brand">Merk Laptop</label>
                            <input type="text" name="brand" value="{{ $deviceRepair->brand }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="model">Model</label>
                            <input type="text" name="model" value="{{ $deviceRepair->model }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="reported_issue">Kerusakan Yang Dilaporkan</label>
                            <input type="text" name="reported_issue" value="{{ $deviceRepair->reported_issue }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="serial_number">Serial Number Laptop</label>
                            <input type="text" name="serial_number" value="{{ $deviceRepair->serial_number }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="technician_note">Catatan Teknisi</label>
                            <textarea name="technician_note" class="form-control">{{ $deviceRepair->technician_note }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Perangkat Baru Masuk" {{ $deviceRepair->status == 'Perangkat Baru Masuk' ? 'selected' : '' }}>Perangkat Baru Masuk</option>
                                <option value="Sedang Diperbaiki" {{ $deviceRepair->status == 'Sedang Diperbaiki' ? 'selected' : '' }}>Sedang Diperbaiki</option>
                                <option value="Selesai" {{ $deviceRepair->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="price">Estimasi Biaya</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="price_display" id="price_display" class="form-control" 
                                       value="{{ $deviceRepair->price ? number_format((float)$deviceRepair->price, 0, ',', '.') : '' }}" 
                                       placeholder="500.000">
                                <input type="hidden" name="price" id="price_hidden" value="{{ $deviceRepair->price }}">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="complete_in">Target Selesai</label>
                            <input type="date" name="complete_in" value="{{ $deviceRepair->complete_in ? $deviceRepair->complete_in->format('Y-m-d') : '' }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">
                        <i class="la la-check-square-o"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
        // Initialize Select2 for pelanggan field
        $('#customer_id').select2({
            placeholder: 'Ketik nama pelanggan...',
            allowClear: true,
            width: '100%',
            theme: 'bootstrap-5'
        });

        // Format currency input
        $('#price_display').on('input', function() {
            let value = this.value.replace(/[^\d]/g, ''); // Remove non-digits
            let formattedValue = '';
            
            if (value) {
                // Format with thousands separator
                formattedValue = parseInt(value).toLocaleString('id-ID');
                $('#price_hidden').val(value); // Store raw number for backend
            } else {
                $('#price_hidden').val('');
            }
            
            this.value = formattedValue;
        });

        // Handle paste event
        $('#price_display').on('paste', function(e) {
            setTimeout(() => {
                $(this).trigger('input');
            }, 1);
        });

        $('#form-validation').validate({
            rules: {},
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })

        $('#descriptionInput').summernote({
            height: 300, // Change the height here
        })
    })
  </script>
@endpush
