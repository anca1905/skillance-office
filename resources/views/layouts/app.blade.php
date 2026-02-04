<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S-OS | Skillance Office System</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/sos-admin.css') }}">
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <nav class="sidebar d-flex flex-column" id="sidebar">
        <div class="sidebar-brand d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold m-0 tracking-wide">SKILLANCE</h4>
                <small class="text-white-50" style="font-size: 0.75rem;">OFFICE SYSTEM v2.0</small>
            </div>
            <button class="btn text-white d-lg-none" id="closeSidebar">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <ul class="nav flex-column mt-4">
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('marketing.index') }}"
                    class="nav-link {{ request()->routeIs('marketing.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bullhorn"></i> Marketing (Leads)
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('projects.index') }}"
                    class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-list-check"></i> Project Monitoring
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('finance.*') || request()->routeIs('invoices.*') ? 'active' : '' }}"
                    href="#financeSubmenu" data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ request()->routeIs('finance.*') || request()->routeIs('invoices.*') ? 'true' : 'false' }}"
                    aria-controls="financeSubmenu">
                    <span>
                        <i class="fa-solid fa-coins"></i> Keuangan
                    </span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.7rem;"></i>
                </a>

                <div class="collapse {{ request()->routeIs('finance.*') || request()->routeIs('invoices.*') ? 'show' : '' }}"
                    id="financeSubmenu">
                    <ul class="nav flex-column bg-opacity-10 bg-black rounded-2 mt-1 ms-2">

                        <li class="nav-item">
                            <a href="{{ route('finance.index') }}"
                                class="nav-link ps-4 {{ request()->routeIs('finance.index') ? 'text-gold fw-bold' : '' }}"
                                style="font-size: 0.85rem;">
                                <i class="fa-solid fa-wallet me-2"></i> Cashflow
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('invoices.index') }}"
                                class="nav-link ps-4 {{ request()->routeIs('invoices.*') ? 'text-gold fw-bold' : '' }}"
                                style="font-size: 0.85rem;">
                                <i class="fa-solid fa-file-invoice-dollar me-2"></i> Invoice / Tagihan
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-users"></i> HRD
                </a>
            </li>
        </ul>

        <div class="mt-auto p-4 border-top border-secondary">
            <small class="text-white-50">&copy; 2026 Skillance Corp.</small>
        </div>
    </nav>

    <header class="topbar">
        <div class="d-flex align-items-center">
            <button class="btn btn-light me-3 d-lg-none border" id="toggleSidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h5 class="m-0 text-navy fw-bold">@yield('page-title', 'Overview')</h5>
        </div>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1"
                data-bs-toggle="dropdown" aria-expanded="false">
                <div class="text-end lh-1 me-2 d-none d-sm-block">
                    <div class="fw-bold text-navy">{{ Auth::user()->name ?? 'Guest' }}</div>
                    <small class="text-success" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-circle fa-2xs me-1"></i>Online
                    </small>
                </div>
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border"
                    style="width: 40px; height: 40px;">
                    <i class="fa-solid fa-user text-secondary"></i>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser1">
                <li>
                    <h6 class="dropdown-header">Menu Pengguna</h6>
                </li>
                <li><a class="dropdown-item small" href="#"><i class="fa-solid fa-user-gear me-2"></i>Edit
                        Profil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item small text-danger fw-bold">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Keluar Sistem
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <main class="main-content p-10">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const btnToggle = document.getElementById('toggleSidebar');
        const btnClose = document.getElementById('closeSidebar');

        function toggleMenu() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        btnToggle.addEventListener('click', toggleMenu);
        btnClose.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu); // Tutup jika klik di luar sidebar
    </script>
</body>

</html>
