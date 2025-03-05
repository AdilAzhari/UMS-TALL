<template>
    <AppLayout>
        <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl font-bold text-gray-900 mb-8">
                    Academic History
                </h1>

                <!-- Cumulative GPA and Academic Progress -->
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                        Overall Progress
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <!-- Total Credits Taken -->
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-blue-500 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Credits Taken</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ academicProgress.totalCreditsTaken }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Credits Passed -->
                        <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-green-500 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Credits Passed</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ academicProgress.creditsPassed }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Credits Remaining -->
                        <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-purple-500 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Credits Remaining</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ academicProgress.creditsRemaining }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cumulative GPA -->
                    <div class="mt-6">
                        <p class="text-sm text-gray-600">Cumulative GPA</p>
                        <p class="text-4xl font-bold text-purple-600">
                            {{ cumulativeGPA }}
                        </p>
                    </div>
                </div>

                <!-- Term-wise Breakdown -->
                <div v-if="terms.length > 0">
                    <div v-for="(term, index) in terms" :key="index" class="bg-white rounded-xl shadow-lg p-8 mb-8">
                        <!-- Term Header -->
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-semibold text-gray-800">
                                {{ term.term.name }} (GPA: {{ term.gpa }})
                            </h2>
                            <p class="text-sm text-gray-600">
                                {{ formatDate(term.term.start_date) }} - {{ formatDate(term.term.end_date) }}
                            </p>
                        </div>

                        <!-- Term Summary -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Total Credits -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-lg">
                                <p class="text-sm text-gray-600">Total Credits</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ term.totalCredit }}
                                </p>
                            </div>
                            <!-- Credits Passed -->
                            <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg">
                                <p class="text-sm text-gray-600">Credits Passed</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ term.creditsPassed }}
                                </p>
                            </div>
                        </div>

                        <!-- Courses Table -->
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                            Courses Taken
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-sm">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-800">
                                        Course
                                    </th>
                                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-800">
                                        Code
                                    </th>
                                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-800">
                                        Credits
                                    </th>
                                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-800">
                                        Grade
                                    </th>
                                    <th class="py-3 px-6 text-left text-sm font-semibold text-gray-800">
                                        Status
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr
                                    v-for="(course, courseIndex) in term.courses"
                                    :key="courseIndex"
                                    class="border-b border-gray-100 hover:bg-gray-50 transition duration-200"
                                >
                                    <td class="py-4 px-6 text-gray-700">
                                        {{ course.course.name }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-700">
                                        {{ course.course.code }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-700">
                                        {{ course.course.credit_hours }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-700 font-semibold">
                                        {{ course.grade }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-700">
                                            <span
                                                :class="{
                                                    'bg-green-100 text-green-800': course.status === 'Completed',
                                                    'bg-red-100 text-red-800': course.status === 'Failed',
                                                    'bg-yellow-100 text-yellow-800': course.status === 'In Progress',
                                                }"
                                                class="px-3 py-1 text-sm rounded-full"
                                            >
                                                {{ course.status }}
                                            </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div v-else class="text-center text-gray-600">
                    No academic history available.
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import {format} from 'date-fns';

export default {
    components: {
        AppLayout,
    },
    props: {
        terms: {
            type: Array,
            required: true,
        },
        academicProgress: {
            type: Object,
            required: true,
        },
        cumulativeGPA: {
            type: String,
            required: true,
        },
        lastUpdated: {
            type: String,
            required: true,
        },
    },
    methods: {
        formatDate(date) {
            try {
                if (!date || isNaN(new Date(date).getTime())) {
                    return "N/A";
                }
                return format(new Date(date), 'MMM dd, yyyy');
            } catch (error) {
                console.error("Error formatting date:", error);
                return "N/A";
            }
        },
    },
};
</script>

<style scoped>
/* Add custom styles if needed */
</style>
