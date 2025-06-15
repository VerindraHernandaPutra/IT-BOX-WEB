<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\ApiQuizController;
use App\Http\Controllers\Api\ApiCertificateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/courses', [CourseController::class, 'apiIndex']);
/* Route::get('/courses/{id}', [CourseController::class, 'apiShow']); */


// Protected routes (require authent    ication via Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) { // Example: get authenticated user
        return $request->user();
    });

    // Certificate routes - Fixed endpoints
    Route::get('/user/certificates', [ApiCertificateController::class, 'getUserCertificates']);
    Route::get('/certificates/{certificate}/download-pdf', [ApiCertificateController::class, 'downloadPdf']);

    Route::put('/user/profile', [UserController::class, 'updateProfileApi']);

    // Your existing protected course routes
    Route::post('/courses', [CourseController::class, 'apiStore']);
    Route::put('/courses/{id}', [CourseController::class, 'apiUpdate']);
    Route::delete('/courses/{id}', [CourseController::class, 'apiDestroy']);

    // New Enrollment Route
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enrollUserApi']); // Add this method to CourseController

    // New Route to get enrolled course IDs
    Route::get('/user/enrolled-courses-ids', [UserController::class, 'getEnrolledCourseIdsApi']); // Add this method to a UserController or similar
    Route::get('/user/enrolled-courses', [UserController::class, 'getEnrolledCoursesApi']);

    Route::get('/courses/{course}/materials', [MaterialController::class, 'indexApi']);

    // For Attempt Quiz
    Route::get('/courses/{course}/quiz/start', [ApiQuizController::class, 'start']);
    Route::post('/courses/{course}/quiz/submit', [ApiQuizController::class, 'submit']);
    Route::get('/courses/{course}/quiz/finish', [ApiQuizController::class, 'finish']);


    // Add other protected routes here (e.g., enrolling in a course, accessing user-specific materials)
});