<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'E-Perform') - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --border-color: #e2e8f0;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.1);
            border: none;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .sidebar {
            background: white;
            min-height: calc(100vh - 76px);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            border-right: 1px solid var(--border-color);
        }
        
        .sidebar .nav-link {
            color: var(--secondary-color);
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            margin: 0.25rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .sidebar .nav-link:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .main-content {
            background-color: var(--light-color);
            min-height: calc(100vh - 76px);
            padding: 2rem;
        }
        
        .content-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            padding: 2rem;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: var(--secondary-color);
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }
        
        .footer {
            background: white;
            border-top: 1px solid var(--border-color);
            padding: 1.5rem 0;
            margin-top: auto;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
        }
        
        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 76px;
                left: -100%;
                width: 280px;
                z-index: 1000;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .content-card {
                padding: 1.5rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <button class="btn btn-link text-white d-lg-none me-3" type="button" id="sidebarToggle">
                <i class="bi bi-list fs-4"></i>
            </button>
            
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                E-Perform
            </a>
            
            <div class="navbar-nav ms-auto">
                <!-- Notifications -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-danger rounded-pill ms-1">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Notifikasi</h6></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle me-2"></i>Notifikasi baru</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i>Task selesai</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="#">Lihat semua</a></li>
                    </ul>
                </div>
                
                <!-- User Menu -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i>
                        {{ Auth::user()->name ?? 'User' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-lg-3 col-xl-2 sidebar" id="sidebar">
                <div class="py-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/dashboard') }}">
                                <i class="bi bi-house-door me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/it') }}">
                                <i class="bi bi-server me-2"></i>
                                IT Performance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/import/data-investor') }}">
                                <i class="bi bi-upload me-2"></i>
                                Import Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-clipboard-check me-2"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-graph-up me-2"></i>
                                Laporan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-calendar-event me-2"></i>
                                Jadwal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-gear me-2"></i>
                                Pengaturan
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Main Content -->
            <main class="col-lg-9 col-xl-10 main-content">
                <!-- Page Header -->
                @hasSection('page-header')
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="page-title">@yield('title')</h1>
                            <p class="page-subtitle">@yield('subtitle')</p>
                        </div>
                        <div>
                            @yield('page-actions')
                        </div>
                    </div>
                @endif
                
                <!-- Breadcrumb -->
                @hasSection('breadcrumb')
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                @endif
                
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Main Content Area -->
                <div class="content-card">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">
                        &copy; {{ date('Y') }} E-Perform. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-muted">
                        Version 1.0.0
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(e.target) && 
                !toggle.contains(e.target) && 
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>