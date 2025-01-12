<template>
    <div class="quiz-page bg-gray-100 min-h-screen p-6">
        <!-- Quiz Header -->
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ quiz.title }}</h1>
            <p class="text-gray-600 mt-2">{{ quiz.description }}</p>
        </header>

        <!-- Question Navigation -->
        <div class="bg-white shadow rounded-lg p-4 mb-6 flex justify-between items-center">
            <div>
                <p class="text-gray-700">Question {{ currentQuestionIndex + 1 }} of {{ quiz.questions.length }}</p>
            </div>
            <button
                @click="submitQuiz"
                :disabled="!isQuizComplete"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Submit Quiz
            </button>
<!--            {{ currentQuestion.valueOf(question) }}-->
        </div>

        <!-- Current Question -->
        <div v-if="currentQuestion" class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ currentQuestion.question }}
            </h2>
            <div class="mt-4 space-y-2">
                <label
                    v-for="(option, index) in currentQuestion.quiz_question_options"
                    :key="index"
                    class="block bg-gray-50 border border-gray-200 rounded-lg p-3 cursor-pointer hover:bg-gray-100"
                >
                    <input
                        type="radio"
                        :name="`question-${currentQuestionIndex}`"
                        :value="option.id"
                        v-model="answers[currentQuestionIndex]"
                        class="mr-2"
                    />
                    {{ option.option }}
                </label>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between" v-if="quiz.questions.length">
            <button
                @click="prevQuestion"
                :disabled="currentQuestionIndex === 0"
                class="bg-gray-200 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-300 disabled:opacity-50"
            >
                Previous
            </button>
            <button
                @click="nextQuestion"
                :disabled="currentQuestionIndex === quiz.questions.length - 1"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 disabled:opacity-50"
            >
                Next
            </button>
        </div>

        <!-- Progress Indicator -->
        <div class="mt-6">
            <div class="flex justify-center space-x-2">
                <div
                    v-for="(question, index) in quiz.questions"
                    :key="index"
                    :class="[ 'w-3 h-3 rounded-full', answers[index] ? 'bg-green-500' : 'bg-gray-300' ]"
                ></div>
            </div>
        </div>
    </div>
</template>

<script>
import CampusLayout from "@/Layouts/CampusLayout.vue";

export default {
    layout: CampusLayout,
    name: 'QuizPage',
    props: {
        quiz: {
            type: Object,
            required: true,
            default: () => ({
                title: '',
                description: '',
                questions: []
            })
        },
        quizId: {
            type: [Number],
            required: true
        },
        courseId: {
            type: [String, Number],
            required: true
        },
        weekId: {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            currentQuestionIndex: 0,
            answers: [],
            submitting: false,
        };
    },
    computed: {
        currentQuestion() {
            return this.quiz.questions?.[this.currentQuestionIndex] || null;
        },
        isQuizComplete() {
            return this.quiz.questions.every((_, index) => this.answers[index] !== undefined);
        },
    },
    watch: {
        quiz: {
            immediate: true,
            handler(newQuiz) {
                if (newQuiz?.questions) {
                    this.answers = Array(newQuiz.questions.length).fill(null);
                }
            },
        },
    },
    mounted() {
        console.log(this.currentQuestion);
    },
    methods: {
        prevQuestion() {
            if (this.currentQuestionIndex > 0) {
                this.currentQuestionIndex--;
            }
        },
        nextQuestion() {
            if (this.currentQuestionIndex < this.quiz.questions.length - 1) {
                this.currentQuestionIndex++;
            }
        },
        submitQuiz() {
            if (!this.isQuizComplete || this.submitting) {
                return;
            }

            this.submitting = true;

            this.$inertia.post(route('campus.courses.weeks.quiz.submit', {
                courseId: this.courseId,
                weekId: this.weekId,
                quizId: this.quizId,
            }), {
                answers: this.answers,
                totalQuestions: this.quiz.questions.length,
            });
        },
    },
};
</script>

<style scoped>
.quiz-page {
    font-family: 'Arial', sans-serif;
}
</style>
