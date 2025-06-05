<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course; // Your Course model
// use App\Models\Material; // Your Material model (ensure it exists)
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    private function convertYoutubeUrlToEmbed($url)
    {
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        // If URL is already in embed format
        if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $url;
        }
        return null; // Or return original URL, or handle error appropriately
    }

    public function indexApi(Request $request, Course $course)
    {
        $user = $request->user();

        // Optional: Check if user is enrolled in the course before showing materials
        if (!$user->courses()->where('course_id', $course->id)->exists()) {
            return response()->json(['message' => 'You are not enrolled in this course to view materials.'], 403); // Forbidden
        }

        $materials = $course->materials()->get()->map(function($material) {
            return [
                'id' => $material->id,
                'topic' => $material->topic,
                'video_url' => $this->convertYoutubeUrlToEmbed($material->video_url), // Ensure embed URL
                'course_id' => $material->course_id,
                // Add other material fields if any (e.g., description, order)
            ];
        });

        return response()->json(['data' => $materials]);
    }
}