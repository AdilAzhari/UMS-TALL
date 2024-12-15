<template>
    <AppLayout>
        <div
            class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-12 px-4 lg:px-10"
        >
            <!-- Main Container -->
            <div
                class="max-w-7xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden"
            >
                <!-- Hero Section with Program Information -->
                <div
                    class="relative bg-purple-800 text-white py-10 px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between space-y-6 lg:space-y-0"
                >
                    <div>
                        <p class="text-xl lg:text-2xl">
                            You're pursuing a
                            <span class="font-semibold">
                                {{
                                    studentProgram.program_type ||
                                    "Program Type"
                                }}
                            </span>
                            <span class="text-purple-500"> IN </span>
                        </p>

                        <h1 class="text-3xl lg:text-5xl font-bold mb-2">
                            {{ studentProgram.program_name || "Program Name" }}
                        </h1>
                    </div>
                    <div class="space-y-2 text-sm">
                        <p
                            class="bg-purple-700 py-2 px-4 rounded-full font-semibold"
                        >
                            Registration Deadline:
                            {{ studentProgram.registration_deadline }}
                        </p>
                    </div>
                </div>

                <!-- Core Sections Split into Cards -->
                <div
                    class="grid grid-cols-1 lg:grid-cols-3 gap-8 px-6 lg:px-12 py-10"
                >
                    <!-- Sign Up for Classes Section -->
                    <div
                        class="bg-white shadow-lg rounded-lg p-8 flex flex-col items-center justify-between transform transition-transform hover:-translate-y-2 hover:shadow-xl"
                    >
                        <h2 class="text-2xl font-semibold text-purple-800 mb-4">
                            Sign Up for Classes
                        </h2>
                        <p class="text-gray-700 mb-6 text-center">
                            {{ $page.props.auth.user.name }}, registration is
                            now open until
                            <span class="font-semibold text-purple-600">{{
                                studentProgram.registration_deadline
                            }}</span
                            >!
                        </p>
                        <Link
                            :href="route('courses.register')"
                            class="bg-purple-600 text-white px-8 py-2 rounded-full shadow-lg hover:bg-purple-700 transition duration-300 focus:outline-none"
                        >
                            Register Now
                        </Link>
                    </div>

                    <!-- Academic Progress Section -->
                    <AcademicProgress :studentProgram="studentProgram" />
                </div>

                <!-- Courses List Section with Tabs -->
                <div class="px-6 lg:px-12 py-10">
                    <h2 class="text-2xl font-semibold text-purple-800 mb-6">
                        Your Courses - November 2024
                    </h2>

                    <!-- Tabs for Switching Course Categories -->
                    <div class="flex space-x-4 mb-6">
                        <button
                            :class="{
                                'bg-purple-600 text-white':
                                    activeView === 'future',
                                'bg-gray-200 text-gray-700':
                                    activeView !== 'future',
                            }"
                            class="py-2 px-4 rounded-lg focus:outline-none"
                            @click="activeView = 'future'"
                        >
                            Future Courses
                        </button>
                        <button
                            :class="{
                                'bg-purple-600 text-white':
                                    activeView === 'past',
                                'bg-gray-200 text-gray-700':
                                    activeView !== 'past',
                            }"
                            class="py-2 px-4 rounded-lg focus:outline-none"
                            @click="activeView = 'past'"
                        >
                            Past Courses
                        </button>
                    </div>

                    <!-- Courses Table -->
                    <div
                        class="bg-gray-50 shadow-lg rounded-lg overflow-hidden"
                    >
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="py-3 px-6 bg-purple-800 text-white text-left text-sm font-semibold"
                                    >
                                        Course Name
                                    </th>
                                    <th
                                        class="py-3 px-6 bg-purple-800 text-white text-left text-sm font-semibold"
                                    >
                                        Status
                                    </th>
                                    <th
                                        class="py-3 px-6 bg-purple-800 text-white text-left text-sm font-semibold"
                                    >
                                        Proctor
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="course in filteredCourses"
                                    :key="course.id"
                                    class="border-b border-gray-200"
                                >
                                    <td class="py-4 px-6">
                                        {{ course.name }} ({{ course.code }})
                                    </td>
                                    <td class="py-4 px-6">
                                        <span
                                            v-if="
                                                course.status === 'Registered'
                                            "
                                            class="text-green-500"
                                            >Registered</span
                                        >
                                        <span
                                            v-else-if="
                                                course.status ===
                                                'Request denied'
                                            "
                                            class="text-gray-500"
                                            >Request denied</span
                                        >
                                        <span
                                            v-else-if="
                                                course.status === 'Canceled'
                                            "
                                            class="text-gray-500"
                                            >Canceled</span
                                        >
                                    </td>
                                    <td class="py-4 px-6">
                                        <span
                                            v-if="
                                                course.proctor ===
                                                false
                                            "
                                            class="text-gray-500"
                                            >Not Required</span
                                        >
                                        <span
                                            v-else-if="
                                                course.proctor ===
                                                true
                                            "
                                            class="text-purple-500 cursor-pointer"
                                            >Assign a proctor</span
                                        >
                                        <span
                                            v-else-if="
                                                course.proctor ===
                                                'Proctor approved'
                                            "
                                            class="text-green-500"
                                            >Proctor approved</span
                                        >
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
    mounted() {
        console.log(this.studentProgram);
    },

    data() {
        return {
            activeView: "future",
        };
    },
    computed: {
        filteredCourses() {
            if (this.activeView === "future") {
                return this.studentProgram.courses.futureCourses || [];
            } else if (this.activeView === "past") {
                return this.studentProgram.courses.pastCourses || [];
            }
            return [];
        },
    },
});
</script>
