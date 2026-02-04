<!DOCTYPE html>
<html>

<head>
    <title>Laporan Project Monitoring</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 18pt;
            text-transform: uppercase;
            color: #0d2e5c;
        }

        .header p {
            margin: 2px 0;
            font-size: 9pt;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9pt;
        }

        .badge {
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 8pt;
            color: #000;
            border: 1px solid #ccc;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9pt;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Skillance Office System</h1>
        <p>Laporan Monitoring Project & Pengembangan Sistem</p>
        <p>Tanggal Cetak: {{ date('d F Y, H:i') }} WITA | Oleh: {{ Auth::user()->name }}</p>
    </div>

    <h3 style="margin-bottom: 5px;">Daftar Project Berjalan</h3>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Project</th>
                <th style="width: 20%;">Klien / Instansi</th>
                <th style="width: 15%;">Kontak</th>
                <th style="width: 15%;">Deadline</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $index => $project)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $project->name }}</strong><br>
                        <span style="font-size: 8pt; color: #555;">{{ $project->platform }}</span>
                    </td>
                    <td>
                        {{ $project->client_name }}<br>
                        <span style="font-size: 8pt;">{{ $project->client_institution ?? '-' }}</span>
                    </td>
                    <td>{{ $project->client_contact }}</td>
                    <td>{{ date('d M Y', strtotime($project->deadline)) }}</td>
                    <td>
                        {{ $project->status }}
                    </td>
                    <td>{{ $project->payment_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Kolaka, {{ date('d F Y') }}</p>
        <br><br><br>
        <p><strong>Arsyad</strong><br>Chief Executive Officer</p>
    </div>

</body>

</html>
