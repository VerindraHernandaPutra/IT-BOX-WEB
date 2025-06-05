<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function start(Course $course)
    {
        $user = Auth::user();
        $questions = $course->questions->shuffle()->take(20); // Random 20 questions
    
        $attempt = $user->quizAttempts()->create([
            'course_id' => $course->id,
            'score' => null, // Score will be calculated after submission
        ]);
    
        return view('quiz.start', compact('course', 'questions', 'attempt'));
    }

    public function submit(Request $request, Course $course)
    {
        $user = Auth::user();
        $attempt = $user->quizAttempts()->findOrFail($request->attempt_id);
    
        $score = 0;
        foreach ($request->answers as $questionId => $answer) {
            $question = $course->questions->find($questionId);
            if ($question && $question->correct_answer === $answer) {
                $score++;
            }
        }
    
        $percentage = ($score / 20) * 100;
        $attempt->update(['score' => $percentage]);
    
        if ($percentage >= 90) {
            $user->certificates()->firstOrCreate([
                'course_id' => $course->id,
            ]);
        }
    
        return redirect()->route('quiz.finish', $course->id)->with('score', $percentage);
    }
    
    public function finish(Course $course)
    {
        $user = Auth::user();
    
        // Retrieve the maximum score for this course
        $maxScore = $user->quizAttempts()
            ->where('course_id', $course->id)
            ->max('score');
    
        // Check if a certificate exists
        $certificate = $user->certificates()->where('course_id', $course->id)->first();
    
        return view('quiz.finish', compact('course', 'maxScore', 'certificate'));
    }
    

}
