<template>
    <AppLayout>
        <div class="bg-gray-50 min-h-screen py-8 px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">
                    Academic Achievements
                </h1>

                <!-- Cumulative GPA and Academic Progress -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        Overall Progress
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Total Credits Taken -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Total Credits Taken</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ academicProgress.totalCreditsTaken }}
                            </p>
                        </div>
                        <!-- Credits Passed -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Credits Passed</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ academicProgress.creditsPassed }}
                            </p>
                        </div>
                        <!-- Credits Remaining -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Credits Remaining</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ academicProgress.creditsRemaining }}
                            </p>
                        </div>
                    </div>
                    <!-- Cumulative GPA -->
                    <div class="mt-6">
                        <p class="text-sm text-gray-600">Cumulative GPA</p>
                        <p class="text-3xl font-bold text-purple-600">
                            {{ cumulativeGPA }}
                        </p>
                    </div>
                    <!-- Last Updated -->
                    <div class="mt-6">
                        <p class="text-sm text-gray-600">Last Updated</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ formatDate(lastUpdated) }}
                        </p>
                    </div>
                </div>

                <!-- Term-wise Breakdown -->
                <div v-for="(term, index) in terms" :key="index" class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        {{ term.term.name }} (GPA: {{ term.gpa }})
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Total Credits -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Total Credits</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ term.totalCredit }}
                            </p>
                        </div>
                        <!-- Credits Passed -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Credits Passed</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ term.creditsPassed }}
                            </p>
                        </div>
                    </div>
                    <!-- Courses and Grades -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Courses and Grades
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-sm font-semibold text-gray-800">
                                    Course
                                </th>
                                <th class="py-3 px-6 text-left text-sm font-semibold text-gray-800">
                                    Grade
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
                                    {{ course.course.name }} ({{ course.course.code }})
                                </td>
                                <td class="py-4 px-6 text-gray-700 font-semibold">
                                    {{ course.grade }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { format } from 'date-fns';

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
                // Ensure the date is valid before formatting
                if (!date || isNaN(new Date(date).getTime())) {
                    return "N/A"; // Return a fallback value for invalid dates
                }
                return format(new Date(date), 'MMM dd, yyyy');
            } catch (error) {
                console.error("Error formatting date:", error);
                return "N/A"; // Return a fallback value if formatting fails
            }
        },
    },
};
</script>

<style scoped>
/* Add custom styles if needed */
</style>
