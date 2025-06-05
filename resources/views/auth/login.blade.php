<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITCOURSE - Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .navbar {
            background-color: #131519;
            padding: 15px 0;
        }

        .navbar-brand {
            color: #ffffff;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .navbar-brand:hover {
            color: #ffffff;
        }

        .nav-link {
            color: #ffffff;
            margin: 0 15px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #680d13;
        }

        .login-btn {
            background-color: #680d13;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background-color: #3d1315;
            color: white;
        }

        .navbar-toggler {
            border-color: #ffffff;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        @media (max-width: 991px) {
            .nav-link {
                margin: 10px 0;
            }
            
            .login-btn {
                display: inline-block;
                margin-top: 10px;
            }
        }

        :root {
            --primary-color: #680d13;
            --secondary-color: #37393d;
            --accent-color: #ff0000;
            --text-color: #333;
            --light-text: #ffffff;
        }

        body {
            background-color: var(--secondary-color);
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hexagon-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 30 L15 0 L45 0 L60 30 L45 60 L15 60 Z' fill='none' stroke='rgba(104, 13, 19, 0.3)' stroke-width='1'/%3E%3C/svg%3E");
            background-size: 60px 60px;
            opacity: 0.8;
            z-index: 1;
        }

        .auth-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 1200px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            display: flex;
            min-height: 600px;
        }

        .auth-brand {
            flex: 1;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            padding: 3rem;
            color: var(--light-text);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .brand-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .coming-soon {
            background-color: var(--accent-color);
            color: var(--light-text);
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 1rem;
            font-weight: 500;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .auth-forms {
            flex: 1;
            padding: 3rem;
            background: white;
            overflow-y: auto;
        }

        .auth-tabs {
            display: flex;
            margin-bottom: 2rem;
            border-bottom: 2px solid #eee;
        }

        .auth-tab {
            padding: 1rem 2rem;
            cursor: pointer;
            font-weight: 500;
            color: var(--text-color);
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: all 0.3s ease;
        }

        .auth-tab.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #eee;
            border-radius: 0;
            padding: 0.75rem 0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-color);
        }

        .form-label {
            color: var(--text-color);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .btn-auth {
            background-color: var(--primary-color);
            color: var(--light-text);
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-auth:hover {
            background-color: #4d0a0e;
            transform: translateY(-2px);
        }

        .auth-separator {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .auth-separator::before,
        .auth-separator::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background-color: #eee;
        }

        .auth-separator::before { left: 0; }
        .auth-separator::after { right: 0; }

        .social-auth {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-text);
            transition: all 0.3s ease;
        }

        .social-btn.facebook { background-color: #1877f2; }
        .social-btn.google { background-color: #ea4335; }
        .social-btn.linkedin { background-color: #0077b5; }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 992px) {
            .auth-card {
                flex-direction: column;
            }

            .auth-brand {
                padding: 2rem;
            }

            .brand-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 576px) {
            .auth-container {
                padding: 1rem;
            }

            .auth-forms {
                padding: 2rem 1.5rem;
            }

            .auth-tab {
                padding: 1rem;
            }
        }

        .footer {
            padding: 40px 0;
            border-top: 1px solid #eee;
            background-color: #131519;
            color: #ffffff;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .footer-content h4 {
            margin-bottom: 15px;
            font-weight: bold;
        }

        .footer-content p {
            margin: 0;
            font-size: 14px;
            color: #cccccc;
        }

        .social-links a {
            color: #ffffff;
            margin-right: 10px;
            font-size: 20px;
            text-decoration: none;
        }

        .social-links a:hover {
            color: #680d13;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .social-links {
                justify-content: center;
                margin-top: 20px;
            }
        }
                /* Custom CSS */
                .navbar {
            background-color: #131519;
            padding: 15px 0;
        }

        .navbar-brand {
            color: #ffffff;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .navbar-brand:hover {
            color: #ffffff;
        }

        .nav-link {
            color: #ffffff;
            margin: 0 15px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #680d13;
        }

        .login-btn {
            background-color: #680d13;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background-color: #3d1315;
            color: white;
        }

        .navbar-toggler {
            border-color: #ffffff;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        @media (max-width: 991px) {
            .nav-link {
                margin: 10px 0;
            }
            
            .login-btn {
                display: inline-block;
                margin-top: 10px;
            }
        }

        .hero-section {
            position: relative;
            height: 100vh;
            width: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../istockphoto-1290801796-612x612.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .hero-content {
            max-width: 800px;
            padding: 20px;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .create-button {
            background-color: white;
            color: black;
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .create-button:hover {
            background-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
        }

        .card-program {
            transition: transform 0.3s;
        }

        .card-program:hover {
            transform: translateY(-5px);
        }

        .verified-badge {
            color: #00A3FF;
        }

        .rating-star {
            color: #FFD700;
        }

        /* Footer Styling */
        .footer {
            padding: 40px 0;
            border-top: 1px solid #eee;
            background-color: #131519;
            color: #ffffff;
            text-align: center;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer a:hover {
            color: #680d13;
        }

    </style>
</head>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">ITCOURSE.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('courses.public') }}">Courses</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('courses.user') }}">My Courses</a></li>
                        @if (Auth::user()->usertype === 'admin')
                            <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('course.index') }}">CRUD Course</a></li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">@csrf
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link login-btn" href="{{ route('login') }}">Login/Register Now</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
  


    <div class="hexagon-bg"></div>
    
    <div class="auth-container"  style="padding-top: 110px; padding-bottom: 110px;">
        <!-- Form Container -->
        <div class="auth-card">
                    <!-- Brand Section -->
                    <div class="auth-brand">
                        <div class="brand-content">
                            <h1 class="brand-title">ITBOX.</h1>
                            <div class="coming-soon">Coming Soon</div>
                            <h2>Connect With Company</h2>
                            <p>Research Assistant Recruitment 2024</p>
                        </div>
                    </div>

                    <!-- Forms Section -->
                    <div class="auth-forms">
                        <div class="auth-tabs">
                            <a href="{{ route('login') }}" class="auth-tab active "> Masuk </a>
                            <a href="{{ route('register') }}" class="auth-tab"> Daftar </a>
                        </div>

                        <!-- Login Form -->
                        <div id="loginForm" class="form-content active">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="loginEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: var(--primary-color);">Lupa Password?</a>
                                </div>
                                <button type="submit" class="btn-auth">Masuk</button>
                            </form>
                        </div>
                        </div>
                    </div>
        </div>
    </div>

   <!-- Footer -->
   <footer class="footer mt-5">
        <p>&copy; 2024 ITCOURSE. All Rights Reserved. <a href="{{ route('about') }}">About Us</a></p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>