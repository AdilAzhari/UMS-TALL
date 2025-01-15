<template>
    <Head>
        <title>My Courses - Campus</title>
    </Head>

    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 pl-4">My Courses This Term</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
                v-for="course in courses"
                :key="course.id"
                class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
            >
                <Link :href="`/campus/course/${course.id}`" :title="course.name" class="block">
                    <!-- Course Image -->
                    <div v-if="course.image" class="h-48 w-full relative">
                        <img
                            :alt="course.name"
                            :src="course.image"
                            class="w-full h-full object-cover"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div v-else class="h-48 bg-gradient-to-r from-indigo-500 to-blue-600 flex items-center justify-center">
                        <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                    </div>

                    <!-- Course Details -->
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ course.name }}
                        </h2>
                        <div class="flex items-center text-gray-600 space-x-2">
                            <span class="font-medium text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                {{ course.code }}
                            </span>
                            <div class="flex items-center">
                                <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"/>
                                </svg>
                                <span>{{ course.term.name }}</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Teacher:</span> {{ course.teacher?.name || 'N/A' }}
                            </p>
                        </div>
                    </div>
                </Link>
            </div>
        </div>

        <!-- Empty State -->
        <div v-if="courses.length === 0" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                    stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"/>
            </svg>
            <h2 class="mt-2 text-lg font-medium text-gray-900">No courses found</h2>
            <p class="mt-1 text-gray-500">You are not enrolled in any courses this term.</p>
        </div>
    </div>
</template>

<script>
import CampusLayout from "@/Layouts/CampusLayout.vue";
import {Link} from '@inertiajs/vue3';

export default {
    components: {
        Link
    },
    layout: CampusLayout,
    name: 'CourseList',
    props: {
        courses: {
            type: Array,
            required: true,
        },
    },
}
</script>
