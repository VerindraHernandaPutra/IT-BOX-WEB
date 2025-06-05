<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();

        return view('admin.course', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_hour' => 'required|integer',
            'course_price' => 'required|integer',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Proses upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $validatedData['thumbnail'] = $path;
        }
    
        Course::create($validatedData);
    
        return redirect()->route('course.index')->with('success', 'Course berhasil ditambahkan.');
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.edit', ['course' => Course::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_hour' => 'required|integer',
            'course_price' => 'required|integer',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload thumbnail baru jika ada
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($course->thumbnail != null) Storage::delete($course->thumbnail);
    
            // Proses upload thumbnail baru jika ada
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::where('id', $course->id)->update($validatedData); 
    
        return redirect()->route('course.index')->with('success', 'Course berhasil diperbarui.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::find($id)->delete();

        return redirect()->route('course.index');
    }

    public function publicCourses()
    {
        $courses = Course::all();
        return view('courses.public', compact('courses'));
    }

    public function userCourses()
    {
        $user = Auth::user();
        $courses = $user->enrolledCourses;
        return view('courses.user', compact('courses'));
    }

    public function enroll(Course $course)
    {
        $user = Auth::user();

        if ($user->enrolledCourses->contains($course->id)) {
            return redirect()->route('courses.user')->with('message', 'Anda sudah terdaftar di kursus ini.');
        }

        $user->enrolledCourses()->attach($course->id);
        return redirect()->route('courses.user')->with('message', 'Berhasil mendaftar kursus.');
    }

    public function showMaterials(Course $course)
    {
        $user = Auth::user();
    
        if (!$user->enrolledCourses->contains($course->id)) {
            return redirect()->route('courses.user')->with('error', 'Anda belum terdaftar di kursus ini.');
        }
    
        $materials = $course->materials;
        $certificate = $user->certificates()->where('course_id', $course->id)->first();
    
        return view('courses.materials', compact('course', 'materials', 'certificate'));
    }
    

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
                'thumbnail' => $course->thumbnail_url,
                'created_at' => $course->created_at,
                'updated_at' => $course->updated_at
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $courses
        ]);
    }

}