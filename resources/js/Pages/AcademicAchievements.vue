<template>
    <AppLayout>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Summary -->
            <div
                class="bg-white border border-gray-200 rounded-lg shadow-md p-6 mb-8"
            >
                <h1 class="text-3xl font-bold text-purple-700 text-center mb-4">
                    Academic Achievements
                </h1>
                <div class="flex justify-between items-center text-gray-800">
                    <div>
                        <p class="text-lg font-medium">Total Credits Earned:</p>
                        <p class="text-2xl font-bold text-green-600">
                            {{ terms.totalCredit }}
                        </p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-medium">
                            Cumulative GPA (CGPA):
                        </p>
                        <p class="text-2xl font-bold text-purple-700">
                            {{ cumulativeGPA }}
                        </p>
                    </div>
                    <div>
                        <p class="text-lg font-medium">Completed Terms:</p>
                        <p class="text-2xl font-bold text-blue-600">
                            {{ terms.length }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Terms List -->
            <div v-for="(term, index) in terms" :key="index" class="mb-6">
                <!-- Collapsible Card -->
                <div
                    class="bg-white border border-gray-200 rounded-lg shadow-md p-5 hover:shadow-lg transition-shadow cursor-pointer"
                    @click="toggleTerm(index)"
                >
                    <!-- Summary Section -->
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">
                                {{ term.term.name }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Credits Taken:
                                <span class="font-medium text-gray-800">{{
                                    term.term.max_courses
                                }}</span
                                >, Credits Passed:
                                <span class="font-medium text-green-600">{{
                                    term.creditsPassed
                                }}</span>
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Term GPA:</p>
                            <p class="text-lg font-bold text-purple-700">
                                {{ term.gpa }}
                            </p>
                        </div>
                        <div
                            class="ml-4 text-gray-500 transition-transform transform"
                            :class="{ 'rotate-180': openTerm === index }"
                        >
                            <!-- Dropdown Icon -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Expanded Details Section -->
                <div
                    v-if="openTerm === index"
                    class="mt-4 bg-gray-50 border-l-4 border-purple-500 rounded-lg shadow-inner p-4"
                >
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">
                        Courses:
                    </h4>
                    <!-- Courses List -->
                    <div
                        v-for="(course, courseIndex) in term.courses"
                        :key="courseIndex"
                        class="mb-4"
                    >
                        <div
                            class="flex justify-between items-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow"
                        >
                            <div>
                                <p class="text-base font-bold text-gray-800">
                                    {{ course.course.name }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Code: {{ course.course.code }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Credit Hours: {{ course.course.credit }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Status:</p>
                                <span
                                    :class="{
                                        'text-green-600 font-bold':
                                            course.course.status === 1,
                                        'text-red-600 font-bold':
                                            course.course.status === 0,
                                    }"
                                >
                                    {{
                                        course.course.status === 1
                                            ? "Active"
                                            : "Inactive"
                                    }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
    },
    props: {
        terms: {
            type: Array,
            required: true,
        },
        cumulativeGPA: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            openTerm: null, // Tracks the currently expanded term
        };
    },
    methods: {
        toggleTerm(index) {
            this.openTerm = this.openTerm === index ? null : index;
        },
    },
};
</script>
