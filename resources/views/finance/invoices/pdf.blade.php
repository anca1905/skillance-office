<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            font-size: 14px;
        }

        .header-container {
            margin-bottom: 40px;
            overflow: hidden;
        }

        .company-info {
            float: left;
        }

        .invoice-title {
            float: right;
            text-align: right;
        }

        h1 {
            margin: 0;
            color: #0d2e5c;
            font-size: 32px;
            text-transform: uppercase;
        }

        .text-navy {
            color: #0d2e5c;
            font-weight: bold;
        }

        .bill-to {
            margin-bottom: 30px;
            border-left: 4px solid #c49a02;
            padding-left: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th {
            background: #0d2e5c;
            color: white;
            padding: 10px;
            text-align: left;
            text-transform: uppercase;
            font-size: 12px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .total-section {
            float: right;
            width: 40%;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #0d2e5c;
            border-top: 2px solid #0d2e5c;
            padding-top: 10px;
            margin-top: 5px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <div class="header-container">
        <div class="company-info">
            <h2 style="margin:0; color:#0d2e5c;">SKILLANCE</h2>
            <p style="margin:5px 0; font-size:12px;">
                Jasa Pembuatan Website & Aplikasi<br>
                Kolaka, Sulawesi Tenggara<br>
                Email: finance@skillance.id | WA: +62 812-3456-7890
            </p>
        </div>
        <div class="invoice-title">
            <h1>INVOICE</h1>
            <p>No: {{ $invoice->invoice_number }}</p>
            <p>Tanggal: {{ date('d M Y', strtotime($invoice->invoice_date)) }}</p>
            @if ($invoice->status == 'PAID')
                <div
                    style="color: green; font-weight: bold; border: 2px solid green; display: inline-block; padding: 5px 10px; margin-top: 10px; transform: rotate(-10deg);">
                    LUNAS</div>
            @else
                <div style="color: red; font-weight: bold; margin-top: 5px;">Jatuh Tempo:
                    {{ date('d M Y', strtotime($invoice->due_date)) }}</div>
            @endif
        </div>
    </div>

    <div class="bill-to">
        <small style="text-transform: uppercase; color: #888;">Tagihan Kepada:</small><br>
        <strong style="font-size: 16px;">{{ $invoice->client_name }}</strong><br>
        @if ($invoice->client_address)
            <span>{{ $invoice->client_address }}</span>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 50%">Deskripsi</th>
                <th style="width: 10%; text-align: center;">Qty</th>
                <th style="width: 20%; text-align: right;">Harga</th>
                <th style="width: 20%; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td style="text-align: center;">{{ $item->qty }}</td>
                    <td style="text-align: right;">{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td style="text-align: right; font-weight: bold;">{{ number_format($item->total, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <span>Subtotal</span>
            <span>Rp {{ number_format($invoice->items->sum('total'), 0, ',', '.') }}</span>
        </div>
        <div class="total-row grand-total">
            <span>TOTAL TAGIHAN</span>
            <span>Rp {{ number_format($invoice->items->sum('total'), 0, ',', '.') }}</span>
        </div>

        <br>
        <p style="font-size: 12px; margin-bottom: 5px;"><strong>Metode Pembayaran:</strong></p>
        <p style="font-size: 12px; margin: 0;">Bank BRI (Skillance Corp)<br>No. Rek: 1234-5678-9000</p>
    </div>

    <div class="footer">
        Terima kasih atas kepercayaan Anda kepada Skillance Technology.<br>
        Invoice ini sah dan diproses oleh komputer, tidak memerlukan tanda tangan basah.
    </div>

</body>

</html>
