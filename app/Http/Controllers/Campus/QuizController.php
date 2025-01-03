<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\Week;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuizController extends Controller
{
    public function index($courseId, $weekId): Response
    {
        $quizzes = Week::with('course')
            ->where('course_id', $courseId)
            ->where('id', $weekId)
            ->get();

        return inertia::render('Campus/Quiz/Index', [
            'quizzes' => $quizzes,
            'weekId' => $weekId
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($quizId, $weekId): Response
    {
        $quiz = Quiz::with([
            'questions.quizQuestionOptions',
        ])->find($quizId);
        dd($quizId,$weekId);
        return inertia::render('Campus/Quiz/Start', [
            'quiz' => $quiz,
            'quizId' => $weekId,
            'weekId' => $weekId,
            'courseId' => $quiz->course_id,
        ]);
    }

    public function submit(Request $request, $quizId)
    {
        $request->validate([
            'answers' => 'required|array',
//            'answers.*' => 'required|integer|exists:quiz_answers,id',
        ]);

        $quiz = Quiz::with('questions.quizQuestionOptions')->find($quizId);

        dd($request->all(),$quizId,$quiz);

        $totalQuestions = $quiz->questions->count();
        $correctAnswers = 0;

        dd($totalQuestions . $correctAnswers, $quiz->questions->count());
        foreach ($quiz->questions as $question) {
            $submittedAnswerId = $request->answers[$question->id] ?? null;
            if ($submittedAnswerId) {
                $isCorrect = $question->answers->where('id', $submittedAnswerId)->first()?->is_correct;
                if ($isCorrect) {
                    $correctAnswers++;
                }
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;

        // Save the submission
        QuizSubmission::create([
            'quiz_id' => $quiz->id,
            'student_id' => auth()->id(),
            'score' => $score,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
        ]);

        return redirect()->route('campus.quiz.results', $quizId)->with('message', 'Quiz submitted successfully!');
    }

    /**
     * Show the quiz results.
     */
    public function results($quizId)
    {
        $submission = QuizSubmission::with('quiz')
            ->where('quiz_id', $quizId)
            ->where('student_id', auth()->id())
            ->firstOrFail();

        return inertia('Campus/Quiz/Results', [
            'submission' => $submission,
        ]);
    }
}
