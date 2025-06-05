<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITCOURSE - Platform Belajar IT</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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

<body>
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
  


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content my-10">
            <h1 class="hero-title">Hi Sobat! Mau Jadi Jagokan IT?</h1>
            <p class="hero-subtitle">Belajar skill IT sekarang juga dan wujudkan mimpimu!</p>
            @if (Route::has('login'))
                @auth
                    <!-- Kosong -->
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="create-button">Create it</a>
                    @endif
                @endauth
            @endif
        </div>
    </section>
    <!-- Section Program Pilihan -->
    <section class="container my-5">
        <h2 class="mb-4">Program Pilihan</h2>
        <div class="row g-4">
            <!-- KelasFull stack -->
            <div class="col-md-4">
                <a href="" class="text-decoration-none text-dark">
                    <div class="card card-program h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning p-3 rounded-3 me-3">
                                    <i class="fas fa-layer-group text-white"></i>
                                </div>
                                <h5 class="card-title mb-0">KelasFullstack</h5>
                            </div>
                            <p class="card-text">Kelas Online Belajar Menjadi Full Stack Web Developer From A to Z</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- PZN Expert -->
            <div class="col-md-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card card-program h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary p-3 rounded-3 me-3">
                                    <i class="fas fa-code text-white"></i>
                                </div>
                                <h5 class="card-title mb-0">PZN Expert</h5>
                            </div>
                            <p class="card-text">Kelas Online Kuasai Skill Coding ala Startup Unicorn</p>
                        </div>
                    </div>
                </a> 
            </div>
            <!-- Developer Handal -->
            <div class="col-md-4">
                <a href="" class="text-decoration-none text-dark">
                    <div class="card card-program h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-danger p-3 rounded-3 me-3">
                                    <i class="fas fa-laptop-code text-white"></i>
                                </div>
                                <h5 class="card-title mb-0">Developer Handal</h5>
                            </div>
                            <p class="card-text">Beasiswa Belajar Coding dan Sertifikasi Developer Internasional</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Kenapa Harus ITBOX -->
    <section class="container my-5 video-section">
        <h2 class="text-center fw-bold">Kenapa Kamu Harus Upgrade Skill Sekarang?</h2>
        <div class="row align-items-center mt-4">
            <div class="col-md-6">
            <!-- Embed YouTube Video -->
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/d_Vvx5HoJkU" 
                        title="YouTube video" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>
            </div>
            </div>
            <div class="col-md-6">
            <p class="lead">
                Belajar di ITCOURSE adalah pilihan tepat untuk sukses di dunia IT. Materi dirancang oleh ahli berpengalaman, menggabungkan teori dan keterampilan praktis yang relevan dengan tren industri terkini. Cocok untuk pemula hingga profesional, ITCOURSE membantu Anda mencapai impian karier, seperti menjadi programmer, ahli keamanan siber, atau pengembang aplikasi. Mulailah sekarang dan jadilah profesional IT yang siap bersaing di era digital!</p>
            </div>
        </div>
    </section>

 
    <!-- Fitur ITBOX -->
    <section class="py-5">
        <div class="container">
        <h2 class="text-center fw-bold mb-4">Fitur Eksklusif ITCOURSE </h2>
        <div class="row">
            <div class="col-md-4 text-center">
            <span class="feature-icon">&#9733;</span>
            <h5 class="fw-bold mt-2">Belajar Fleksibel</h5>
            <p>Kapan saja dan di mana saja.</p>
            </div>
            <div class="col-md-4 text-center">
            <span class="feature-icon">&#9733;</span>
            <h5 class="fw-bold mt-2">Mentor Terbaik</h5>
            <p>Dibimbing langsung oleh mentor profesional.</p>
            </div>
            <div class="col-md-4 text-center">
            <span class="feature-icon">&#9733;</span>
            <h5 class="fw-bold mt-2">Sertifikat Eksklusif</h5>
            <p>Dapatkan pengakuan resmi.</p>
            </div>
        </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer mt-5">
        <p>&copy; 2024 ITCOURSE. All Rights Reserved. <a href="{{ route('about') }}">About Us</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
