<template>
    <div class="bg-gray-50 min-h-screen p-6">
        <!-- Header with Filter -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <h1 class="text-2xl font-bold text-gray-900">Available Quizzes</h1>
                <div class="mt-4 md:mt-0">
                    <select
                        v-model="statusFilter"
                        class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="all">All Quizzes</option>
                        <option value="published">Available</option>
                        <option value="draft">Upcoming</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Quiz Cards -->
        <div class="max-w-7xl mx-auto">
            <div class="space-y-6">
                <div
                    v-for="quiz in filteredQuizzes"
                    :key="quiz.id"
                    class="bg-white shadow rounded-lg overflow-hidden"
                >
                    <!-- Quiz Header -->
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span
                                    :class="{
                                        'bg-blue-100 text-blue-800': quiz.type === 'graded',
                                        'bg-gray-100 text-gray-600': quiz.type === 'ungraded'
                                    }"
                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium"
                                >
                                    {{ quiz.type }}
                                </span>
                                <h3 class="text-lg font-medium text-gray-900">{{ quiz.title }}</h3>
                            </div>
                            <span
                                :class="{
                                    'bg-green-100 text-green-800': quiz.status === 'published',
                                    'bg-yellow-100 text-yellow-800': quiz.status === 'draft',
                                    'bg-gray-100 text-gray-800': quiz.status === 'closed'
                                }"
                                class="px-2.5 py-0.5 rounded-full text-xs font-medium"
                            >
                                {{ quiz.status }}
                            </span>
                        </div>
                    </div>

                    <!-- Quiz Content -->
                    <div class="px-6 py-4">
                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ quiz.description }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Instructions</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ quiz.instructions }}</p>
                            </div>
                        </div>

                        <!-- Quiz Details -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-4 border-t border-b border-gray-200">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Duration</span>
                                <p class="mt-1 text-sm text-gray-900">{{ quiz.duration }} minutes</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Code</span>
                                <p class="mt-1 text-sm text-gray-900">{{ quiz.code }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Start Date</span>
                                <p class="mt-1 text-sm text-gray-900">{{ formatDate(quiz.start_date) }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">End Date</span>
                                <p class="mt-1 text-sm text-gray-900">{{ formatDate(quiz.end_date) }}</p>
                            </div>
                        </div>

                        <!-- Action Footer -->
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center">
                                <span class="text-sm text-gray-500">
                                    Passing Score: {{ quiz.passing_score }}%
                                </span>
                            </div>
<!--                            quiz Id: {{ quiz.id }}-->
<!--                            <br>-->
<!--                            Course Id: {{ quiz.course.id }}-->

                            <button
                                @click="viewQuiz(route('campus.courses.weeks.quiz.show', {
                                    courseId: quiz.course.id,
                                    weekId: weekId,
                                    quizId: quiz.id,
                                }))"
                                :disabled="quiz.status == 'published'"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-gray-300 disabled:cursor-not-allowed"
                            >
                                {{ getButtonText(quiz.status) }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div
                v-if="!filteredQuizzes.length"
                class="text-center py-12 bg-white rounded-lg shadow"
            >
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No quizzes available</h3>
                <p class="mt-1 text-sm text-gray-500">Check back later for new quizzes</p>
            </div>
        </div>
    </div>
</template>

<script>
import { format } from 'date-fns';
import campusLayout from "@/Layouts/CampusLayout.vue";
export default {
    layout: campusLayout,
    name: "QuizIndex",
    props: {
        quizzes: {
            type: Array,
            required: true
        },
        weekId: {
            type: [Number, String],
            required: true
        }
    },
    data() {
        return {
            statusFilter: 'all'
        };
    },
    computed: {
        filteredQuizzes() {
            if (this.statusFilter === 'all') {
                return this.quizzes;
            }
            return this.quizzes.filter(quiz => quiz.status === this.statusFilter);
        }
    },
    methods: {
        formatDate(date) {
            return format(new Date(date), 'MMM dd, yyyy');
        },
        viewQuiz(route) {
            this.$inertia.visit(route);
        },
        getButtonText(status) {
            switch (status) {
                case 'published':
                    return 'Start Quiz';
                case 'draft':
                    return 'Coming Soon';
                case 'closed':
                    return 'Closed';
                default:
                    return 'Start Quiz';
            }
        }
    }
};
</script>
