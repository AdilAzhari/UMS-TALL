<template>
    <div class="quiz-results bg-gray-100 min-h-screen p-6">
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Quiz Results</h1>
            <p class="text-gray-600 mt-2">For: {{ submission.quiz.title }}</p>
        </header>

        <div class="bg-white shadow rounded-lg p-6">
            <p class="text-lg text-gray-800">
                Score: {{ submission.score }}%
            </p>
            <p class="text-gray-600">
                Correct Answers: {{ submission.correct_answers }} / {{ submission.total_questions }}
            </p>

            <div v-if="submission.score >= submission.quiz.passing_score" class="mt-4 text-green-600">
                Congratulations! You passed the quiz.
            </div>
            <div v-else class="mt-4 text-red-600">
                Better luck next time! Keep practicing.
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        submission: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style scoped>
.quiz-results {
    font-family: 'Arial', sans-serif;
}
</style>
