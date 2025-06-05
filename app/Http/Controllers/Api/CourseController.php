<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User; // Only if User model is directly used here, otherwise Auth facade is enough
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CourseController extends Controller // The class name remains CourseController
{
    // All your methods (index, create, store, apiIndex, enrollUserApi, etc.)
    // will be here...

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This method returns a view, typically for web routes
        $course = Course::all();
        return view('admin.course', compact('course'));
    }

    // ... other web-specific methods like create, store (with redirect), edit, update (with redirect), destroy ...

    // Your API-specific methods
    public function apiIndex()
    {
        $courses = Course::all()->map(function($course) {
            return [
                'id' => $course->id,
                'name' => $course->course_name,
                'hours' => $course->course_hour,
                'price' => $course->course_price,
                'type' => $course->course_type,
                'description' => $course->description,
                'thumbnail' => $course->thumbnail, // Assuming thumbnail is the full URL from your API
                'created_at' => $course->created_at,
                'updated_at' => $course->updated_at
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $courses
        ]);
    }

    public function enrollUserApi(Request $request, Course $course)
    {
        $user = $request->user(); // Get authenticated user via Sanctum

        if (!$user) { // Additional check, though auth:sanctum middleware should handle this
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Check if already enrolled
        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return response()->json(['message' => 'You are already enrolled in this course.'], 409);
        }

        // Enroll the user
        $user->courses()->attach($course->id);

        return response()->json(['message' => 'Successfully enrolled in the course.', 'course_id' => $course->id], 201);
    }

    // ... other methods that were copied ...
}