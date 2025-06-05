<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
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

        .register-btn {
            background-color: #680d13;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .register-btn:hover {
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
            
            .register-btn {
                display: inline-block;
                margin-top: 10px;
            }
        }

        .hero-section {
              padding: 80px 0;
              background-color: #f8f9fa;
          }
          
          .curved-image {
              width: 100%;
              height: 400px;
              object-fit: cover;
              border-radius: 15px;
          }
          
          .team-member img {
              width: 100%;
              height: 300px;
              object-fit: cover;
              border-radius: 10px;
              margin-bottom: 15px;
          }
          
          .mission-vision-section {
              padding: 60px 0;
          }
          
          .team-section {
              padding: 60px 0;
              background-color: #ffffff;
          }
          
          .section-title {
              margin-bottom: 40px;
              color: #333;
              font-weight: 600;
          }
          
          .text-muted {
              color: #6c757d;
              line-height: 1.6;
          }

          .contact-section {
            padding: 80px 0;
        }
        
        .contact-form {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 0;
        }
        
        .form-control {
            background-color: #f8f9fa;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        textarea.form-control {
            min-height: 150px;
        }
        
        .submit-btn {
            background-color: #000;
            color: white;
            padding: 10px 40px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }
        
        .contact-info-section {
            padding: 40px 0;
            background-color: #fff;
        }
        
        .contact-details h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        
        .map-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        
        .contact-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin: 60px auto;
            max-width: 1000px;
            padding: 0 15px;
        }

        .contact-info {
            text-align: center;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .contact-info p {
            margin-bottom: 8px;
            color: #666;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
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
                        <li class="nav-item"><a class="nav-link register-btn" href="{{ route('login') }}">Login/Register Now</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
  
    <!-- Get to know us Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="section-title mt-4">Get to know us</h1>
                    <p class="text-muted">Kami memulai sebagai platform pendidikan IT online kecil yang didorong oleh semangat untuk memberdayakan individu dalam komunitas teknologi di Michigan agar dapat meningkatkan keterampilan mereka dan berkembang di dunia digital. Kami segera menyadari bahwa ada peluang untuk membantu para pelajar melihat melampaui keterampilan dasar dan merangkul masa depan di mana teknologi mengubah kehidupan dan karier. Saat ini, kami menawarkan berbagai kursus IT online, bimbingan karier, dan pembelajaran berbasis proyek untuk membantu siswa kami membangun karier di bidang teknologi yang berkelanjutan dan memuaskan secara mulus.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <img src="storage/images/AboutUs_1.jpg" alt="Modern Architecture" class="curved-image">
                </div>
            </div>
        </div>
    </section>
  
      <!-- Mission & Vision Section -->
      <section class="mission-vision-section">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 mb-4">
                      <h2 class="section-title">Our mission</h2>
                      <p class="text-muted">Kami memiliki misi untuk mendefinisikan ulang pendidikan IT dengan membuatnya lebih mudah diakses, menarik, dan praktis. Setelah melihat begitu banyak individu yang kesulitan untuk memasuki dunia teknologi atau mengikuti tren yang terus berkembang, kami berkomitmen untuk menyediakan pendidikan yang memberdayakan pelajar agar dapat dengan percaya diri menavigasi lanskap digital.</p>
                  </div>
                  <div class="col-lg-6 mb-4">
                      <h2 class="section-title">Our vision</h2>
                      <p class="text-muted">Kami membayangkan dunia di mana siapa pun yang bermimpi untuk masuk ke industri teknologi dapat mengakses sumber daya, pengetahuan, dan dukungan yang mereka butuhkan untuk berhasil. Tujuan kami adalah menciptakan masa depan di mana pendidikan IT selaras dengan aspirasi individu, bukan hanya mengikuti ekspektasi industri yang kaku.</p>
                  </div>
              </div>
              <div class="row mt-4">
                  <div class="col-lg-12">
                      <img src="storage/images/AboutUs_2.jpg" alt="Modern Building" class="curved-image">
                  </div>
              </div>
          </div>
      </section>
  
      <!-- Team Section -->
      <section class="team-section">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 text-center">
                      <h2 class="section-title">Our team</h2>
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-3 col-md-6 mb-4">
                      <div class="team-member">
                          <img src="storage/images/AboutUs_4.png" alt="Esther Bryce">
                          <h5>Kanjeng Dhimas Cahyoherlina</h5>
                          <p class="text-muted">1303223064</p>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-4">
                      <div class="team-member">
                          <img src="storage/images/AboutUs_4.png" alt="Lianne Wilson">
                          <h5>Verindra Hernanda Putra</h5>
                          <p class="text-muted">1303223055</p>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-4">
                      <div class="team-member">
                          <img src="storage/images/AboutUs_4.png" alt="Jaden Smith">
                          <h5>Sayyieda Raaif Ramdhani</h5>
                          <p class="text-muted">1303223137</p>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-4">
                      <div class="team-member">
                          <img src="storage/images/AboutUs_4.png" alt="Jessica Kim">
                          <h5>Muhammad Shidqul Aziz L</h5>
                          <p class="text-muted">1303223132</p>
                      </div>
                  </div>
              </div>
          </div>
      </section>

    

   <!-- Footer -->
   <footer class="footer mt-5">
        <p>&copy; 2024 ITCOURSE. All Rights Reserved. <a href="{{ route('about') }}">About Us</a></p>
    </footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>