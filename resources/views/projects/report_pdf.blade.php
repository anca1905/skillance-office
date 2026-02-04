<!DOCTYPE html>
<html>

<head>
    <title>Laporan Sistem - {{ $project->name }}</title>
    <style>
        @page {
            margin: 0px;
        }

        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* --- COVER PAGE (MODERN STYLE) --- */
        .cover {
            width: 100%;
            height: 100%;
            position: relative;
            background-color: #fff;
            /* Dasar Putih */
            page-break-after: always;
            overflow: hidden;
        }

        /* Hiasan Atas (Orange Bar) */
        .cover-top-bar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 30px;
            background-color: #fca311;
            /* Warna Emas/Orange */
        }

        .cover-top-accent {
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 30px;
            background-color: #14213d;
            /* Warna Navy */
        }

        /* Konten Tengah */
        .cover-content {
            position: absolute;
            top: 100px;
            width: 100%;
            text-align: center;
            z-index: 10;
        }

        .logo-text {
            font-size: 14px;
            letter-spacing: 3px;
            font-weight: bold;
            color: #14213d;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .main-title {
            font-size: 48px;
            font-weight: 900;
            line-height: 1;
            text-transform: uppercase;
            color: #000;
            margin: 0;
            padding: 0 40px;
        }

        .sub-title {
            font-size: 24px;
            font-weight: bold;
            color: #000;
            margin-top: 10px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .badge-year {
            display: inline-block;
            background-color: #fca311;
            color: #14213d;
            padding: 8px 20px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            border-radius: 4px;
        }

        .author {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        /* Gambar Tengah (Hero Image) */
        .hero-image {
            position: absolute;
            top: 400px;
            left: 50%;
            transform: translate(-50%, 0);
            width: 80%;
            height: 350px;
            background-color: #eee;
            /* Placeholder warna abu jika gambar tidak ada */
            border: 5px solid #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 5;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Hiasan Bawah (Abstract Shapes) */
        .shape-bottom-main {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 250px;
            background-color: #fca311;
            clip-path: polygon(0 40%, 100% 0, 100% 100%, 0% 100%);
            /* Membuat miring */
            z-index: 1;
        }

        .shape-bottom-accent {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60%;
            height: 180px;
            background-color: #14213d;
            clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);
            z-index: 2;
        }

        /* Info Kontak di Bawah */
        .contact-info {
            position: absolute;
            bottom: 30px;
            left: 40px;
            z-index: 10;
            color: #14213d;
            font-size: 11px;
            text-align: left;
        }

        .contact-item {
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* --- CONTENT PAGES (Sama seperti sebelumnya) --- */
        .page {
            padding: 50px;
            page-break-after: always;
            background: white;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .chapter-title {
            font-size: 24px;
            font-weight: bold;
            color: #14213d;
            border-bottom: 3px solid #fca311;
            padding-bottom: 10px;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        .content-text {
            text-align: justify;
            line-height: 1.6;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .feature-box {
            margin-bottom: 40px;
            page-break-inside: avoid;
        }

        .feature-title {
            font-size: 16px;
            font-weight: bold;
            color: #14213d;
            margin-bottom: 10px;
            padding-left: 10px;
            border-left: 4px solid #fca311;
        }

        .img-container {
            text-align: center;
            background: #f4f4f4;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        .img-container img {
            max-width: 100%;
            max-height: 350px;
        }

        .desc-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            font-size: 11px;
            line-height: 1.5;
            border: 1px solid #eee;
        }

        .desc-label {
            font-weight: bold;
            color: #14213d;
            display: block;
            margin-bottom: 5px;
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
            text-align: center;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 200px;
            margin: 80px auto 5px auto;
        }
    </style>
</head>

<body>

    <div class="cover">
        <div class="cover-top-bar"></div>
        <div class="cover-top-accent"></div>

        <div class="cover-content">
            <div class="logo-text">SKILLANCE TECHNOLOGY</div>
            <h1 class="main-title">LAPORAN</h1>
            <h1 class="main-title">SISTEM</h1>
            <div class="sub-title">{{ $project->name }}</div>

            <div class="badge-year">PERIODE {{ date('Y') }}</div>
            <div class="author">Disusun Oleh: Skillance Team</div>
        </div>

        @if ($project->cover_image)
            <img src="{{ public_path('storage/' . $project->cover_image) }}" class="hero-image">
        @else
            <div class="hero-image"
                style="background-color: #eee; display: flex; align-items: center; justify-content: center; color: #aaa;">
                <span>No Cover Image</span>
            </div>
        @endif

        <div class="shape-bottom-main"></div>
        <div class="shape-bottom-accent"></div>

        <div class="contact-info">
            <div class="contact-item">Klien: {{ $project->client_name }}</div>
            <div class="contact-item">{{ $project->client_institution ?? 'Project Umum' }}</div>
            <div class="contact-item">Kolaka, {{ date('d F Y') }}</div>
        </div>
    </div>

    <div class="page">
        <div class="chapter-title">BAB I: PENDAHULUAN</div>
        <p class="content-text">
            Dokumen ini disusun sebagai panduan resmi penggunaan sistem informasi yang telah dikembangkan oleh Tim
            Skillance untuk <strong>{{ $project->client_name }}</strong>.
            Tujuan dari sistem ini adalah untuk mempermudah proses manajemen data, meningkatkan efisiensi operasional,
            dan menyediakan pelaporan yang akurat secara real-time.
        </p>
        <p class="content-text">
            Sistem ini dibangun menggunakan teknologi berbasis web terkini yang menjamin keamanan data, kecepatan akses,
            dan kemudahan penggunaan (user-friendly) bagi administrator maupun pengguna umum.
        </p>

        <div class="chapter-title">BAB II: ALUR SISTEM</div>
        <p class="content-text">
            Secara umum, alur kerja sistem ini dirancang sesederhana mungkin untuk meminimalisir kesalahan pengguna:
        </p>
        <ul class="content-text">
            <li><strong>Login:</strong> Pengguna masuk menggunakan kredensial yang valid.</li>
            <li><strong>Input Data:</strong> Pengguna memasukkan data melalui form yang disediakan.</li>
            <li><strong>Pemrosesan:</strong> Sistem memproses data secara otomatis.</li>
            <li><strong>Output:</strong> Sistem menghasilkan laporan atau visualisasi data pada dashboard.</li>
        </ul>
    </div>

    <div class="page">
        <div class="chapter-title">BAB III: FITUR & PENGGUNAAN</div>

        @foreach ($docs as $doc)
            <div class="feature-box">
                <div class="feature-title">{{ $doc->title }}</div>
                <div class="img-container">
                    <img src="{{ public_path('storage/' . $doc->image_path) }}">
                </div>
                <div class="desc-box">
                    <span class="desc-label">Keterangan & Cara Kerja:</span>
                    {!! nl2br(e($doc->description)) !!}
                </div>
            </div>
        @endforeach
    </div>

    <div class="page">
        <div class="chapter-title">BAB IV: PENUTUP</div>
        <p class="content-text">
            Demikian laporan implementasi dan panduan pengguna ini dibuat. Kami berharap sistem ini dapat memberikan
            manfaat maksimal bagi instansi/pengguna. Dukungan teknis akan tetap diberikan sesuai dengan kesepakatan
            pemeliharaan sistem.
        </p>

        <div style="margin-top: 100px; border: 2px solid #14213d; padding: 30px;">
            <h3 style="text-align: center; margin: 0 0 20px 0; color: #14213d;">BERITA ACARA SERAH TERIMA (BAST)</h3>
            <p class="content-text" style="text-align: center;">
                Dengan ini menyatakan bahwa sistem telah diterima dengan baik, diuji coba, dan berfungsi sesuai
                spesifikasi yang disepakati.
            </p>

            <table class="signature-table">
                <tr>
                    <td>
                        <p>Diserahkan Oleh,</p>
                        <strong>CEO Skillance</strong>
                        <div class="signature-line"></div>
                        <strong>Arsyad</strong>
                    </td>
                    <td>
                        <p>Diterima Oleh,</p>
                        <strong>Klien / Perwakilan</strong>
                        <div class="signature-line"></div>
                        <strong>{{ $project->client_name }}</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
