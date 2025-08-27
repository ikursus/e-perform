<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Perform - Port Performance Management System</title>
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
            --accent-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --shadow-light: 0 4px 20px rgba(0, 85, 163, 0.08);
            --shadow-medium: 0 8px 30px rgba(0, 85, 163, 0.12);
            --shadow-heavy: 0 15px 40px rgba(0, 85, 163, 0.15);
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
            position: relative;
            overflow: hidden;
            min-height: 70vh;
            display: flex;
            align-items: center;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 120%;
            height: 200%;
            background: var(--secondary-gradient);
            clip-path: ellipse(60% 40% at 70% 30%);
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 80%;
            height: 120%;
            background: var(--accent-gradient);
            clip-path: circle(40% at 30% 70%);
            opacity: 0.08;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--secondary-gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-heavy);
        }
        
        .stat-card:hover::before {
            transform: scaleX(1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary-gradient);
            color: #000;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stat-value {
            color: #0055a3;
            font-weight: 700;
            font-size: 2.5rem;
            line-height: 1;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-change {
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-gradient);
            color: white;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .section-title {
            font-weight: 700;
            color: #0055a3;
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            color: #6c757d;
            font-weight: 400;
            margin-bottom: 3rem;
        }
        
        .btn-custom {
            background: var(--secondary-gradient);
            border: none;
            color: #000;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-custom:hover {
            background: linear-gradient(135deg, #ffc107 0%, #ffd700 100%);
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
        }
        
        .stats-section {
            margin-top: -4rem;
            position: relative;
            z-index: 10;
        }
        
        .features-section {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
        
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-section {
                padding: 4rem 0;
                min-height: 60vh;
            }
            .stat-value {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body class="antialiased bg-gray-100">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <span class="text-warning">E</span>-PERFORM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                {{-- @if (Route::has('login'))
                    <ul class="navbar-nav">
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
                    </ul>
                @endif --}}
                <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="hero-content text-center fade-in">
                <h1 class="hero-title">
                    Port Performance Management System
                </h1>
                <p class="hero-subtitle">
                    Monitor, analyze, and optimize port operations with real-time performance metrics and AI-powered insights
                </p>
                <div class="mt-4">
                    <a href="#features" class="btn btn-custom me-3 pulse">Explore Features</a>
                    <a href="#stats" class="btn btn-outline-light">View Statistics</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="container stats-section" id="stats">
        <div class="row g-4">
            <!-- Vessel Throughput -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow stat-card">
                    <div class="card-body text-center">
                        <div class="stat-icon mx-auto">
                            <i class="bi bi-ship"></i>
                        </div>
                        <div class="stat-label">Vessel Throughput</div>
                        <div class="stat-value">245</div>
                        <div class="stat-change text-success">
                            <i class="bi bi-arrow-up"></i> 12.5%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berth Occupancy Rate -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow stat-card">
                    <div class="card-body text-center">
                        <div class="stat-icon mx-auto">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="stat-label">Berth Occupancy Rate</div>
                        <div class="stat-value">78%</div>
                        <div class="stat-change text-success">
                            <i class="bi bi-arrow-up"></i> 5.2%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cargo Handling -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow stat-card">
                    <div class="card-body text-center">
                        <div class="stat-icon mx-auto">
                            <i class="bi bi-boxes"></i>
                        </div>
                        <div class="stat-label">Cargo Handling</div>
                        <div class="stat-value">156</div>
                        <div class="stat-change text-success">
                            <i class="bi bi-arrow-up"></i> 0.8%
                        </div>
                        <small class="text-muted d-block mt-1">tons/hour</small>
                    </div>
                </div>
            </div>

            <!-- Vessel Turnaround Time -->
            <div class="col-md-6 col-lg-3">
                <div class="card shadow stat-card">
                    <div class="card-body text-center">
                        <div class="stat-icon mx-auto">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-label">Avg. Turnaround Time</div>
                        <div class="stat-value">24.5</div>
                        <div class="stat-change text-success">
                            <i class="bi bi-arrow-down"></i> 8.3%
                        </div>
                        <small class="text-muted d-block mt-1">hours</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-5 features-section" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5">Key Features</h2>
                <p class="section-subtitle lead">
                    Comprehensive tools for port performance management and optimization
                </p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h4 class="mb-3 fw-bold">Real-time Monitoring</h4>
                        <p class="text-muted mb-4">
                            Track vessel movements, cargo operations, and berth utilization with live data streams and instant notifications
                        </p>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-primary rounded-pill px-3 py-2">Live Data</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <h4 class="mb-3 fw-bold">Performance Analytics</h4>
                        <p class="text-muted mb-4">
                            Advanced analytics and reporting tools with customizable dashboards for data-driven decision making
                        </p>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-success rounded-pill px-3 py-2">Smart Reports</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-lightning"></i>
                        </div>
                        <h4 class="mb-3 fw-bold">AI Optimization</h4>
                        <p class="text-muted mb-4">
                            Machine learning algorithms provide intelligent recommendations for optimizing port operations and resource allocation
                        </p>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">AI Powered</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="mb-3 fw-bold">Security & Compliance</h4>
                        <p class="text-muted mb-4">
                            Enterprise-grade security with role-based access control and compliance with international port standards
                        </p>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-info rounded-pill px-3 py-2">Secure</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h4 class="mb-3 fw-bold">Global Integration</h4>
                        <p class="text-muted mb-4">
                            Seamless integration with international shipping networks and customs systems for streamlined operations
                        </p>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-secondary rounded-pill px-3 py-2">Connected</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h4 class="mb-3 fw-bold">Mobile Ready</h4>
                        <p class="text-muted mb-4">
                            Access your port management system anywhere with our responsive design and dedicated mobile applications
                        </p>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-dark rounded-pill px-3 py-2">Mobile First</span>
                        </div>
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
    
    <!-- Custom JavaScript -->
    <script>
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

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation classes to elements
            const animateElements = document.querySelectorAll('.stat-card, .feature-card');
            animateElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(el);
            });

            // Counter animation for statistics
            const counters = document.querySelectorAll('.stat-value');
            const animateCounter = (counter) => {
                const target = parseInt(counter.textContent.replace(/[^0-9.]/g, ''));
                const increment = target / 100;
                let current = 0;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = counter.textContent.replace(/[0-9.]+/, target);
                        clearInterval(timer);
                    } else {
                        const value = Math.floor(current);
                        counter.textContent = counter.textContent.replace(/[0-9.]+/, value);
                    }
                }, 20);
            };

            // Trigger counter animation when stats section is visible
            const statsObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        counters.forEach(counter => {
                            animateCounter(counter);
                        });
                        statsObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                statsObserver.observe(statsSection);
            }

            // Add hover effects to feature cards
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Parallax effect for hero section
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const heroSection = document.querySelector('.hero-section');
                if (heroSection) {
                    const rate = scrolled * -0.5;
                    heroSection.style.transform = `translateY(${rate}px)`;
                }
            });

            // Add loading animation
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease-in-out';
            
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Add dynamic gradient animation to hero section
        function animateGradient() {
            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                let hue = 0;
                setInterval(() => {
                    hue = (hue + 1) % 360;
                    const gradient = `linear-gradient(135deg, hsla(${210 + Math.sin(hue * 0.01) * 10}, 70%, 45%, 0.8) 0%, hsla(${200 + Math.cos(hue * 0.01) * 10}, 80%, 55%, 0.8) 100%)`;
                    // Set background image first, then overlay with semi-transparent gradient
                    heroSection.style.backgroundImage = `${gradient}, url('{{ asset("images/port.jpg") }}')`;
                    heroSection.style.backgroundSize = 'cover, cover';
                    heroSection.style.backgroundPosition = 'center, center';
                    heroSection.style.backgroundRepeat = 'no-repeat, no-repeat';
                    heroSection.style.backgroundBlendMode = 'overlay';
                }, 100);
            }
        }

        // Initialize gradient animation after page load
        window.addEventListener('load', animateGradient);
    </script>
</body>
</html>