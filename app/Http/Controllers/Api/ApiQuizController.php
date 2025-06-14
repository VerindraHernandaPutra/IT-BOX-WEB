<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApiQuizController extends Controller
{
    // START QUIZ
    public function start(Course $course)
    {
        $user = Auth::user();

        $questions = $course->questions()->inRandomOrder()->take(20)->get();

        $attempt = $user->quizAttempts()->create([
            'course_id' => $course->id,
            'score' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Quiz started',
            'attempt_id' => $attempt->id,
            'course_id' => $course->id,
            'questions' => $questions->map(function ($q) {
                return [
                    'id' => $q->id,
                    'question_text' => $q->question_text,
                    'option_a' => $q->option_a,
                    'option_b' => $q->option_b,
                    'option_c' => $q->option_c,
                    'option_d' => $q->option_d,
                ];
            }),
        ]);
    }

    // SUBMIT QUIZ
  public function submit(Request $request, Course $course)
    {
        $request->validate([
            'attempt_id' => 'required|integer',
            'answers' => 'required|array',
        ]);

        $user = Auth::user();

        $attempt = \App\Models\QuizAttempt::where('id', $request->attempt_id)
            ->where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$attempt) {
            return response()->json([
                'status' => 'error',
                'message' => 'Quiz attempt not found or does not belong to user.'
            ], 404);
        }

        $score = 0;

        foreach ($request->answers as $questionId => $answer) {
            $question = $course->questions()->find($questionId);
            if ($question && $question->correct_answer === $answer) {
                $score++;
            }
        }

        $percentage = ($score / 20) * 100;
        $attempt->update(['score' => $percentage]);

        $certificateIssued = false;

        if ($percentage >= 90) {
            $user->certificates()->firstOrCreate(['course_id' => $course->id]);
            $certificateIssued = true;
        }

        return response()->json([
            'status' => 'success',
            'score' => $percentage,
            'certificate_issued' => $certificateIssued,
        ]);
    }


    // FINISH QUIZ / CHECK RESULT
    public function finish(Course $course)
    {
        $user = Auth::user();

        $maxScore = $user->quizAttempts()
            ->where('course_id', $course->id)
            ->max('score');

        $certificate = $user->certificates()
            ->where('course_id', $course->id)
            ->first();

        return response()->json([
            'status' => 'success',
            'max_score' => $maxScore ?? 0,
            'certificate_issued' => $certificate !== null,
        ]);
    }
}
