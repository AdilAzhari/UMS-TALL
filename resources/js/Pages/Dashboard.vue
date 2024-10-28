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
                        <!-- youre persuing -->
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
                            :href="route('courses.registration')"
                            class="bg-purple-600 text-white px-8 py-2 rounded-full shadow-lg hover:bg-purple-700 transition duration-300 focus:outline-none"
                        >
                            Register Now
                        </Link>
                    </div>

                    <!-- Academic Progress Section -->
                    <div
                        class="bg-white shadow-lg rounded-lg p-8 transform transition-transform hover:-translate-y-2 hover:shadow-xl"
                    >
                        <h2 class="text-2xl font-semibold text-purple-800 mb-4">
                            Academic Progress
                        </h2>
                        <p class="text-gray-600 mb-4">
                            <span
                                v-if="
                                    studentProgram.academicProgress === 'good'
                                "
                                >🎉 Excellent progress!</span
                            >
                            <span
                                v-else-if="
                                    studentProgram.academicProgress ===
                                    'warning'
                                "
                                >⚠️ Needs Improvement.</span
                            >
                            <span
                                v-else-if="
                                    studentProgram.academicProgress ===
                                    'probation'
                                "
                                >❗ On Probation, please consult your
                                advisor.</span
                            >
                        </p>
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span
                                        class="text-sm font-medium inline-block text-gray-600"
                                        >Term Progress</span
                                    >
                                </div>
                                <div class="text-right">
                                    <span
                                        class="text-sm font-medium inline-block text-purple-600"
                                        >{{
                                            studentProgram.currentWeekNumber ||
                                            0
                                        }}
                                        / 9 weeks</span
                                    >
                                </div>
                            </div>
                            <div
                                class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200"
                            >
                                <div
                                    :style="{
                                        width: `${
                                            ((studentProgram.currentWeekNumber ||
                                                0) /
                                                9) *
                                            100
                                        }%`,
                                    }"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-purple-600"
                                ></div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-center">
                                <h3
                                    class="text-3xl font-semibold text-gray-800"
                                >
                                    {{ studentProgram.gpa || "N/A" }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Cumulative GPA
                                </p>
                            </div>
                            <div class="text-center">
                                <h3
                                    class="text-3xl font-semibold text-gray-800"
                                >
                                    {{ studentProgram.totalCredit || 0 }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Credits Accrued
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Course Categories Section -->
                    <div
                        class="bg-white shadow-lg rounded-lg p-8 transform transition-transform hover:-translate-y-2 hover:shadow-xl"
                    >
                        <h2 class="text-2xl font-semibold text-purple-800 mb-4">
                            Course Categories
                        </h2>
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <p class="text-lg font-bold">
                                    {{ studentProgram.majorElectiveCount || 0 }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Major Electives
                                </p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <p class="text-lg font-bold">
                                    {{ studentProgram.generalCount || 0 }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    General Courses
                                </p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <p class="text-lg font-bold">
                                    {{
                                        (studentProgram.general_education || [])
                                            .length
                                    }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    General Education
                                </p>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <p class="text-lg font-bold">
                                    {{
                                        studentProgram.major_required.count || 0
                                    }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Major Required
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Courses Section -->
                <Courses :studentProgram="studentProgram" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import Courses from "@/Components/Courses.vue";
export default defineComponent({
    components: {
        AppLayout,
        Link,
        Courses,
    },
    props: {
        studentProgram: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            activeView: "current",
        };
    },
    computed: {
        filteredCourses() {
            if (this.activeView === "current") {
                return this.studentProgram.currentCourses || [];
            } else if (this.activeView === "future") {
                return this.studentProgram.futureCourses || [];
            } else if (this.activeView === "past") {
                return this.studentProgram.pastCourses || [];
            }
            return [];
        },
    },
});
</script>
