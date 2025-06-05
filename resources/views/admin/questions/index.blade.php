<!DOCTYPE html>
<html>
<head>
    <title>Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
           body {
               padding-top: 80px; /* Sesuaikan dengan tinggi navbar */
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
  

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Questions for {{ $course->course_name }}</h2>
                <a href="{{ route('admin.questions.create', $course->id) }}" class="btn btn-primary float-end">Add New Question</a>
            </div>
            <div class="card-body">
                @if ($questions->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Correct Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key => $question)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $question->question_text }}</td>
                                    <td>{{ $question->{$question->correct_answer} }}</td>
                                    <td>
                                        <a href="{{ route('admin.questions.edit', [$course->id, $question->id]) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.questions.destroy', [$course->id, $question->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">No questions found.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
