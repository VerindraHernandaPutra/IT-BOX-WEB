<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CertificateController;


use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Courses
Route::get('/courses', [CourseController::class, 'publicCourses'])->name('courses.public');
Route::resource('course', CourseController::class);
Route::get('/api/courses', [CourseController::class, 'apiIndex']);

// Protected Routes for Authenticated Users
Route::middleware(['auth'])->group(function () {

    // My Courses
    Route::get('/my-courses', [CourseController::class, 'userCourses'])->name('courses.user');
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');

    // Materials and Quiz for My Courses
    Route::get('/my-courses/{course}/materials', [CourseController::class, 'showMaterials'])->name('courses.materials');
    Route::get('/my-courses/{course}/quiz/', [QuizController::class, 'finish'])->name('quiz.finish');
    Route::get('/my-courses/{course}/quiz/start', [QuizController::class, 'start'])->name('quiz.start');
    Route::post('/my-courses/{course}/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');

    // Certificates
    Route::get('/certificate/{certificate}/download-pdf', [CertificateController::class, 'downloadPdf'])->name('certificate.download.pdf');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Skill Track Page
Route::get('/skilltrack', function () {
    return view('skilltrack');
})->name('skilltrack');



// Profil User (Auth Middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Route File
require __DIR__ . '/auth.php';

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard Admin
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    // CRUD untuk Course
    Route::resource('admin/course', CourseController::class);

    // Material Routes (terkait Course)
    Route::prefix('admin/course/{course}/materials')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('materials.index'); // List Semua Material
        Route::get('/create', [MaterialController::class, 'create'])->name('materials.create'); // Form Create Material
        Route::post('/', [MaterialController::class, 'store'])->name('materials.store'); // Simpan Material Baru
        Route::get('/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit'); // Form Edit Material
        Route::put('/{material}', [MaterialController::class, 'update'])->name('materials.update'); // Update Material
        Route::delete('/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy'); // Hapus Material
    });
});


// Question Routes
Route::prefix('admin/course/{course}/questions')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('admin.questions.index');
    Route::get('/create', [QuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('/', [QuestionController::class, 'store'])->name('admin.questions.store');
    Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::put('/{question}', [QuestionController::class, 'update'])->name('admin.questions.update');
    Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('admin.questions.destroy');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
