<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITBOX - Platform Belajar IT</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
        font-family: 'Arial', sans-serif;
        color: #333;
        }
        .hero-section {
        background: #f4f6fc;
        padding: 50px 0;
        }
        .hero-section .btn {
        background-color: #6c63ff;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 30px;
        }
        .hero-section .btn:hover {
        background-color: #534ab7;
        }
        .video-section {
        background-color: #e9efff;
        padding: 50px 0;
        }
        .features-section {
        padding: 50px 0;
        }
        .feature-card {
        background: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        }
        .feature-card:hover {
        transform: translateY(-10px);
        }
        .footer {
        background: #333;
        color: white;
        padding: 30px 0;
        text-align: center;
        }
        .footer a {
        color: #6c63ff;
        text-decoration: none;
        }
        .footer a:hover {
        text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"><span style="color: #6c63ff;">ITBOX</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('courses.public') }}">Kursus</a></li>
            @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('courses.user') }}">Kursus Saya</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form> --}}
                @if (Auth::user()->usertype === 'admin')
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{ route('course.index') }}">CRUD Course</a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdownMenu">
                        <!-- Profile Link -->
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a>
                        </li>

                        <!-- Divider -->
                        <li><hr class="dropdown-divider"></li>

                        <!-- Logout -->
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
            @endauth
        </ul>
        </div>
    </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="fw-bold">Hi Sobat! Mau Jadi Jagokan IT?</h1>
            <p class="lead">Belajar skill IT sekarang juga dan wujudkan mimpimu!</p>
            @if (Route::has('login'))
                @auth
                    <!-- Kosong -->
                @else
                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="btn"
                        >
                            Daftar Sekarang
                        </a>
                    @endif
                @endauth
            @endif
        </div>
        <div class="col-lg-6 m">
            <img src="{{ asset('storage/images/b.webp') }}" alt="Hero Image" class="img-fluid mt-2">
        </div>
        </div>
    </div>
    </section>

    <!-- Kenapa Harus ITBOX -->
    <section class="video-section">
        <div class="container">
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
            <p class="lead">Belajar di ITBOX terbukti lebih cepat dan terarah. Semua materi disusun oleh para ahli yang berpengalaman di bidang IT.</p>
            </div>
        </div>
        </div>
    </section>

    <!-- Fitur ITBOX -->
    <section class="py-5">
        <div class="container">
        <h2 class="text-center fw-bold mb-4">Fitur Eksklusif ITBOX</h2>
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
    <footer class="footer">
    <div class="container">
        <p>&copy; 2024 ITBOX. All Rights Reserved.</p>
    </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
