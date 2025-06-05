<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Course $course)
    {
        $materials = $course->materials; // Ambil semua materi terkait course
        return view('admin.material.list-materials', compact('course', 'materials'));
    }

    public function create(Course $course)
    {
        return view('admin.material.form-material', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'video_url' => 'required|url', // Validasi URL dasar
        ]);
    
        // Konversi URL menjadi embed URL
        $embedUrl = $this->convertYoutubeUrlToEmbed($request->video_url);
    
        // Jika URL tidak valid, kembalikan dengan error
        if (!$embedUrl) {
            return back()->withErrors(['video_url' => 'Invalid YouTube URL.']);
        }
    
        // Simpan material ke database
        $course->materials()->create([
            'topic' => $request->topic,
            'video_url' => $embedUrl,
        ]);
    
        return redirect()->route('materials.index', $course->id)->with('success', 'Material added successfully.');
    }    
    

    public function edit(Course $course, Material $material)
    {
        return view('admin.material.edit-material', compact('course', 'material'));
    }

    public function update(Request $request, Course $course, Material $material)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'video_url' => 'required|url', // Validasi URL dasar
        ]);
    
        // Konversi URL menjadi embed URL
        $embedUrl = $this->convertYoutubeUrlToEmbed($request->video_url);
    
        // Jika URL tidak valid, kembalikan dengan error
        if (!$embedUrl) {
            return back()->withErrors(['video_url' => 'Invalid YouTube URL.']);
        }
    
        // Update material di database
        $material->update([
            'topic' => $request->topic,
            'video_url' => $embedUrl,
        ]);
    
        return redirect()->route('materials.index', $course->id)->with('success', 'Material updated successfully.');
    }
    

    public function destroy(Course $course, Material $material)
    {
        $material->delete();

        return redirect()->route('course.index')->with('success', 'Material deleted successfully.');
    }

    private function convertYoutubeUrlToEmbed($url)
    {
        // Jika URL dalam format shortened (youtu.be)
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Jika URL dalam format standar (youtube.com/watch?v=)
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Jika URL sudah dalam format embed, gunakan langsung
        if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/', $url)) {
            return $url;
        }

        // Jika format tidak cocok, kembalikan URL asli (opsional: tambahkan validasi untuk memastikan URL valid)
        return null;
    }

}