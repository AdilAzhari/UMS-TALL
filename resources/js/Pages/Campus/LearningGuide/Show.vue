<template>
    <Head>
        <title class="page-title">Weekly Learning Guide</title>
    </Head>
    <Header :weeks="weeks.length > 0 ? weeks[0].id : null"/>
    <breadcrumb breadcrumbs="Home"/>
    <div class="max-w-5xl mx-auto p-6 space-y-8">
        <!-- Empty State -->
        <div v-if="weeks.length === 0" class="bg-white rounded-xl shadow-sm border p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-900">No Weekly Learning Guides Available</h2>
            <p class="mt-2 text-gray-600">Please check back later or contact your instructor for more information.</p>
        </div>

        <!-- Weeks List -->
        <div v-else v-for="week in weeks" :key="week.id" class="bg-white rounded-xl shadow-sm border">
            <!-- Header -->
            <div class="border-b p-6">
                <h2 class="text-xl font-semibold text-gray-900">Week {{ week.week_id }}</h2>
                <p class="mt-2 text-gray-600">{{ week.overview }}</p>
            </div>

            <!-- Content Grid -->
            <div class="grid md:grid-cols-2 gap-6 p-6">
                <!-- Topics -->
                <div class="bg-gray-50 rounded-lg p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Topics</h3>
                    </div>
                    <ul class="space-y-3">
                        <li v-for="topic in week.topics" :key="topic" class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-blue-600 flex-shrink-0"></span>
                            <span class="text-gray-700">{{ topic }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Learning Objectives -->
                <div class="bg-gray-50 rounded-lg p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Learning Objectives</h3>
                    </div>
                    <ul class="space-y-3">
                        <li v-for="objective in week.objectives" :key="objective" class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-green-600 flex-shrink-0"></span>
                            <span class="text-gray-700">{{ objective }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="border-t p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Tasks</h3>
                <div class="bg-gray-50 rounded-lg p-5">
                    <ul class="space-y-4">
                        <li v-for="(task, index) in week.tasks" :key="task" class="flex items-start gap-3">
                            <span
                                class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium flex-shrink-0">
                                {{ index + 1 }}
                            </span>
                            <span class="text-gray-700">{{ task }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import campusLayout from "@/Layouts/CampusLayout.vue";
import {Head} from '@inertiajs/vue3';

export default {
    layout: campusLayout,
    components: {
        Head,
    },
    props: {
        weeks: {
            type: Array,
            required: true,
        },
    },
};
</script>
