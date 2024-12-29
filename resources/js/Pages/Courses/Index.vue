<template>
    <Head>
        <title>Courses - {{ studentProgram.name }}</title>
    </Head>

    <div class="min-h-screen bg-purple-50">
        <div class="max-w-7xl mx-auto p-6">
            <!-- Header Section -->
            <div
                class="relative mb-8 bg-gradient-to-r from-purple-900 to-pink-600 rounded-2xl p-8 shadow-lg overflow-hidden"
            >
                <div
                    class="absolute inset-0 bg-grid-white/[0.1] opacity-20"
                ></div>
                <div class="relative flex justify-between items-center">
                    <div>
                        <h1
                            class="text-5xl font-extrabold text-white tracking-tight"
                        >
                            My Courses
                        </h1>
                        <p class="mt-2 text-purple-100 text-lg">
                            Manage your academic journey
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div
                            class="p-3 bg-white/10 rounded-xl backdrop-blur-sm border border-white/20"
                        >
                            <svg
                                class="w-10 h-10 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-purple-400 rounded-full filter blur-3xl opacity-50"
                ></div>
                <div
                    class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-pink-400 rounded-full filter blur-3xl opacity-50"
                ></div>
            </div>

            <!-- Navigation Tabs -->
            <div class="mb-6 border-b border-purple-200">
                <nav class="flex space-x-8">
                    <Link
                        v-for="tab in tabs"
                        :key="tab.value"
                        :class="[
                                'px-6 py-2 font-medium',
                                $page.component === tab.component
                                    ? 'border-b-2 border-purple-600 text-purple-600'
                                    : 'text-gray-500 hover:text-purple-600',
                            ]"
                        :href="tab.route"
                        preserve-scroll
                    >
                        {{ tab.label }}
                    </Link>
                </nav>
            </div>

            <!-- Registration Notice -->
            <div
                class="bg-purple-700 text-white p-4 rounded-lg mb-6 text-center"
            >
                Late Registration period opens from November 8th, 2024 to
                November 10th, 2024.
            </div>

            <!-- Dynamic Tab Content -->
            <div class="tab-content">
                <!-- Manage Courses Tab -->
                <!--                <manage/>-->
                <!-- Registration Tab -->
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
                                        <div class="text-sm">
                                            Courses Registered
                                        </div>
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
                                <span
                                    class="absolute right-3 top-2.5 text-gray-400"
                                >
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
                            <div
                                class="bg-yellow-50 border-l-4 border-yellow-400 p-4"
                            >
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
                                <h3 class="text-lg font-semibold">
                                    Available Courses
                                </h3>
                                <div class="space-y-4">
                                    <div
                                        v-for="course in availableCourses"
                                        :key="course.id"
                                        class="p-4 border rounded-lg hover:border-purple-500 transition-colors cursor-pointer"
                                    >
                                        <div
                                            class="flex justify-between items-start"
                                        >
                                            <div>
                                                <h4 class="font-medium">
                                                    {{ course.code }}
                                                </h4>
                                                <p
                                                    class="text-sm text-gray-600"
                                                >
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
                                <h3 class="text-lg font-semibold">
                                    Selected Courses
                                </h3>
                                <div class="space-y-4">
                                    <div
                                        v-for="course in selectedCourses"
                                        :key="course.id"
                                        class="p-4 border rounded-lg bg-purple-50"
                                    >
                                        <div
                                            class="flex justify-between items-start"
                                        >
                                            <div>
                                                <h4 class="font-medium">
                                                    {{ course.code }}
                                                </h4>
                                                <p
                                                    class="text-sm text-gray-600"
                                                >
                                                    {{ course.name }}
                                                </p>
                                            </div>
                                            <button
                                                class="px-4 py-1 text-sm bg-red-100 text-red-600 rounded-full hover:bg-red-200"
                                                @click="
                                                        removeCourse(course)
                                                    "
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
                                    <span v-if="isSubmitting"
                                    >Processing...</span
                                    >
                                <span v-else>Complete Registration</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Manage Proctors Tab -->
                <div v-if="currentTab === 'proctors'">
                    <ProctorManagement
                        :proctorCourses="
                                studentProgram.courses.futureProctoredCourses
                            "
                    />
                </div>

                <!-- How To Tab -->
                <div
                    v-else-if="currentTab === 'howto'"
                    class="bg-white rounded-lg shadow-md p-6"
                >
                    <h2 class="text-2xl font-bold text-purple-900 mb-6">
                        How To Guide
                    </h2>
                    <!-- Add how-to content here -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Courses from "@/Components/Courses.vue";
