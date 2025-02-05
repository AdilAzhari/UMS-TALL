<template>
    <div class="quiz-start bg-gray-100 min-h-screen p-6">
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ quiz.title }}</h1>
            <p class="text-gray-600 mt-2">{{ quiz.instructions }}</p>
            <p class="text-sm text-gray-500 mt-1">
                Duration: {{ quiz.duration }} minutes | Passing Score: {{ quiz.passing_score }}%
            </p>
        </header>

        <form @submit.prevent="submitQuiz">
            <div v-for="(question, index) in quiz.questions" :key="question.id" class="mb-6">
                <h2 class="text-lg font-medium text-gray-800">
                    Question {{ index + 1 }}: {{ question.question }}
                </h2>
                <ul class="space-y-2 mt-3">
                    <li v-for="option in question.answers" :key="option.id">
                        <label class="flex items-center space-x-3">
                            <input
                                type="radio"
                                :name="'question-' + question.id"
                                :value="option.id"
                                v-model="answers[question.id]"
                                class="form-radio text-indigo-600"
                            />
                            <span class="text-gray-700">{{ option.answer }}</span>
                        </label>
                    </li>
                </ul>
            </div>

            <button
                type="submit"
                class="bg-indigo-600 text-white py-2 px-6 rounded hover:bg-indigo-700 transition"
            >
                Submit Quiz
            </button>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        quiz: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            answers: {}, // Store the selected answers as { question_id: answer_id }
        };
    },
    methods: {
        async submitQuiz() {
            try {
                this.$inertia.post(`/quiz/${this.quiz.id}/submit`, {
                    answers: this.answers,
                });
            } catch (error) {
                console.error("Quiz submission failed:", error);
            }
        },
    },
};
</script>

<style scoped>
.quiz-start {
    font-family: 'Arial', sans-serif;
}
</style>
