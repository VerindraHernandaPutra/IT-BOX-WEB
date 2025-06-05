<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Track - ITBOX</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .skilltrack-header {
            background-color: #f8f9fa;
            padding: 40px;
            text-align: center;
            color: #6c63ff;
        }
        .category-title {
            font-weight: bold;
        }
        .card-price {
            text-decoration: line-through;
            color: gray;
        }
        .price-now {
            color: #6c63ff;
            font-weight: bold;
        }
        .pagination-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="#">
                <span style="color: #6c63ff;">ITBOX</span>
            </a>

            <!-- Navbar Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{ route('skilltrack') }}#">Skill Track</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#">Kursus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#">Career Path</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="#">Cart</a>
                    </li>
                </ul>

                <!-- User Dropdown Aligned Right -->
                <ul class="navbar-nav ms-auto">
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
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <!-- Header -->
        <div class="skilltrack-header my-4 rounded">
            <h1>ITBOX Skilltrack</h1>
            <p>Program ITBOX Skilltrack berisi kumpulan courses yang fokus pada topik/sub materi untuk melengkapi skill...</p>
        </div>

        <!-- Sidebar and Cards -->
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="bg-light p-3 rounded">
                    <h5 class="category-title">Kategori</h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">Cyber Security</li>
                        <li class="list-group-item">Data Analyst</li>
                        <li class="list-group-item">Data Science</li>
                        <li class="list-group-item">Database Engineer</li>
                        <li class="list-group-item">Digital Marketing</li>
                        <li class="list-group-item">Flutter</li>
                        <li class="list-group-item">Fullstack JavaScript Web Developer</li>
                        <li class="list-group-item">Network Engineer</li>
                    </ul>
                    <h5 class="category-title">Level</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Basic</li>
                        <li class="list-group-item">Advanced</li>
                        <li class="list-group-item">Intermediate</li>
                    </ul>
                </div>
            </div>

            <!-- Cards -->
            <div class="col-md-9">
                <div class="row">
                    <!-- Course Card -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course Image">
                            <div class="card-body">
                                <h5 class="card-title">Cara melakukan State Management Provider</h5>
                                <p>
                                    <span class="card-price">Rp250.000</span> 
                                    <span class="price-now">Rp149.000</span>
                                </p>
                                <a href="#" class="btn btn-primary w-100">Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>

                    <!-- Repeat the card structure for other courses -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Course Image">
                            <div class="card-body">
                                <h5 class="card-title">Memahami Negasi SQL</h5>
                                <p>
                                    <span class="card-price">Rp195.000</span> 
                                    <span class="price-now">Rp95.000</span>
                                </p>
                                <a href="#" class="btn btn-primary w-100">Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>

                    <!-- Add more cards as needed -->
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-4 mt-4">
        <p>© 2022 ITBOX. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
