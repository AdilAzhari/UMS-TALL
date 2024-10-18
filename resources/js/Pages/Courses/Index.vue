<template>
    <AppLayout>
        <div class="p-6 bg-white">
            <h1 class="text-3xl font-bold mb-6 text-purple-800">
                BACHELOR'S DEGREE IN COMPUTER SCIENCE
            </h1>

            <div class="flex space-x-6">
                <!-- Left column -->
                <div class="w-2/3">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">
                            SIGN UP FOR CLASSES
                        </h2>
                        <p class="mb-4">
                            {{ user.name }}, Registration is officially open!
                            You'll have until October 23rd, 2024 to sign up for
                            classes.
                        </p>
                        <button
                            class="bg-pink-500 text-white px-6 py-2 rounded-full hover:bg-pink-600 transition duration-300"
                        >
                            REGISTER
                        </button>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">
                            YOUR COURSES - SEPTEMBER 2024
                        </h2>
                        <p class="mb-4">Your courses, at a glance.</p>
                        <table class="w-full">
                            <thead>
                                <tr class="text-left">
                                    <th class="pb-2">Course Name</th>
                                    <th class="pb-2">Status</th>
                                    <th class="pb-2">Proctor</th>
                                    <th class="pb-2">Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="course in currentCourses"
                                    :key="course.id"
                                    class="border-t"
                                >
                                    <td class="py-2">
                                        {{ course.course_name }}
                                    </td>
                                    <td class="py-2">
                                        <span
                                            class="inline-block w-3 h-3 rounded-full bg-green-500 mr-2"
                                        ></span>
                                        Registered
                                    </td>
                                    <td class="py-2">{{ course.proctor }}</td>
                                    <td class="py-2">Future Payment</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right column -->
                <div class="w-1/3">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">
                            ACADEMIC PROGRESS
                        </h2>
                        <p class="mb-2">Keep up the great work!</p>
                        <div class="mb-4">
                            <p class="font-semibold">Term Progress (weeks)</p>
                            <div class="bg-purple-200 rounded-full">
                                <div
                                    class="bg-purple-600 text-xs font-medium text-purple-100 text-center p-0.5 leading-none rounded-full"
                                    :style="{
                                        width: `${
                                            (academicProgress.currentWeek /
                                                academicProgress.totalWeeks) *
                                            100
                                        }%`,
                                    }"
                                >
                                    {{ academicProgress.currentWeek }} /
                                    {{ academicProgress.totalWeeks }} weeks
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <p class="text-3xl font-bold">
                                    {{ academicProgress.gpa }}
                                </p>
                                <p class="text-sm">Cumulative GPA</p>
                                <p class="text-xs text-gray-500">
                                    Standing SAP
                                </p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold">
                                    {{ academicProgress.creditsAccrued }}
                                    <span class="text-sm font-normal"
                                        >/
                                        {{
                                            academicProgress.totalCredits
                                        }}</span
                                    >
                                </p>
                                <p class="text-sm">Credits Accrued</p>
                                <p class="text-xs text-gray-500">
                                    September 2024
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">CHECKLIST</h2>
                        <p class="mb-4">A to-do list for you.</p>
                        <div class="flex space-x-2 mb-4">
                            <button
                                class="bg-gray-200 px-4 py-1 rounded-full text-sm font-medium"
                            >
                                CURRENT
                            </button>
                            <button
                                class="text-gray-600 px-4 py-1 rounded-full text-sm font-medium"
                            >
                                COMPLETED
                            </button>
                        </div>
                        <ul>
                            <li class="flex items-center mb-2">
                                <span
                                    class="inline-block w-6 h-6 rounded-full bg-red-500 mr-2 flex items-center justify-center text-white"
                                    >!</span
                                >
                                Run Degree Audit
                            </li>
                            <li class="flex items-center">
                                <span
                                    class="inline-block w-6 h-6 rounded-full bg-yellow-500 mr-2 flex items-center justify-center text-white"
                                    >!</span
                                >
                                Register Now
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { defineComponent } from "vue";

export default defineComponent({
    components: {
        AppLayout,
    },
    props: {
        currentCourses: {
            type: Array,
            required: true,
        },
        user: {
            type: Object,
            required: true,
        },
        academicProgress: {
            type: Object,
            required: true,
        },
    },
});
</script>

<style scoped>
.table {
    border-collapse: collapse;
}
</style>
