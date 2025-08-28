<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Perform - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gold-gradient: linear-gradient(135deg, #ffd700 0%, #ffb347 100%);
            --blue-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --shadow-light: 0 10px 30px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 20px 60px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 30px 80px rgba(0, 0, 0, 0.25);
        }
        
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: url('{{ asset('images/bg-login.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.4) 100%);
            z-index: -1;
        }
        
        /* Floating particles animation */
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 119, 182, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            z-index: -1;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(20px) rotate(240deg); }
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, rgba(0, 85, 163, 0.95) 0%, rgba(0, 119, 182, 0.9) 100%);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 215, 0, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-custom.scrolled {
            background: linear-gradient(135deg, rgba(0, 85, 163, 0.98) 0%, rgba(0, 119, 182, 0.95) 100%);
            box-shadow: var(--shadow-medium);
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .login-section {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 4rem 6rem 4rem 2rem;
            min-height: calc(100vh - 200px);
            position: relative;
        }
        
        .login-section::before {
            content: '';
            position: absolute;
            top: 50%;
            right: 10%;
            width: 300px;
            height: 300px;
            background: var(--gold-gradient);
            border-radius: 50%;
            opacity: 0.1;
            transform: translateY(-50%);
            filter: blur(100px);
            animation: pulse 4s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: translateY(-50%) scale(1); }
            50% { transform: translateY(-50%) scale(1.1); }
        }

        .login-card {
            background: linear-gradient(145deg, rgba(44, 90, 160, 0.75) 0%, rgba(30, 58, 95, 0.78) 100%);
            backdrop-filter: blur(20px);
            padding: 4rem;
            border-radius: 35px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 550px;
            position: relative;
            overflow: hidden;
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 35px 70px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
        }
        
        .login-card:hover::before {
            left: 100%;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }
        
        .logo-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 120px;
            height: 120px;
            background: var(--gold-gradient);
            border-radius: 50%;
            opacity: 0.2;
            transform: translate(-50%, -50%);
            filter: blur(20px);
            animation: logoGlow 3s ease-in-out infinite;
        }
        
        .logo-container img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
            transition: transform 0.3s ease;
        }
        
        .logo-container img:hover {
            transform: scale(1.05) rotate(5deg);
        }
        
        @keyframes logoGlow {
            0%, 100% { opacity: 0.2; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 0.4; transform: translate(-50%, -50%) scale(1.1); }
        }
        
        .login-card-title {
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
        }
        
        .login-card-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            width: 60px;
            height: 3px;
            background: var(--gold-gradient);
            border-radius: 2px;
            transform: translateX(-50%);
        }

        .form-label {
            font-weight: 600;
            color: #ffd700;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 20px;
            padding: 18px 25px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .form-control:focus {
            box-shadow: 
                0 0 0 3px rgba(255, 215, 0, 0.2),
                0 8px 25px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.98);
            transform: translateY(-2px);
            outline: none;
        }
        
        .form-control::placeholder {
            color: rgba(0, 0, 0, 0.5);
            font-weight: 400;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            border: 2px solid #ffd700;
            padding: 14px 2rem;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 12px;
            letter-spacing: 0.5px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gold-gradient);
            transition: left 0.4s;
            z-index: -1;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            border-color: #ffb347;
            color: #000;
        }
        
        .btn-primary:hover::before {
            left: 0;
        }
        
        .btn-primary:active {
            transform: translateY(-1px);
        }
        
        .form-check {
            margin: 1.5rem 0;
        }
        
        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            border: 2px solid #ffd700;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .form-check-input:checked {
            background: var(--gold-gradient);
            border-color: #ffd700;
        }
        
        .form-check-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-left: 0.5rem;
        }
        
        .text-warning {
            color: #ffd700 !important;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .text-warning:hover {
            color: #ffb347 !important;
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
        }
        
        .text-warning::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold-gradient);
            transition: width 0.3s ease;
        }
        
        .text-warning:hover::after {
            width: 100%;
        }
        
        footer {
            background: linear-gradient(135deg, rgba(44, 62, 80, 0.95) 0%, rgba(52, 73, 94, 0.95) 100%);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 215, 0, 0.2);
            flex-shrink: 0;
            box-shadow: 0 -8px 32px rgba(0, 0, 0, 0.1);
        }
        
        footer p {
            font-weight: 600;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .login-section {
                padding: 2rem 1rem;
                justify-content: center;
            }
            
            .login-card {
                padding: 2.5rem 2rem;
                max-width: 100%;
                margin: 0 1rem;
            }
            
            .login-card-title {
                font-size: 1.6rem;
            }
            
            .logo-container img {
                width: 70px;
                height: 70px;
            }
        }
        
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
            
            .btn-primary {
                padding: 12px 1.5rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <span class="text-warning">E</span>-PERFORM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/contact') }}" class="nav-link">Contact</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link active">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="login-section">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-5 col-lg-4">
                    <div class="login-card">
                        <div class="logo-container">
                            <img src="{{ asset('images/logo-ppc.png') }}" alt="Penang Port Commission Logo">
                            <h2 class="login-card-title">
                                E-PERFORM
                            </h2>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- User Name -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-warning fw-semibold">User Name</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="background: rgba(255, 255, 255, 0.95); border: 2px solid #ffd700; border-radius: 8px; padding: 12px;" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-warning fw-semibold">Password</label>
                                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" style="background: rgba(255, 255, 255, 0.95); border: 2px solid #ffd700; border-radius: 8px; padding: 12px;" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mb-3">
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none text-warning" href="{{ route('password.request') }}">
                                        Forgot password
                                    </a>
                                @endif
                            </div>
                            
                            <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); border: 2px solid #ffd700; color: white; padding: 0.75rem; font-weight: 600; border-radius: 8px; transition: all 0.3s ease;">
                                Log In
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-3" style="background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(10px);">
        <div class="container">
            <div class="text-center">
                <p class="mb-0 text-warning fw-semibold">Copyright: Penang Port Commission</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
