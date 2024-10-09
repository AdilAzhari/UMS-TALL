<template>
    <AppLayout>
        <div class="p-6 bg-gray-100">
            <h1 class="text-2xl font-bold mb-6">My Courses</h1>

            <!-- New inner navigation -->
            <div class="bg-purple-100 rounded-lg mb-6">
                <nav class="flex">
                    <a
                        v-for="tab in tabs"
                        :key="tab"
                        :class="[
                            'px-4 py-2 text-sm font-medium',
                            activeTab === tab
                                ? 'text-purple-700 border-b-2 border-purple-700'
                                : 'text-purple-500 hover:text-purple-700',
                        ]"
                        @click="activeTab = tab"
                        href="#"
                    >
                        {{ tab }}
                    </a>
                </nav>
            </div>

            <!-- Content based on active tab -->
            <div v-if="activeTab === 'Current Courses'">
                <!-- Current Courses Content -->
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">
                        Current Courses -
                        {{
                            new Date().toLocaleString("default", {
                                month: "long",
                                year: "numeric",
                            })
                        }}
                    </h2>
                    <!-- Courses table -->
                    <table class="w-full mt-4 bg-white rounded-lg shadow-md">
                        <thead>
                            <tr
                                class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal"
                            >
                                <th class="py-3 px-6 text-left">Course</th>
                                <th class="py-3 px-6 text-left">Instructor</th>
                                <th class="py-3 px-6 text-left">Department</th>
                                <th class="py-3 px-6 text-left">
                                    Available Seats
                                </th>
                                <th class="py-3 px-6 text-left">Program</th>
                                <th class="py-3 px-6 text-center">Category</th>
                                <th class="py-3 px-6 text-center">Credits</th>
                                <th class="py-3 px-6 text-center">Proctor</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600 text-sm font-light">
                            <tr
                                v-for="course in currentCourses"
                                :key="course.id"
                                class="border-b border-gray-200 hover:bg-gray-100"
                            >
                                <td
                                    class="py-3 px-6 text-left whitespace-nowrap"
                                >
                                    <div class="flex items-center">
                                        <span class="font-medium">{{
                                            course.course_name
                                        }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ course.instructor }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ course.department }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ course.availableSeats }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ course.program }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ course.category }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ course.credits }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span
                                        :class="{
                                            'bg-green-200 text-green-600':
                                                course.proctor === 'Required',
                                            'bg-red-200 text-red-600':
                                                course.proctor ===
                                                'Not Required',
                                        }"
                                        class="py-1 px-3 rounded-full text-xs"
                                    >
                                        {{ course.proctor }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-else-if="activeTab === 'Past Courses'">
                <!-- Past Courses Content -->
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Past Courses</h2>
                    <!-- Courses table -->
                    <table class="w-full mt-4 bg-white rounded-lg shadow-md">
                        <thead>
                            <tr
                                class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal"
                            >
                                <th class="py-3 px-6 text-left">Course</th>
                                <th class="py-3 px-6 text-left">Instructor</th>
                                <th class="py-3 px-6 text-left">Department</th>
                                <th class="py-3 px-6 text-left">Program</th>
                                <th class="py-3 px-6 text-center">Category</th>
                                <th class="py-3 px-6 text-center">Credits</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600 text-sm font-light">
                            <tr
                                v-for="course in pastCourses"
                                :key="course.id"
                                class="border-b border-gray-200 hover:bg-gray-100"
                            >
                                <td
                                    class="py-3 px-6 text-left whitespace-nowrap"
                                >
                                    <div class="flex items-center">
                                        <span class="font-medium">{{
                                            course.course_name
                                        }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ course.instructor }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ course.department }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ course.program }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ course.category }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ course.credits }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
        pastCourses: {
            type: Array,
            required: true,
        },
        registrationStatus: {
            type: Object,
            required: true,
        },
        academicProgress: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            activeTab: "Current Courses",
            tabs: [
                "Current Courses",
                "Past Courses",
                "Manage Courses",
                "Registration",
                "Manage Proctors",
                "How To",
            ],
        };
    },
});
</script>

<style scoped>
.table {
    border-collapse: collapse;
}
</style>
