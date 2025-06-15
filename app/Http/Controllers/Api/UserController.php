<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; // <-- THIS IS THE LINE YOU WERE MISSING

class UserController extends Controller
{

    public function updateProfileApi(Request $request)
    {
        $user = $request->user();

        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            // Add validation for the image
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Handle the file upload
        if ($request->hasFile('user_image')) {
            // Delete the old image if it exists
            if ($user->user_image) {
                // This line will now work correctly
                Storage::disk('public')->delete($user->user_image);
            }
            // Store the new image and get its path
            $path = $request->file('user_image')->store('profile_images', 'public');
            $user->user_image = $path;
        }

        // Update name and email
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        // Return a success response with the updated user data
        return response()->json([
            'message' => 'Profile updated successfully!',
            // Use .fresh() to get the model with the latest data, including the accessor
            'user' => $user->fresh(),
        ]);
    }

    public function getEnrolledCoursesApi(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $courses = $user->courses()->get()->map(function($course) {
            return [
                'id' => $course->id,
                'name' => $course->course_name,
                'hours' => $course->course_hour,
                'price' => $course->course_price,
                'type' => $course->course_type,
                'description' => $course->description,
                'thumbnail' => $course->thumbnail_url, // Uses the accessor from the Course model
            ];
        });

        return response()->json(['data' => $courses]);
    }

    public function getEnrolledCourseIdsApi(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $enrolledCourseIds = $user->courses()->pluck('course.id');
        return response()->json(['data' => $enrolledCourseIds]);
    }

    public function getActivityStatsApi(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // 1. Certificate count is the number of certificates the user has.
        $certificateCount = $user->certificates()->count();

        // 2. "Completed" courses are the ones for which a certificate has been issued.
        $completedCount = $certificateCount;

        // 3. "Incomplete" courses are total enrolled courses minus completed ones.
        $totalEnrolledCount = $user->courses()->count();
        $incompleteCount = $totalEnrolledCount - $completedCount;

        return response()->json([
            'incomplete' => $incompleteCount,
            'completed' => $completedCount,
            'certificates' => $certificateCount,
        ]);
    }
}