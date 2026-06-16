<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #011932 0%, #1a2744 100%);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: 0.3s;
        }

        .sidebar-show {
            left: 0;
        }

        .sidebar.closed {
            left: -240px;
        }

        .sidebar-brand {
            padding: 24px 20px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand .brand-title {
            color: white;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .sidebar-brand .brand-sub {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.72rem;
            margin-top: 2px;
        }

        .sidebar-menu {
            padding: 12px 12px;
            flex: 1;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.55);
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 2px;
            font-size: 0.875rem;
            transition: all 0.15s;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.07);
            color: rgba(255, 255, 255, 0.9);
        }

        .sidebar-menu a.active {
            background: #3b82f6;
            color: white;
            font-weight: 500;
        }

        .sidebar-menu a i {
            font-size: 1rem;
            width: 18px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-footer form button {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.55);
            background: none;
            border: none;
            padding: 10px 14px;
            border-radius: 8px;
            width: 100%;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.15s;
        }

        .sidebar-footer form button:hover {
            background: rgba(255, 255, 255, 0.07);
            color: white;
        }

        /* Main */
        .main-wrapper {
            margin-left: 0px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: 0.3s;
        }

        .main-wrapper.full {
            margin-left: 0;
        }

        /* Topbar */
        .topbar {
            background: white;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 1100;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-title {
            font-weight: 600;
            font-size: 1rem;
            color: #1e293b;
        }

        .hamburger {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #64748b;
            cursor: pointer;
            position: relative;
            z-index: 1200;
            padding: 4px;
        }

        .search-wrap {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 24px;
            padding: 8px 16px;
            gap: 8px;
            width: 280px;
        }

        .search-wrap i {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .search-wrap input {
            background: none;
            border: none;
            outline: none;
            font-size: 0.85rem;
            color: #475569;
            width: 100%;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notif-btn {
            position: relative;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #64748b;
            cursor: pointer;
            padding: 4px;
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: white;
            font-size: 9px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .admin-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .admin-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e293b;
        }

        .admin-role {
            font-size: 0.72rem;
            color: #94a3b8;
        }

        /* Content */
        .main-content {
            padding: 28px;
            flex: 1;
        }

        /* Footer */
        .main-footer {
            text-align: center;
            padding: 16px;
            font-size: 0.78rem;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            background: white;
        }

        /* Card */
        .card {
            border-radius: 12px !important;
        }

        @media (max-width: 768px) {

            .main-wrapper {
                margin-left: 0;
            }

            .main-content {
                padding: 15px;
            }

            .topbar {
                padding: 10px 15px;
            }

            .admin-role {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-book-half" style="color:#3b82f6; font-size:1.3rem;"></i>
                <span class="brand-title">Perpustakaan</span>
            </div>
            <div class="brand-sub">Sistem Informasi</div>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i> Kategori
            </a>
            <a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark"></i> Buku
            </a>
            <a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Anggota
            </a>
            <a href="{{ route('loans.index') }}" class="{{ request()->routeIs('loans.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Peminjaman
            </a>
            <a href="{{ route('fines.index') }}" class="{{ request()->routeIs('fines.*') ? 'active' : '' }}">
                <i class="bi bi-cash"></i> Denda
            </a>
        </div>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main -->
    <div class="main-wrapper">
        <div class="topbar">
            <div class="topbar-left">
                <button class="hamburger"><i class="bi bi-list"></i></button>
                <span class="topbar-title">@yield('title')</span>
            </div>
            <div class="topbar-right">
                <button class="notif-btn">
                    <i class="bi bi-bell"></i>
                    <span class="notif-badge">{{ \App\Models\Loan::where('status','borrowed')->where('due_date','<',now())->count() }}</span>
                </button>
                <div class="admin-info">
                    <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div>
                        <div class="admin-name">{{ ucfirst(Auth::user()->name) }}</div>
                        <div class="admin-role">Administrator</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @yield('content')
        </div>

        <div class="main-footer">
            © {{ date('Y') }} Perpustakaan Digital. All rights reserved.
            <span class="ms-3">Version 1.0.0</span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const sidebar = document.querySelector('.sidebar');
            const mainWrapper = document.querySelector('.main-wrapper');

            hamburger.addEventListener('click', function() {

                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');
                } else {
                    sidebar.classList.toggle('closed');
                    mainWrapper.classList.toggle('full');
                }

            });
        });
    </script>
</body>

</html>