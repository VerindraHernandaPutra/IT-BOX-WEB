<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\QuizAttempt; // Make sure to import QuizAttempt
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiQuizController extends Controller
{
    /**
     * Start a new quiz attempt.
     */
    public function start(Course $course)
    {
        $user = Auth::user();

        // Get 20 random questions for the course
        $questions = $course->questions()->inRandomOrder()->take(20)->get();

        // Create a new attempt record
        $attempt = $user->quizAttempts()->create([
            'course_id' => $course->id,
            'score' => null, // Score is null until submitted
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Quiz started',
            'attempt_id' => $attempt->id,
            'course_id' => $course->id,
            // Map questions to exclude the correct_answer
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

    /**
     * Submit answers and calculate the quiz score.
     */
    public function submit(Request $request, Course $course)
    {
        $request->validate([
            'attempt_id' => 'required|integer|exists:quiz_attempts,id',
            'answers' => 'required|array',
        ]);

        $user = Auth::user();

        $attempt = QuizAttempt::where('id', $request->attempt_id)
            ->where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$attempt || $attempt->score !== null) { // Also check if already submitted
            return response()->json([
                'status' => 'error',
                'message' => 'Quiz attempt not found or already submitted.'
            ], 404);
        }

        $score = 0;
        $questionIds = array_keys($request->answers);
        $questions = $course->questions()->findMany($questionIds);

        foreach ($request->answers as $questionId => $answer) {
            $question = $questions->find($questionId);
            if ($question && $question->correct_answer === $answer) {
                $score++;
            }
        }

        $totalQuestions = count($request->answers);
        $percentage = ($totalQuestions > 0) ? (($score / $totalQuestions) * 100) : 0;
        $attempt->update(['score' => $percentage]);

        $certificateIssued = false;
        $certificateId = null;

        if ($percentage >= 90) {
            // ===================================
            // THE FIX IS HERE
            // ===================================
            // Assign the created certificate to the $certificate variable
            $certificate = $user->certificates()->firstOrCreate(
                ['course_id' => $course->id, 'user_id' => $user->id]
            );

            $certificateIssued = true;
            $certificateId = $certificate->id; // Now this line will work correctly
        }

        return response()->json([
            'status' => 'success',
            'score' => $percentage,
            'certificate_issued' => $certificateIssued,
            'certificate_id' => $certificateId, // Pass the new ID to Flutter
        ]);
    }
}
