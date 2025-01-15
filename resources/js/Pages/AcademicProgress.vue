<template>
    <AppLayout>
        <!-- Main Container -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-8 px-4 lg:px-8">
            <div class="max-w-6xl mx-auto space-y-6">
                <!-- Hero Section -->
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl p-6 lg:p-8 shadow-2xl relative overflow-hidden">
                    <!-- Decorative Elements -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="w-full h-full bg-gradient-to-r from-purple-500 to-indigo-500 transform rotate-45"></div>
                    </div>
                    <div class="relative z-10">
                        <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">
                            <div>
                                <p class="text-lg lg:text-xl font-light">
                                    Your Academic Progress
                                </p>
                                <h1 class="text-2xl lg:text-4xl font-bold mt-1">
                                    {{ studentProgram.program_name || "Program Name" }}
                                </h1>
                            </div>
                            <div class="bg-white/10 p-3 rounded-lg text-center lg:text-right backdrop-blur-sm">
                                <p class="text-xs font-medium">Current Term</p>
                                <p class="text-base font-semibold">
                                    {{ academicProgress.term || "Term Name" }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="bg-white rounded-xl shadow-lg p-4 lg:p-6">
                    <h2 class="text-xl font-semibold text-purple-800 mb-4">
                        Program Progress
                    </h2>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div
                            class="bg-purple-600 h-3 rounded-full"
                            :style="{ width: `${academicProgress.progress_percentage || 0}%` }"
                        ></div>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">
                        {{ academicProgress.progress_percentage || 0 }}% completed
                    </p>
                </div>

                <!-- Progress Metrics -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <!-- GPA Card -->
                    <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="bg-purple-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-purple-800">
                                GPA
                            </h2>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">
                            Your current GPA for this term.
                        </p>
                        <p class="text-2xl font-bold text-purple-600">
                            {{ academicProgress.gpa || "N/A" }}
                        </p>
                    </div>

                    <!-- CGPA Card -->
                    <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="bg-purple-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-purple-800">
                                CGPA
                            </h2>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">
                            Your cumulative GPA across all terms.
                        </p>
                        <p class="text-2xl font-bold text-purple-600">
                            {{ academicProgress.cgpa || "N/A" }}
                        </p>
                    </div>

                    <!-- Progress Percentage Card -->
                    <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="bg-purple-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-semibold text-purple-800">
                                Progress
                            </h2>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">
                            Your overall progress in the program.
                        </p>
                        <p class="text-2xl font-bold text-purple-600">
                            {{ academicProgress.progress_percentage || "0" }}%
                        </p>
                    </div>
                </div>

                <!-- Courses Breakdown -->
                <div class="bg-white rounded-xl shadow-lg p-4 lg:p-6">
                    <h2 class="text-xl font-semibold text-purple-800 mb-4">
                        Courses Breakdown
                    </h2>

                    <!-- Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Completed Courses Card -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 hover:shadow-lg transition-shadow duration-200">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-green-800">
                                    Completed
                                </h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">
                                Total courses completed
                            </p>
                            <p class="text-2xl font-bold text-green-600">
                                {{ academicProgress.total_courses_completed || 0 }}
                            </p>
                        </div>

                        <!-- Failed Courses Card -->
                        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-4 hover:shadow-lg transition-shadow duration-200">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-red-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-red-800">
                                    Failed
                                </h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">
                                Total courses failed
                            </p>
                            <p class="text-2xl font-bold text-red-600">
                                {{ academicProgress.total_courses_failed || 0 }}
                            </p>
                        </div>

                        <!-- Withdrawn Courses Card -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 hover:shadow-lg transition-shadow duration-200">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-gray-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-gray-800">
                                    Withdrawn
                                </h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">
                                Total courses withdrawn
                            </p>
                            <p class="text-2xl font-bold text-gray-600">
                                {{ academicProgress.total_courses_withdrawn || 0 }}
                            </p>
                        </div>

                        <!-- Total Courses Card -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 hover:shadow-lg transition-shadow duration-200">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-purple-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-purple-800">
                                    Total Courses
                                </h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">
                                Total courses in the program
                            </p>
                            <p class="text-2xl font-bold text-purple-600">
                                {{ academicProgress.total_courses || 0 }}
                            </p>
                        </div>

                        <!-- Total Credits Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 hover:shadow-lg transition-shadow duration-200">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-blue-800">
                                    Total Credits
                                </h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">
                                Total credits earned
                            </p>
                            <p class="text-2xl font-bold text-blue-600">
                                {{ academicProgress.total_credits || 0 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    props: {
        academicProgress: {
            type: Object,
            required: true,
        },
        studentProgram: {
            type: Object,
            required: true,
        },
    },
});
</script>

<style scoped>
/* Add custom styles if needed */
</style>
