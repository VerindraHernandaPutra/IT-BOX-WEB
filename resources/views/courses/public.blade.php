<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Publik - ITCOURSE</title>
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

         /* Hero Section Styles */
         .hero-section {
            padding-top: 100px; /* Untuk menghindari konten tertutupi navbar */
            padding-bottom: 50px;
            background: #f4f6fc;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        /* Card Styles */
        .course-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-radius: 10px 10px 0 0;
            height: 200px;
            object-fit: cover;
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
        <div class="container">
            <h1 class="hero-title">Kursus yang Tersedia</h1>
            <p class="hero-subtitle">Pilih kursus terbaik yang sesuai dengan minat dan kebutuhan Anda.</p>
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card course-card">
                            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('images/default-thumbnail.png') }}" alt="Thumbnail" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->course_name }}</h5>
                                <p class="card-text">
                                    <strong>Durasi:</strong> {{ $course->course_hour }} jam<br>
                                    <strong>Harga:</strong> {{ $course->course_price > 0 ? 'Rp. ' . $course->course_price : 'Gratis' }}<br>
                                    {{ $course->description }}
                                </p>
                                <form action="{{ route('courses.enroll', $course->id) }}" method="POST">@csrf
                                    @auth
                                        <button class="login-btn w-100">Enroll</button>
                                    @else
                                        <a href="{{ route('login') }}" class="login-btn w-100">Login untuk Enroll</a>
                                    @endauth
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
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
