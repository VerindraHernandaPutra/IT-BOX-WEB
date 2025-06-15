<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
// Assuming your Course model has an accessor for thumbnail_url if needed,
// or that 'thumbnail' field already contains the full URL.

class UserController extends Controller
{

    public function updateProfileApi(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Email must be unique, except for the current user
            ],
            // If you want to allow password changes here, uncomment and adjust:
            // 'current_password' => 'nullable|string|required_with:new_password',
            // 'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Example for password update (ensure you have 'new_password_confirmation' field from client)
        // if (!empty($validatedData['new_password'])) {
        //     if (!Hash::check($validatedData['current_password'], $user->password)) {
        //         return response()->json(['errors' => ['current_password' => ['Current password does not match.']]], 422);
        //     }
        //     $user->password = Hash::make($validatedData['new_password']);
        // }

        $user->save();

        // Return the updated user data (excluding sensitive info)
        return response()->json([
            'message' => 'Profile updated successfully.',
            'user' => [
                // It's good practice to return the updated user object
                // so the frontend can use it directly if needed.
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                // Add other relevant, non-sensitive fields
            ]
        ], 200);
    }

    public function getEnrolledCoursesApi(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $courses = $user->courses()->get()->map(function($course) {
            // Format this to match the structure your Flutter Course model expects
            // and what your /api/courses (all courses) endpoint returns
            return [
                'id' => $course->id,
                'name' => $course->course_name, // From DB
                'hours' => $course->course_hour, // From DB
                'price' => $course->course_price, // From DB
                'type' => $course->course_type,   // From DB
                'description' => $course->description,
                'thumbnail' => $course->thumbnail_url, // Assuming this is the full URL
                                                   // or $course->thumbnail_url if you have an accessor
                // Add any other fields your Flutter CourseCard might need
            ];
        });

        return response()->json(['data' => $courses]);
    }

    // getEnrolledCourseIdsApi can remain if needed elsewhere, or be removed if this replaces its use case
    public function getEnrolledCourseIdsApi(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $enrolledCourseIds = $user->courses()->pluck('course.id');
        return response()->json(['data' => $enrolledCourseIds]);
    }
}