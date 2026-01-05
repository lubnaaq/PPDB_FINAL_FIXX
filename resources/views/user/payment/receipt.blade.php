<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Pembayaran - {{ $payment->id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .receipt-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .school-name {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .receipt-body {
            margin-bottom: 20px;
        }
        .row {
            display: flex;
            margin-bottom: 10px;
        }
        .label {
            width: 200px;
            font-weight: bold;
        }
        .value {
            flex: 1;
        }
        .receipt-footer {
            margin-top: 40px;
            text-align: right;
        }
        .signature-box {
            display: inline-block;
            text-align: center;
            width: 200px;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
        }
        .signature-image {
            max-width: 150px;
            height: auto;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: sans-serif;
        }
        @media print {
            .print-button {
                display: none;
            }
            body {
                border: 1px solid #000;
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">Cetak Kuitansi</button>

    <div class="receipt-header">
        <div class="receipt-title">KUITANSI PEMBAYARAN</div>
        <div class="school-name">SMK ANTARTIKA 1 SIDOARJO</div>
        <div>Jalan Raya Siwalan Panji, Bedrek, Siwalanpanji, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61252</div>
    </div>

    <div class="receipt-body">
        <div class="row">
            <div class="label">No. Kuitansi</div>
            <div class="value">: #{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>
        <div class="row">
            <div class="label">Tanggal Pembayaran</div>
            <div class="value">: {{ \Carbon\Carbon::parse($payment->payment_date)->format('d F Y') }}</div>
        </div>
        <div class="row">
            <div class="label">Telah Terima Dari</div>
            <div class="value">: {{ $payment->user->biodata->nama_lengkap ?? $payment->user->name }}</div>
        </div>
        <div class="row">
            <div class="label">Untuk Pembayaran</div>
            <div class="value">: Biaya Pendaftaran PPDB Tahun {{ date('Y') }}</div>
        </div>
        <div class="row">
            <div class="label">Jumlah Uang</div>
            <div class="value">: Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
        </div>
        <div class="row">
            <div class="label">Terbilang</div>
            <div class="value" style="font-style: italic; text-transform: capitalize;">: {{ \App\Helpers\CurrencyHelper::numberToWords($payment->amount) }} Rupiah</div>
        </div>
        <div class="row">
            <div class="label">Status</div>
            <div class="value">: <strong>LUNAS / TERVERIFIKASI</strong></div>
        </div>
    </div>

    <div class="receipt-footer">
        <div class="signature-box">
            <div>{{ \Carbon\Carbon::now()->format('d F Y') }}</div>
            <div>Kepala Sekolah,</div>
            <img src="{{ asset('assets/images/user/WhatsApp_Image_2026-01-05_at_20.02.09-removebg-preview.png') }}" alt="Tanda Tangan" class="signature-image">
            <div class="signature-line">AKHMAD NASIRUDIN</div>
        </div>
    </div>
</body>
</html>