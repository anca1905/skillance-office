<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | S-OS Skillance</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/sos-admin.css') }}?v=2.0">

    <style>
        body {
            background-color: #eef2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            box-shadow: 0 10px 30px rgba(13, 46, 92, 0.15);
            /* Bayangan Navy halus */
            border-top: 5px solid var(--corporate-navy);
            border-radius: 8px;
        }

        .login-header {
            background-color: #fff;
            padding: 2rem 2rem 1rem;
            text-align: center;
        }

        .brand-text {
            color: var(--corporate-navy);
            letter-spacing: 1px;
            font-weight: 800;
            font-size: 1.5rem;
        }

        .form-control {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: var(--corporate-navy);
            box-shadow: 0 0 0 0.2rem rgba(13, 46, 92, 0.15);
        }

        .btn-login {
            background-color: var(--corporate-navy);
            color: #fff;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #082042;
            /* Navy lebih gelap */
            color: var(--corporate-gold);
        }
    </style>
</head>

<body>

    <div class="login-card card">
        <div class="login-header">
            <div class="mb-3">
                <i class="fa-solid fa-building-shield fa-3x text-navy"></i>
            </div>
            <h4 class="brand-text mb-0">SKILLANCE</h4>
            <small class="text-muted fw-bold">OFFICE SYSTEM ACCESS</small>
        </div>

        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger py-2 small">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">EMAIL PEGAWAI</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i
                                class="fa-solid fa-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control border-start-0"
                            placeholder="nama@skillance.id" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i
                                class="fa-solid fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0"
                            placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                    </div>
                    <a href="#" class="small text-decoration-none text-navy fw-bold">Lupa Password?</a>
                </div>

                <button type="submit" class="btn btn-login w-100 rounded-1">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> MASUK SISTEM
                </button>
            </form>
        </div>
        <div class="card-footer bg-light text-center py-3 border-top-0">
            <small class="text-muted" style="font-size: 0.75rem;">
                &copy; 2026 PT Skillance Teknologi. <br>Hanya untuk penggunaan internal.
            </small>
        </div>
    </div>

</body>

</html>
