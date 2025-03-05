<template>
    <div class="results-page bg-gray-100 min-h-screen p-6">
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Quiz Results</h1>
        </header>

        <div class="bg-white shadow rounded-lg p-6">
            <p class="text-lg text-gray-700">
                You scored {{ submission.score }}% ({{ submission.correct_answers }} out of {{ submission.total_questions }} correct).
            </p>
            <p v-if="submission.score >= 70" class="text-green-600 mt-2">Congratulations! You passed the quiz.</p>
            <p v-else class="text-red-600 mt-2">Sorry, you did not pass the quiz. Please try again.</p>
        </div>
    </div>
</template>

<script>
import CampusLayout from "@/Layouts/CampusLayout.vue";

export default {
    layout: CampusLayout,
    name: 'ResultsPage',
    props: {
        submission: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style scoped>
.results-page {
    font-family: 'Arial', sans-serif;
}
</style>
