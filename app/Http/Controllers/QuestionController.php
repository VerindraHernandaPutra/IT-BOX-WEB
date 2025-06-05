<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Course $course)
    {
        $questions = $course->questions; // Fetch related questions
        return view('admin.questions.index', compact('course', 'questions'));
    }

    public function create(Course $course)
    {
        return view('admin.questions.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:option_a,option_b,option_c,option_d',
        ]);

        $course->questions()->create($validated);

        return redirect()->route('admin.questions.index', $course->id)->with('success', 'Question added successfully.');
    }

    public function edit(Course $course, Question $question)
    {
        return view('admin.questions.edit', compact('course', 'question'));
    }

    public function update(Request $request, Course $course, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:option_a,option_b,option_c,option_d',
        ]);

        $question->update($validated);

        return redirect()->route('admin.questions.index', $course->id)->with('success', 'Question updated successfully.');
    }

    public function destroy(Course $course, Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index', $course->id)->with('success', 'Question deleted successfully.');
    }
}
