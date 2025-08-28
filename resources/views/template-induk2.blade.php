<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'E-Perform') - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, rgba(21, 94, 117, 0.9) 0%, rgba(14, 116, 144, 0.9) 50%, rgba(6, 182, 212, 0.8) 100%), url('{{ asset('images/header.jpg') }}') center/cover;
            height: 120px;
            position: relative;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .logo {
            display: flex;
            align-items: center;
            color: white;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }
        
        .logo img {
            width: 80px;
            height: 80px;
            margin-right: 15px;
            border-radius: 50%;
        }
        
        .header-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logout-btn {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.4);
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.3), inset 0 -1px 0 rgba(0, 0, 0, 0.1);
        }
        
        .logout-btn:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0.25) 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.4), inset 0 -1px 0 rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.6);
        }
        
        /* Main Container */
        .main-container {
            display: flex;
            min-height: calc(100vh - 120px);
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #155e75 0%, #0e7490 50%, #0891b2 100%);
            padding: 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(180deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.05) 100%);
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }
        
        .sidebar-menu li {
            margin: 0;
        }
        
        .sidebar-menu a {
            display: block;
            margin: 8px 15px;
            padding: 12px 20px;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
            color: #1f2937;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-radius: 16px;
            transition: all 0.3s ease;
            position: relative;
            border: 2px solid transparent;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.3), inset 0 -1px 0 rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-menu a:hover {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
            transform: translateX(5px) translateY(-2px);
            box-shadow: 0 8px 16px rgba(251, 191, 36, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.4), inset 0 -1px 0 rgba(0, 0, 0, 0.2);
        }
        
        .sidebar-menu a.active {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
            border-color: #ffffff;
            box-shadow: 0 6px 12px rgba(251, 191, 36, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
        }
        
        /* Content Area */
        .content {
            flex: 1;
            background: #f8fafc;
            padding: 30px;
            position: relative;
        }
        
        .content-header {
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }
        
        .page-subtitle {
            color: #64748b;
            font-size: 16px;
        }
        
        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            padding: 30px;
            margin-bottom: 20px;
        }
        
        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid;
            position: relative;
        }
        
        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-left-color: #22c55e;
        }
        
        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border-left-color: #ef4444;
        }
        
        .alert-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
        }
        
        .alert-close:hover {
            opacity: 1;
        }
        
        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
            color: white;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                height: 80px;
                padding: 0 15px;
            }
            
            .logo {
                font-size: 20px;
            }
            
            .logo img {
                width: 40px;
                height: 40px;
            }
            
            .main-container {
                flex-direction: column;
                min-height: calc(100vh - 80px);
            }
            
            .sidebar {
                width: 100%;
                order: 2;
            }
            
            .sidebar-menu {
                display: flex;
                overflow-x: auto;
                padding: 10px;
            }
            
            .sidebar-menu li {
                flex-shrink: 0;
            }
            
            .sidebar-menu a {
                padding: 10px 20px;
                white-space: nowrap;
                border-left: none;
                border-bottom: 4px solid transparent;
            }
            
            .sidebar-menu a:hover,
            .sidebar-menu a.active {
                border-left: none;
                border-bottom-color: #fbbf24;
                padding-left: 20px;
            }
            
            .content {
                order: 1;
                padding: 20px 15px;
            }
            
            .content-card {
                padding: 20px;
            }
            
            .page-title {
                font-size: 24px;
            }
        }
        
        /* Industrial Background Pattern */
        .content::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 200px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="industrial" patternUnits="userSpaceOnUse" width="20" height="20"><rect width="20" height="20" fill="%23f1f5f9"/><circle cx="10" cy="10" r="1" fill="%23cbd5e1" opacity="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23industrial)"/></svg>') repeat;
            opacity: 0.3;
            z-index: 0;
        }
        
        .content > * {
            position: relative;
            z-index: 1;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo-ppc.png') }}" alt="Logo PPC">
            E-Perform
        </a>
        
        <div class="header-right">
            <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Log out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </header>
    
    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'active' : '' }}">User</a></li>
                <li><a href="{{ url('/productivity') }}" class="{{ request()->is('productivity*') ? 'active' : '' }}">Productivity</a></li>
                <li><a href="{{ url('/utilization') }}" class="{{ request()->is('utilization*') ? 'active' : '' }}">Utilization</a></li>
                <li><a href="{{ url('/service') }}" class="{{ request()->is('service*') ? 'active' : '' }}">Service</a></li>
                <li><a href="{{ route('investor-holdings.index') }}" class="{{ request()->is('investor-holdings*') ? 'active' : '' }}">Investor Holdings</a></li>
                <li><a href="{{ url('/import-data') }}" class="{{ request()->is('import-data*') ? 'active' : '' }}">Import Data</a></li>
                <li><a href="{{ url('/setting') }}" class="{{ request()->is('setting*') ? 'active' : '' }}">Setting</a></li>
            </ul>
        </nav>
        
        <!-- Content -->
        <main class="content">
            <!-- Page Header -->
            @hasSection('page-header')
                <div class="content-header">
                    <h1 class="page-title">@yield('title')</h1>
                    <p class="page-subtitle">@yield('subtitle')</p>
                    @yield('page-actions')
                </div>
            @endif
            
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Terdapat kesalahan:</strong>
                    <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
                </div>
            @endif
            
            <!-- Main Content Area -->
            <div class="content-card">
                @yield('content')
            </div>
        </main>
    </div>
    
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 300);
            });
        }, 5000);
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>