<template>
    <AppLayout>
        <!-- Main Container -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-12 px-4 lg:px-10">
            <div class="max-w-7xl mx-auto space-y-8">
                <!-- Hero Section -->
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl p-8 lg:p-12 shadow-2xl relative overflow-hidden">
                    <!-- Decorative Elements -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="w-full h-full bg-gradient-to-r from-purple-500 to-indigo-500 transform rotate-45"></div>
                    </div>
                    <div class="relative z-10">
                        <div class="flex flex-col lg:flex-row items-center justify-between space-y-6 lg:space-y-0">
                            <div>
                                <p class="text-xl lg:text-2xl font-light">
                                    You're pursuing a
                                    <span class="font-semibold">
                                        {{ studentProgram.program_type || "Program Type" }}
                                    </span>
                                    <span class="text-purple-300"> in </span>
                                </p>
                                <h1 class="text-3xl lg:text-5xl font-bold mt-2">
                                    {{ studentProgram.program_name || "Program Name" }}
                                </h1>
                            </div>
                            <div class="bg-white/10 p-4 rounded-lg text-center lg:text-right backdrop-blur-sm">
                                <p class="text-sm font-medium">Registration Deadline</p>
                                <p class="text-lg font-semibold">
                                    {{ studentProgram.registration_deadline }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Register for Classes Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="bg-purple-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-purple-800">
                                Sign Up for Classes
                            </h2>
                        </div>
                        <p class="text-gray-600 mb-6">
                            {{ $page.props.auth.user.name }}, registration is open until
                            <span class="font-semibold text-purple-600">
                                {{ studentProgram.registration_deadline }}
                            </span>.
                        </p>
                        <Link
                            :href="route('courses.registration')"
                            class="inline-block bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition duration-300"
                        >
                            Register Now
                        </Link>
                    </div>

                    <!-- Academic Progress Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="bg-purple-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-purple-800">
                                Academic Progress
                            </h2>
                        </div>
                        <p class="text-gray-600 mb-6">
                            Track your progress and stay on top of your goals.
                        </p>
                        <Link
                            :href="route('academic.progress')"
                            class="inline-block bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition duration-300"
                        >
                            View Progress
                        </Link>
                    </div>

                    <!-- Upcoming Deadlines Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-transform transform hover:scale-105">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="bg-purple-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-purple-800">
                                Upcoming Deadlines
                            </h2>
                        </div>
                        <p class="text-gray-600 mb-6">
                            Stay informed about important dates and deadlines.
                        </p>
<!--                        <Link-->
<!--                            :href="route('deadlines')"-->
<!--                            class="inline-block bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition duration-300"-->
<!--                        >-->
<!--                            View Deadlines-->
<!--                        </Link>-->
                    </div>
                </div>

                <!-- Courses Section -->
                <div class="bg-white rounded-xl shadow-lg p-6 lg:p-8">
                    <h2 class="text-2xl font-semibold text-purple-800 mb-6">
                        Your Courses - November 2024
                    </h2>

                    <!-- Tabs for Course Categories -->
                    <div class="flex space-x-4 mb-6">
                        <button
                            v-for="tab in tabs"
                            :key="tab.id"
                            :class="{
                                'bg-purple-600 text-white': activeView === tab.id,
                                'bg-gray-100 text-gray-700': activeView !== tab.id,
                            }"
                            class="py-2 px-4 rounded-lg focus:outline-none transition duration-300"
                            @click="activeView = tab.id"
                        >
                            {{ tab.label }}
                        </button>
                    </div>

                    <!-- Courses Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-purple-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-sm font-semibold text-purple-800">
                                    Course Name
                                </th>
                                <th class="py-3 px-6 text-left text-sm font-semibold text-purple-800">
                                    Status
                                </th>
                                <th class="py-3 px-6 text-left text-sm font-semibold text-purple-800">
                                    Proctor
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-for="course in filteredCourses"
                                :key="course.id"
                                class="border-b border-gray-100 hover:bg-gray-50 transition duration-200"
                            >
                                <td class="py-4 px-6 text-gray-700">
                                    {{ course.name }} ({{ course.code }})
                                </td>
                                <td class="py-4 px-6">
                                        <span
                                            :class="{
                                                'text-green-500': course.status === 'Completed',
                                                'text-gray-500': course.status === 'Enrolled',
                                                'text-red-500': course.status === 'Pending',
                                                'text-gray-400': course.status === 'Dropped',
                                            }"
                                        >
                                            {{ course.status }}
                                        </span>
                                </td>
                                <td class="py-4 px-6">
                                        <span
                                            :class="{
                                                'text-gray-500': !course.proctored,
                                                'text-purple-500 cursor-pointer': course.proctored && course.proctor_status === 'pending',
                                                'text-green-500': course.proctor_status === 'approved',
                                                'text-red-500': course.proctor_status === 'rejected',
                                            }"
                                        >
                                            {{
                                                !course.proctored
                                                    ? "Not Required"
                                                    : course.proctor_status === "pending"
                                                        ? "Assign a proctor"
                                                        : course.proctor_status
                                            }}
                                        </span>
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
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    props: {
        studentProgram: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            activeView: "future",
            tabs: [
                { id: "future", label: "Future Courses" },
                { id: "current", label: "Current Course" },
                { id: "past", label: "Past Courses" },
            ],
        };
    },
    computed: {
        filteredCourses() {
            if (this.activeView === "future") {
                return this.studentProgram.courses.futureCourses || [];
            } else if (this.activeView === "past") {
                return this.studentProgram.courses.pastCourses || [];
            }
            else if (this.activeView === "current") {
                return this.studentProgram.courses.currentCourses;
            }
            return [];
        },
    },
});
</script>

<style scoped>
/* Add custom styles if needed */
</style>