import {Link, router} from "@inertiajs/vue3";
import ProctorManagement from "@/Components/ProctorManagement.vue";

export default defineComponent({
    layout: AppLayout,
    components: {
        AppLayout,
        Courses,
        Link,
        ProctorManagement,
    },
    props: {
        studentProgram: {
            type: Object,
            required: true,
        },
        availableCourses: {
            type: Object,
            required: true,
        },
        errors: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            currentTab: "manage",
            searchQuery: "",
            showAlert: false,
            alertMessage: "",
            alertTimeout: null,
            tabs: [
                {
                    label: "Manage Courses",
                    value: "manage",
                    route: route("courses.manage"),
                    component: "Courses/Manage",
                },
                {
                    label: "Registration",
                    value: "registration",
                    route: route("courses.registration"),
                    component: "Courses/Registration",
                },
                {
                    label: "Manage Proctors",
                    value: "proctors",
                    route: route("courses.proctors"),
                    component: "Courses/Proctors",
                },
                {
                    label: "How To",
                    value: "howto",
                    route: route("courses.howto"),
                    component: "Courses/HowTo",
                },
            ],
            checklist: [
                {text: "Run Degree Audit", completed: false},
                {text: "Register for classes", completed: false},
            ],
            selectedCourses: [],
        };
    },
    computed: {
        filteredCourses() {
            const query = this.searchQuery.toLowerCase();
            return this.availableCourses.filter(
                (course) =>
                    course.name.toLowerCase().includes(query) ||
                    course.code.toLowerCase().includes(query)
            );
        },
    },
    methods: {
        addCourse(course) {
            // Check if course is already selected
            if (this.selectedCourses.some((c) => c.id === course.id)) {
                this.showAlertMessage(
                    `${course.code} has already been added to your selection.`
                );
                return;
            }

            // Check maximum courses limit
            if (this.selectedCourses.length >= 4) {
                this.showAlertMessage("You can only select up to 4 courses.");
                return;
            }

            this.selectedCourses.push(course);
        },
        showAlertMessage(message) {
            if (this.alertTimeout) {
                clearTimeout(this.alertTimeout);
            }

            this.alertMessage = message;
            this.showAlert = true;

            this.alertTimeout = setTimeout(() => {
                this.showAlert = false;
                this.alertMessage = "";
            }, 3000);
        },
        removeCourse(course) {
            this.selectedCourses = this.selectedCourses.filter(
                (c) => c.id !== course.id
            );
            this.availableCourses.push(course);
        },
        resetSelection() {
            // Reset course selection logic
            this.availableCourses.push(...this.selectedCourses);
            this.selectedCourses = [];
        },
        async submitRegistration() {
            if (this.selectedCourses.length === 0) {
                this.showAlertMessage("Please select at least one course.");
                return;
            }

            this.isSubmitting = true;

            // Extract course IDs from selected courses
            const courseIds = this.selectedCourses.map((course) => course.id);

            // Send request to your controller
            router.post(
                "/courses/register",
                {
                    courses: courseIds,
                },
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        // Show success message and reset form
                        this.showAlertMessage(
                            "Courses registered successfully!"
                        );
                        this.resetSelection();
                        this.isSubmitting = false;
                    },
                    onError: (errors) => {
                        // Show error message
                        this.showAlertMessage(
                            errors.courses ||
                            "Failed to register courses. Please try again."
                        );
                        this.isSubmitting = false;
                    },
                }
            );
        },
    },
    beforeUnmount() {
        // Clear any remaining timeout when component is destroyed
        if (this.alertTimeout) {
            clearTimeout(this.alertTimeout);
        }
    },
});
</script>

<style scoped>
input[type="checkbox"] {
    @apply w-4 h-4 cursor-pointer;
}

button:disabled {
    @apply opacity-50 cursor-not-allowed;
}
</style>
