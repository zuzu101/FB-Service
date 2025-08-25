<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Service - {{ $notaNumber }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            margin: 0;
            padding: 15px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .logo {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 3px;
        }
        .shop-info {
            font-size: 9px;
            color: #666;
        }
        .nota-number {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        .info-section {
            margin-bottom: 12px;
        }
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 3px;
        }
        .label {
            display: table-cell;
            font-weight: bold;
            width: 35%;
            vertical-align: top;
        }
        .colon {
            display: table-cell;
            width: 5%;
        }
        .value {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }
        .device-section {
            border: 1px solid #ccc;
            padding: 8px;
            margin: 12px 0;
            background-color: #f9f9f9;
        }
        .device-title {
            margin: 0 0 8px 0;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
            font-size: 10px;
        }
        .price-section {
            border-top: 1px solid #000;
            padding-top: 8px;
            margin-top: 12px;
            text-align: right;
        }
        .total-price {
            font-size: 14px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 8px;
            text-align: center;
            font-size: 8px;
            color: #666;
        }
        .signature {
            margin-top: 20px;
            display: table;
            width: 100%;
        }
        .sign-box {
            display: table-cell;
            text-align: center;
            width: 50%;
            vertical-align: top;
        }
        .sign-line {
            border-bottom: 1px solid #000;
            margin: 20px 5px 3px 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">TOKO SERVICE ELEKTRONIK</div>
        <div class="shop-info">
            Jl. Contoh No. 123, Kota Contoh<br>
            Telp: 021-1234567 | WA: 081234567890
        </div>
    </div>

    <div class="nota-number">
        NOTA: {{ $notaNumber }}
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="label">Pelanggan</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->customers->name ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Tanggal Masuk</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Target Selesai</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->complete_in ? $deviceRepair->complete_in->format('d/m/Y') : '-' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Status</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->status ?? 'Perangkat Baru Masuk' }}</span>
        </div>
    </div>

    <div class="device-section">
        <div class="device-title">DATA PERANGKAT</div>
        <div class="info-row">
            <span class="label">Merek</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->brand }}</span>
        </div>
        <div class="info-row">
            <span class="label">Model</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->model }}</span>
        </div>
        <div class="info-row">
            <span class="label">S/N</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->serial_number }}</span>
        </div>
        <div class="info-row">
            <span class="label">Kerusakan</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->reported_issue }}</span>
        </div>
        @if($deviceRepair->technician_note)
        <div class="info-row">
            <span class="label">Catatan</span>
            <span class="colon">:</span>
            <span class="value">{{ $deviceRepair->technician_note }}</span>
        </div>
        @endif
    </div>

    <div class="price-section">
        <div class="info-row">
            <span class="label">Estimasi Biaya</span>
            <span class="colon">:</span>
            <span class="value total-price">
                {{ $deviceRepair->price ? 'Rp ' . number_format($deviceRepair->price, 0, ',', '.') : 'TBD' }}
            </span>
        </div>
    </div>

    <div class="signature">
        <div class="sign-box">
            <div>Pelanggan</div>
            <div class="sign-line"></div>
            <div style="font-size: 8px;">({{ $deviceRepair->customers->name ?? '........................' }})</div>
        </div>
        <div class="sign-box">
            <div>Teknisi</div>
            <div class="sign-line"></div>
            <div style="font-size: 8px;">(.........................)</div>
        </div>
    </div>

    <div class="footer">
        <strong>SYARAT & KETENTUAN:</strong><br>
        1. Barang tidak diambil 30 hari, bukan tanggung jawab kami<br>
        2. Garansi service 30 hari untuk kerusakan yang sama<br>
        3. Pembayaran saat pengambilan barang<br><br>
        <em>Terima kasih atas kepercayaan Anda</em>
    </div>
</body>
</html>
