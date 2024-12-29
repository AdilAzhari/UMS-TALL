<template>
    <div class="space-y-8">
        <!-- Manage Proctors Section -->
        <section class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">MANAGE YOUR PROCTORS</h2>
                <span class="px-4 py-1 bg-gray-100 rounded-full text-sm"
                >FUTURE</span
                >
            </div>

            <p class="mb-6 text-gray-600">
                Check out our "How to Assign a Proctor"
                <a class="text-pink-600 hover:underline" href="#">manual</a>
                or watch this
                <a class="text-pink-600 hover:underline" href="#">video</a>.
            </p>
            <!-- Proctors Table -->
            <div
                v-for="course in proctorCourses"
                :key="course.id"
                class="bg-gray-50 rounded-lg shadow-sm p-4 mb-4"
            >
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">
                            {{ course.name }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ course.code }}
                        </p>
                    </div>
                    <div>
                            <span
                                class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm"
                            >{{ course.proctorType || "Standard" }}</span
                            >
                    </div>
                    <div class="flex items-center space-x-2">
                            <span
                                :class="getStatusColor(course.status)"
                                class="w-2 h-2 rounded-full"
                            ></span>
                        <span class="text-sm">{{ course.status }}</span>
                        <button
                            class="text-gray-500 focus:outline-none"
                            @click="toggleDropdown(course.id)"
                        >
                            <span v-if="course.isOpen">▲</span>
                            <span v-else>
                                    <svg
                                        aria-hidden="true"
                                        class="w-6 h-6 text-gray-800 dark:text-white"
                                        fill="none"
                                        viewBox="0 0 14 8"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                        />
                                    </svg>
                                </span>
                        </button>
                    </div>
                </div>

                <!-- Dropdown Section -->
                <div v-if="course.isOpen" class="mt-4 border-t pt-4">
                    <p class="text-gray-700 mb-4">
                        This course is {{ course.description }}
                    </p>
                    <div class="flex justify-between items-start">
                        <button
                            class="border border-purple-600 text-purple-600 px-4 py-2 rounded-md hover:bg-purple-600 hover:text-white transition"
                        >
                            <Link :href="`/assign/proctorForm/${course.id}`">
                                Change Proctor
                            </Link>
                        </button>
                        <div class="bg-gray-100 p-4 rounded-md">
                            <h4 class="text-gray-800 font-medium">
                                Course Details
                            </h4>
                            <ul class="text-sm text-gray-600">
                                <li>Course Term: November 2024</li>
                                <li>Academic Year: 2024, Term 2</li>
                                <li>
                                    Final Exam Date: {{ course.examDate }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "ProctorManagement",
    components: {
        Link,
    },
    props: {
        proctorCourses: {
            type: Object,
            default: () => [],
        },
    },
    methods: {
        getStatusColor(status) {
            const statusColors = {
                "Proctor approved": "bg-green-500",
                Pending: "bg-yellow-500",
                "Not started": "bg-gray-500",
            };
            return statusColors[status] || "bg-gray-500";
        },
        toggleDropdown(courseId) {
            this.proctorCourses = this.proctorCourses.map((course) => {
                if (course.id === courseId) {
                    course.isOpen = !course.isOpen;
                }
                return course;
            });
        },
    },
    data() {
        return {
            proctorCourses: this.proctorCourses.map((course) => ({
                ...course,
                isOpen: false,
            })),
        };
    },
};
</script>

<style scoped>
/* Custom styling */
.border-b {
    @apply border-gray-200;
}

th {
    @apply font-medium text-gray-700;
}

td {
    @apply text-gray-800;
}

a {
    @apply transition-colors duration-200;
}

button:focus {
    outline: none;
}
</style>
