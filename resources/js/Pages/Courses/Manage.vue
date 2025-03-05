<template>
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

            <!-- Main Content -->
            <div class="flex space-x-6">
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
                                    {{ $page.props.auth.user.name }}, you're
                                    currently registered for 3 out of the 4
                                    courses you are allowed to take. If you
                                    wish to register for more, you'll be
                                    able to do so during the Late
                                    Registration period from November 8th.
                                </p>
                                <Link
                                    class="bg-pink-500 text-white px-6 py-2 rounded-full hover:bg-pink-600 transition duration-300"
                                    href="/courses/register"
                                >
                                    REGISTER NOW
                                </Link>
                            </div>
                        </div>
                    </div>
                    <Courses :studentProgram="studentProgram"/>
                </div>

                <div class="w-1/3 space-y-6">
                    <!-- Academic Progress Section -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">
                            ACADEMIC PROGRESS
                        </h2>
                        <p class="text-sm text-gray-600 mb-6">
                            You can take a maximum of 4 courses this term.
                            Check out our course load policy for
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
                                <div class="flex justify-between text-sm">
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
                                        :style="{
                                                width: `${
                                                    (category.count / 17) * 100
                                                }%`,
                                            }"
                                        class="h-full bg-purple-600 transition-all duration-500"
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
                                    :checked="item.completed"
                                    class="rounded border-gray-300 text-purple-600 focus:ring-purple-500"
                                    type="checkbox"
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
        </div>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link} from "@inertiajs/vue3";
import Courses from "@/Components/Courses.vue";

export default defineComponent({
    layout: AppLayout,
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
        };
    },
});
</script>
