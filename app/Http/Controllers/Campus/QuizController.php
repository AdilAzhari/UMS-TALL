<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestionResponse;
use App\Models\QuizSubmission;
use App\Models\Week;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Log;

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
            'weekId' => $weekId,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($quizId, $weekId): Response
    {
        // Fetch the quiz with questions that have at least one quiz_question_option
        $quiz = Quiz::where('id', $quizId)
            ->whereHas('questions.quizQuestionOptions', function ($query) {
                $query->whereNotNull('option'); // Ensure options are not null
            })
            ->with([
                'questions' => function ($query) {
                    $query->whereHas('quizQuestionOptions'); // Only load questions with options
                },
                'questions.quizQuestionOptions', // Eager load the options
            ])
            ->firstOrFail();
        $quiz->questions = $quiz->questions->filter(function ($question) {
            return $question->quizQuestionOptions->isNotEmpty();
        });
        return inertia::render('Campus/Quiz/Start', [
            'quiz' => $quiz,
            'quizId' => $quizId,
            'weekId' => $weekId,
            'courseId' => $quiz->course_id,
        ]);
    }

    public function submit(Request $request, int $quizId, int $weekId): RedirectResponse
    {
        try {
            // Validate the request
            $request->validate([
                'answers' => 'required|array',
                'answers.*' => 'required|integer|exists:quiz_question_options,id',
            ]);

            // Fetch the quiz with its questions and options
            $quiz = Quiz::with([
                'questions' => function ($query) {
                    $query->whereNotNull('option');
                },
                'questions.quizQuestionOptions', // Fetch all questions and their options
                'course',
            ])->findOrFail($quizId);

            // Filter out questions without options
            $quiz->questions = $quiz->questions->filter(function ($question) {
                return $question->quizQuestionOptions->isNotEmpty();
            });
            dd($quiz);
            // Verify the quiz has questions
            if ($quiz->questions->isEmpty()) {
                return redirect()->back()
                    ->with('message', 'This quiz has no questions yet. Please try again later.');
            }

            // Calculate the score
            $totalQuestions = $quiz->questions->count();
            $correctAnswers = 0;

            foreach ($quiz->questions as $question) {
                $submittedAnswerId = $request->answers[$question->id] ?? null;
                $correctAnswerId = $question->quizQuestionOptions->first()?->id;

                if ($submittedAnswerId && $correctAnswerId && $submittedAnswerId === $correctAnswerId) {
                    $correctAnswers++;
                }
            }

            // Calculate score percentage (safe division)
            $score = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;

            // Save the quiz submission
            DB::beginTransaction();
            try {
                $submission = QuizSubmission::create([
                    'quiz_id' => $quiz->id,
                    'student_id' => auth()->id(),
                    'score' => $score,
                    'total_questions' => $totalQuestions,
                    'correct_answers' => $correctAnswers,
                    'submitted_answers' => $request->answers,
                    'submitted_at' => now(),
                ]);

                // Save individual question responses
                foreach ($request->answers as $questionId => $answerId) {
                    QuizQuestionResponse::create([
                        'quiz_submission_id' => $submission->id,
                        'quiz_question_id' => $questionId,
                        'quiz_question_option_id' => $answerId,
                        'is_correct' => $quiz->questions
                                ->firstWhere('id', $questionId)
                                ->quizQuestionOptions
                                ->first()
                                ->id === $answerId,
                    ]);
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Failed to save quiz submission', [
                    'quiz_id' => $quizId,
                    'error' => $e->getMessage(),
                ]);
                return redirect()->back()
                    ->with('message', 'Failed to save your quiz submission. Please try again.');
            }

            return redirect()->route('campus.quiz.results', [
                'courseId' => $quiz->course_id,
                'weekId' => $weekId,
                'quizId' => $quizId,
            ])->with('success', "Quiz submitted successfully! You scored $score%");

        } catch (Exception $e) {
            Log::error('Quiz submission failed', [
                'quiz_id' => $quizId,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()
                ->with('message', 'An error occurred while submitting your quiz. Please try again.');
        }
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

        return inertia('Campus/Quiz/ResultsPage', [
            'submission' => $submission,
        ]);
    }
}
