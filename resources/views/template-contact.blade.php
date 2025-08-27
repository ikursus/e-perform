<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Perform - Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --primary-gradient: linear-gradient(135deg, #0055a3 0%, #0077b6 100%);
            --secondary-gradient: linear-gradient(135deg, #ffd700 0%, #ffc107 100%);
            --shadow-light: 0 4px 20px rgba(0, 85, 163, 0.08);
            --shadow-medium: 0 8px 30px rgba(0, 85, 163, 0.12);
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .navbar-custom {
            background: rgba(0, 85, 163, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .navbar-custom.scrolled {
            background: rgba(0, 85, 163, 0.98);
            box-shadow: var(--shadow-medium);
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 85, 163, 0.8), rgba(0, 119, 182, 0.8)), url('{{ asset("images/port.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            padding: 6rem 0;
            display: flex;
            align-items: center;
        }
        
        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .contact-section {
            padding: 5rem 0;
        }

        .contact-form {
            background: #fff;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: var(--shadow-medium);
        }

        .contact-info {
            background: var(--primary-gradient);
            color: white;
            padding: 3rem;
            border-radius: 16px;
        }

        .contact-info h3 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .contact-info p {
            margin-bottom: 1rem;
        }

        .contact-info .bi {
            margin-right: 10px;
        }
        
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        }
    </style>
</head>
<body class="antialiased bg-gray-100">
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
                        <a href="{{ url('/contact') }}" class="nav-link active">Contact</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Log in</a>
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

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Contact Us</h1>
                <p class="hero-subtitle">We'd love to hear from you. Get in touch with us for any inquiries.</p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="contact-form">
                        <h3 class="mb-4 fw-bold">Send us a Message</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-info">
                        <h3>Contact Information</h3>
                        <p><i class="bi bi-geo-alt-fill"></i> 123 Port Avenue, Harbor City, 12345</p>
                        <p><i class="bi bi-telephone-fill"></i> +1 (555) 123-4567</p>
                        <p><i class="bi bi-envelope-fill"></i> contact@e-perform.com</p>
                        <hr>
                        <p><strong>Business Hours:</strong></p>
                        <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                        <p>Saturday - Sunday: Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 E-Perform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
