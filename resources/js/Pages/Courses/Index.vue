<script>
    import Head from '@/Layouts/Head.vue';

    export default {
        components: {
            Head,
        },

        props: {
            courses: {
                type: Array,
                required: true,
            },
        },
    };
</script>
<template>
    <div>
        <!-- <Head title="Courses" />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl font-semibold text-gray-900">My Courses</h1>
            <p class="text-gray-600">Here are the courses you are currently enrolled in.</p>

            <div class="mt-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div v-for="course in courses" :key="course.id" class="bg-white shadow rounded-lg overflow-hidden">
                        <img :src="course.image" :alt="course.title" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800">{{ course.title }}</h2>
                            <p class="text-sm text-gray-600 mt-1">{{ course.description }}</p>
                            <div class="mt-4">
                                <a :href="route('course.show', course.slug)" class="text-purple-600 hover:underline">View Course</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        <!-- </div> -->
         <h1>Hello</h1>
    </div>
</template>
