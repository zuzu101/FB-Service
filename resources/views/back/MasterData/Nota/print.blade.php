<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Service - {{ $notaNumber }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .logo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .shop-info {
            font-size: 11px;
            color: #666;
        }
        .nota-number {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .info-section {
            margin-bottom: 15px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .label {
            font-weight: bold;
            width: 40%;
        }
        .value {
            width: 60%;
        }
        .device-section {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 15px 0;
            background-color: #f9f9f9;
        }
        .price-section {
            border-top: 1px solid #000;
            padding-top: 10px;
            margin-top: 15px;
            text-align: right;
        }
        .total-price {
            font-size: 16px;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .signature {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .sign-box {
            text-align: center;
            width: 45%;
        }
        .sign-line {
            border-bottom: 1px solid #000;
            margin: 30px 0 5px 0;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">TOKO SERVICE ELEKTRONIK</div>
        <div class="shop-info">
            Jl. Contoh No. 123, Kota Contoh<br>
            Telp: 021-1234567 | WA: 081234567890<br>
            Email: service@toko.com
        </div>
    </div>

    <div class="nota-number">
        NOTA SERVICE: {{ $notaNumber }}
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="label">Nama Pelanggan:</span>
            <span class="value">{{ $deviceRepair->customers->name ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Tanggal Masuk:</span>
            <span class="value">{{ $deviceRepair->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Target Selesai:</span>
            <span class="value">{{ $deviceRepair->complete_in ? $deviceRepair->complete_in->format('d/m/Y') : '-' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Status:</span>
            <span class="value">{{ $deviceRepair->status ?? 'Perangkat Baru Masuk' }}</span>
        </div>
    </div>

    <div class="device-section">
        <h4 style="margin: 0 0 10px 0; border-bottom: 1px solid #ccc; padding-bottom: 5px;">DATA PERANGKAT</h4>
        <div class="info-row">
            <span class="label">Merek:</span>
            <span class="value">{{ $deviceRepair->brand }}</span>
        </div>
        <div class="info-row">
            <span class="label">Model/Series:</span>
            <span class="value">{{ $deviceRepair->model }}</span>
        </div>
        <div class="info-row">
            <span class="label">Serial Number:</span>
            <span class="value">{{ $deviceRepair->serial_number }}</span>
        </div>
        <div class="info-row">
            <span class="label">Kerusakan:</span>
            <span class="value">{{ $deviceRepair->reported_issue }}</span>
        </div>
        @if($deviceRepair->technician_note)
        <div class="info-row">
            <span class="label">Catatan Teknisi:</span>
            <span class="value">{{ $deviceRepair->technician_note }}</span>
        </div>
        @endif
    </div>

    <div class="price-section">
        <div class="info-row">
            <span class="label">Estimasi Biaya Service:</span>
            <span class="value total-price">
                {{ $deviceRepair->price ? 'Rp ' . number_format($deviceRepair->price, 0, ',', '.') : 'Belum ditentukan' }}
            </span>
        </div>
    </div>

    <div class="signature">
        <div class="sign-box">
            <div>Pelanggan</div>
            <div class="sign-line"></div>
            <div>({{ $deviceRepair->customers->name ?? '.....................' }})</div>
        </div>
        <div class="sign-box">
            <div>Teknisi</div>
            <div class="sign-line"></div>
            <div>(......................)</div>
        </div>
    </div>

    <div class="footer">
        <p><strong>SYARAT & KETENTUAN:</strong></p>
        <p>1. Barang yang sudah diperbaiki tidak dapat dikembalikan<br>
        2. Garansi service 30 hari untuk kerusakan yang sama<br>
        3. Barang tidak diambil dalam 30 hari, tidak menjadi tanggung jawab kami<br>
        4. Pembayaran dilakukan saat pengambilan barang</p>
        <br>
        <p><em>Terima kasih atas kepercayaan Anda menggunakan jasa service kami</em></p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
