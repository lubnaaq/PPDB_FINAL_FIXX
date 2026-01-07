<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi Pembayaran - {{ $payment->id }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            padding: 40px;
            max-width: 210mm; /* A4 width */
            margin: 0 auto;
            color: #000;
            background-color: white;
        }
        .header-table {
            width: 100%;
            border-bottom: 3px double #000;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }
        .header-logo {
            width: 15%;
            text-align: center;
        }
        .header-logo img {
            max-width: 90px;
            height: auto;
        }
        .header-text {
            width: 85%;
            text-align: center;
        }
        .header-text h3 {
            margin: 0;
            font-size: 14pt;
            font-weight: normal;
        }
        .header-text h2 {
            margin: 5px 0;
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header-text p {
            margin: 2px 0;
            font-size: 10pt;
        }
        
        .receipt-title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            margin: 30px 0;
            text-decoration: underline;
            text-transform: uppercase;
        }
        
        .content-table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 12pt;
            border-collapse: collapse;
        }
        .content-table td {
            padding: 8px 5px;
            vertical-align: top;
        }
        .label-col {
            width: 200px;
        }
        .colon-col {
            width: 20px;
            text-align: center;
        }
        
        .amount-box {
            font-weight: bold;
            font-size: 14pt;
            background-color: #e9e9e9;
            padding: 5px 10px;
            display: inline-block;
            border: 1px solid #999;
        }

        .terbilang-text {
            font-style: italic;
            margin-top: 5px;
            font-weight: bold;
        }

        .footer-section {
            margin-top: 60px;
            width: 100%;
            display: table;
        }
        
        .signature-section {
            display: table-cell;
            width: 40%;
            text-align: center;
            vertical-align: top;
            float: right;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: sans-serif;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        @media print {
            .print-button {
                display: none;
            }
            body {
                padding: 0;
                margin: 20px;
            }
            .amount-box {
                background-color: transparent !important;
                border: 2px solid #000;
            }
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:8px; vertical-align:text-bottom;">
            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
        </svg>
        Cetak Kuitansi
    </button>

    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="https://smkantartika1sda.sch.id/wp-content/uploads/2025/05/cropped-ANT-LG.png" alt="Logo">
            </td>
            <td class="header-text">
                <h3>PEMERINTAH PROVINSI JAWA TIMUR</h3>
                <h3>DINAS PENDIDIKAN</h3>
                <h2>SMK ANTARTIKA 1 SIDOARJO</h2>
                <p>Jalan Raya Siwalan Panji, Bedrek, Siwalanpanji, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61252</p>
                <p>Website: www.smkantartika1.sch.id | Email: info@smkantartika1.sch.id</p>
            </td>
        </tr>
    </table>

    <div class="receipt-title">BUKTI PEMBAYARAN</div>

    <table class="content-table">
        <tr>
            <td class="label-col">No. Referensi</td>
            <td class="colon-col">:</td>
            <td><strong>#{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</strong></td>
        </tr>
         <tr>
            <td class="label-col">Tanggal</td>
            <td class="colon-col">:</td>
            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label-col">Telah terima dari</td>
            <td class="colon-col">:</td>
            <td>{{ strtoupper($payment->user->name ?? 'Peserta Didik') }}</td>
        </tr>
        <tr>
            <td class="label-col">Guna Pembayaran</td>
            <td class="colon-col">:</td>
            <td>{{ $payment->notes ?? 'Pembayaran PPDB' }}</td>
        </tr>
        <tr>
            <td class="label-col">Sejumlah Uang</td>
            <td class="colon-col">:</td>
            <td>
                <div class="amount-box">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                <div class="terbilang-text">({{ ucwords(\App\Helpers\CurrencyHelper::numberToWords($payment->amount)) }} Rupiah)</div>
            </td>
        </tr>
        <tr>
            <td class="label-col">Status</td>
            <td class="colon-col">:</td>
            <td>LUNAS / TERVERIFIKASI</td>
        </tr>
    </table>

    <div class="footer-section">
        <div class="signature-section">
            <p>Sidoarjo, {{ \Carbon\Carbon::parse($payment->updated_at ?? now())->translatedFormat('d F Y') }}</p>
            <p>Panitia PPDB / Bendahara,</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">ADMINISTRASI KEUANGAN</p>
        </div>
    </div>

</body>
</html>