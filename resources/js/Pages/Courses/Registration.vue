<template>
    <Head>
        <title>Courses</title>
    </Head>
    <!-- Registration.vue -->
    <div
        v-if="currentTab === 'registration'"
        class="bg-white rounded-lg shadow-md"
    >
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-4xl font-bold text-purple-900">
                    PLAN YOUR NEXT TERM - NOVEMBER 2024
                </h1>
                <div class="relative w-32 h-32">
                    <div
                        class="w-32 h-32 rounded-full border-8 border-emerald-400 flex items-center justify-center"
                    >
                        <div class="text-center">
                            <div class="text-3xl font-bold">
                                {{ selectedCourses.length }}/4
                            </div>
                            <div class="text-sm">Courses Registered</div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-purple-900 mb-6">
                Course Registration
            </h2>
            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <input
                        v-model="searchQuery"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Search courses by name or code..."
                        type="text"
                    />
                    <span class="absolute right-3 top-2.5 text-gray-400">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                />
                            </svg>
                        </span>
                </div>
            </div>
            <!-- Alert Message -->
            <div v-if="showAlert" class="mb-6">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg
                                class="h-5 w-5 text-yellow-400"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    clip-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    fill-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                {{ alertMessage }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Available Courses -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Available Courses</h3>
                    <div class="space-y-4">
                        <div
                            v-for="course in availableCourses"
                            :key="course.id"
                            class="p-4 border rounded-lg hover:border-purple-500 transition-colors cursor-pointer"
                        >
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium">
                                        {{ course.code }}
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        {{ course.name }}
                                    </p>
                                </div>
                                <button
                                    class="px-4 py-1 text-sm bg-purple-100 text-purple-600 rounded-full hover:bg-purple-200"
                                    @click="addCourse(course)"
                                >
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selected Courses -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Selected Courses</h3>
                    <div class="space-y-4">
                        <div
                            v-for="course in selectedCourses"
                            :key="course.id"
                            class="p-4 border rounded-lg bg-purple-50"
                        >
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium">
                                        {{ course.code }}
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        {{ course.name }}
                                    </p>
                                </div>
                                <button
                                    class="px-4 py-1 text-sm bg-red-100 text-red-600 rounded-full hover:bg-red-200"
                                    @click="removeCourse(course)"
                                >
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registration Actions -->
            <div class="mt-8 flex justify-end space-x-4">
                <button
                    class="px-6 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200"
                    @click="resetSelection"
                >
                    Reset
                </button>
                <button
                    :disabled="isSubmitting"
                    class="px-6 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600"
                    @click="submitRegistration"
                >
                    <span v-if="isSubmitting">Processing...</span>
                    <span v-else>Complete Registration</span>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
    data() {
        return {
            currentTab: "registration",
            searchQuery: "",
            showAlert: false,
            alertMessage: "",
            isSubmitting: false,
            availableCourses: [
                {
                    id: 1,
                    code: "CSE101",
                    name: "Introduction to Computer Science",
                },
                {
                    id: 2,
                    code: "MTH101",
                    name: "Calculus I",
                },
                {
                    id: 3,
                    code: "PHY101",
                    name: "Physics I",
                },
                {
                    id: 4,
                    code: "ENG101",
                    name: "English Composition",
                },
            ],
            selectedCourses: [],
        };
    },

    computed: {
        filteredCourses() {
            return this.availableCourses.filter((course) => {
                return (
                    course.name
                        .toLowerCase()
                        .includes(this.searchQuery.toLowerCase()) ||
                    course.code
                        .toLowerCase()
                        .includes(this.searchQuery.toLowerCase())
                );
            });
        },
    },

    methods: {
        addCourse(course) {
            if (this.selectedCourses.length >= 4) {
                this.showAlert = true;
                this.alertMessage = "You can only register for 4 courses.";
                setTimeout(() => {
                    this.showAlert = false;
                }, 3000);
                return;
            }

            this.selectedCourses.push(course);
        },

        removeCourse(course) {
            this.selectedCourses = this.selectedCourses.filter(
                (c) => c.id !== course.id
            );
        },

        resetSelection() {
            this.selectedCourses = [];
        },

        submitRegistration() {
            this.isSubmitting = true;
            setTimeout(() => {
                this.isSubmitting = false;
                this.selectedCourses = [];
                this.showAlert = true;
                this.alertMessage = "Registration completed successfully.";
                setTimeout(() => {
                    this.showAlert = false;
                }, 3000);
            }, 2000);
        },
    },
};
</script>
<style>
/* Custom styling */
</style>
