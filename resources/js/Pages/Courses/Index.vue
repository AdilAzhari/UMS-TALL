<template>
    <AppLayout>
        <div class="min-h-screen bg-purple-50">
            <div class="max-w-7xl mx-auto p-6">
                <!-- Header Section -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-4xl font-bold text-purple-900">
                        MY COURSES
                    </h1>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <div class="text-sm text-gray-500">
                                UoPeople Time
                            </div>
                            <div>{{ currentTime }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">
                                UoPeople Date
                            </div>
                            <div>{{ currentDate }}</div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="mb-6 border-b border-purple-200">
                    <nav class="flex space-x-8">
                        <button
                            v-for="tab in tabs"
                            :key="tab.value"
                            @click="currentTab = tab.value"
                            :class="[
                                'px-6 py-2 font-medium',
                                currentTab === tab.value
                                    ? 'border-b-2 border-purple-600 text-purple-600'
                                    : 'text-gray-500 hover:text-purple-600',
                            ]"
                        >
                            {{ tab.label }}
                        </button>
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
                    <div v-if="currentTab === 'manage'" class="flex space-x-6">
                        <div class="w-2/3">
                            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                                <div class="flex items-start space-x-6">
                                    <div class="flex-1">
                                        <h2
                                            class="text-2xl font-bold text-purple-900 mb-4"
                                        >
                                            YOU CAN REGISTER FOR MORE COURSES
                                        </h2>
                                        <p class="text-gray-600 mb-4">
                                            {{ $page.props.auth.user.name }},
                                            you're currently registered for 3
                                            out of the 4 courses you are allowed
                                            to take. If you wish to register for
                                            more, you'll be able to do so during
                                            the Late Registration period from
                                            November 8th.
                                        </p>
                                        <button
                                            class="bg-pink-500 text-white px-6 py-2 rounded-full hover:bg-pink-600 transition duration-300"
                                        >
                                            <Link href="/courses/register"
                                                >REGISTER NOW</Link
                                            >
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <Courses :studentProgram="studentProgram" />
                        </div>

                        <div class="w-1/3 space-y-6">
                            <!-- Academic Progress Section -->
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h2 class="text-xl font-semibold mb-4">
                                    ACADEMIC PROGRESS
                                </h2>
                                <p class="text-sm text-gray-600 mb-6">
                                    You can take a maximum of 4 courses this
                                    term. Check out our course load policy for
                                    <span
                                        class="text-pink-600 hover:underline cursor-pointer"
                                        >Undergraduate</span
                                    >
                                    and
                                    <span
                                        class="text-pink-600 hover:underline cursor-pointer"
                                        >Graduate</span
                                    >
                                    students.
                                </p>
                                <div class="space-y-6">
                                    <div
                                        v-for="category in studentProgram.categoryCounts"
                                        :key="category.name"
                                        class="space-y-2"
                                    >
                                        <div
                                            class="flex justify-between text-sm"
                                        >
                                            <span class="font-semibold">{{
                                                category.name
                                            }}</span>
                                            <span>Total Courses Required</span>
                                        </div>
                                        <div
                                            class="text-3xl font-bold text-purple-900"
                                        >
                                            {{ category.count ?? 0 }} / 17
                                        </div>
                                        <div
                                            class="h-2 bg-purple-100 rounded-full overflow-hidden"
                                        >
                                            <div
                                                class="h-full bg-purple-600 transition-all duration-500"
                                                :style="{
                                                    width: `${
                                                        (category.count / 17) *
                                                        100
                                                    }%`,
                                                }"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Checklist Section -->
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h2 class="text-xl font-semibold mb-4">
                                    CHECKLIST
                                </h2>
                                <p class="mb-4">Stay on track this term:</p>
                                <ul class="space-y-2">
                                    <li
                                        v-for="(item, index) in checklist"
                                        :key="index"
                                        class="flex items-center space-x-2"
                                    >
                                        <input
                                            type="checkbox"
                                            :checked="item.completed"
                                            class="rounded border-gray-300 text-purple-600 focus:ring-purple-500"
                                        />
                                        <span
                                            :class="{
                                                'line-through': item.completed,
                                            }"
                                        >
                                            {{ item.text }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Tab -->
                    <div
                        v-else-if="currentTab === 'registration'"
                        class="bg-white rounded-lg shadow-md"
                    >
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-purple-900 mb-6">
                                Course Registration
                            </h2>
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
                                    class="px-6 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600"
                                    @click="submitRegistration"
                                >
                                    Complete Registration
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Manage Proctors Tab -->
                    <div
                        v-else-if="currentTab === 'proctors'"
                        class="bg-white rounded-lg shadow-md p-6"
                    >
                        <h2 class="text-2xl font-bold text-purple-900 mb-6">
                            Manage Proctors
                        </h2>
                        <!-- Add proctor management content here -->
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
    </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Courses from "@/Components/Courses.vue";
import { Link } from "@inertiajs/vue3";

export default defineComponent({
    components: {
        AppLayout,
        Courses,
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
            currentTab: "manage",
            tabs: [
                { label: "Manage Courses", value: "manage" },
                { label: "Registration", value: "registration" },
                { label: "Manage Proctors", value: "proctors" },
                { label: "How To", value: "howto" },
            ],
            checklist: [
                { text: "Run Degree Audit", completed: false },
                { text: "Register for classes", completed: false },
            ],
            availableCourses: [
                { id: 1, code: "CS1101", name: "Programming Fundamentals" },
                { id: 2, code: "MATH1201", name: "College Algebra" },
                { id: 3, code: "ENG1102", name: "English Composition" },
            ],
            selectedCourses: [],
        };
    },
    computed: {
        currentTime() {
            const now = new Date();
            return now.toLocaleTimeString("en-US", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: true,
            });
        },
        currentDate() {
            const now = new Date();
            return now.toLocaleDateString("en-US", {
                weekday: "long",
                month: "short",
                day: "numeric",
                year: "numeric",
            });
        },
    },
    methods: {
        addCourse(course) {
            if (this.selectedCourses.length < 4) {
                this.selectedCourses.push(course);
                this.availableCourses = this.availableCourses.filter(
                    (c) => c.id !== course.id
                );
            }
        },
        removeCourse(course) {
            this.selectedCourses = this.selectedCourses.filter(
                (c) => c.id !== course.id
            );
            this.availableCourses.push(course);
        },
        resetSelection() {
            // Reset course selection logic
            this.selectedCourses = [];
        },
        submitRegistration() {
            // Registration submission logic
            console.log(
                "Submitting registration for courses:",
                this.selectedCourses
            );
        },
    },
});
</script>

<style scoped>
.router-link-active {
    @apply border-b-2 border-purple-600 text-purple-600;
}

input[type="checkbox"] {
    @apply w-4 h-4 cursor-pointer;
}
</style>
