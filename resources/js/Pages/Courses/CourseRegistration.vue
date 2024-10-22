<template>
    <AppLayout>
        <div class="course-registration bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-purple-700 mb-4">
                Course Registration
            </h2>
            <p class="text-gray-600 mb-4">
                Your CGPA is
                <span class="font-semibold">{{ studentCGPA || "N/A" }}</span
                >. Based on this, you can register for courses under the
                following categories:
            </p>

            <div class="flex flex-wrap gap-4">
                <button
                    v-for="category in courseCategories"
                    :key="category.id"
                    class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg hover:bg-purple-200"
                    :class="{
                        'bg-purple-700 text-white':
                            selectedCategory === category,
                    }"
                    @click="selectCategory(category)"
                >
                    {{ category.name }}
                </button>
            </div>

            <div v-if="selectedCategory" class="mt-6">
                <h3 class="text-xl font-semibold text-gray-800">
                    Available {{ selectedCategory.name }} Courses
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div
                        v-for="course in filteredCourses"
                        :key="course.id"
                        class="p-4 border rounded-lg bg-gray-50 hover:shadow-md"
                    >
                        <h4 class="font-semibold text-gray-700">
                            {{ course.course_name }}
                        </h4>
                        <p class="text-sm text-gray-600">
                            Credits: {{ course.credits }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Prerequisites: {{ course.prerequisites || "None" }}
                        </p>
                        <button
                            class="mt-3 bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600"
                            @click="registerForCourse(course.id)"
                        >
                            Register
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
    },
    props: {
        studentCGPA: {
            type: Number,
            required: true,
        },
        courseCategories: {
            type: Array,
            required: true,
        },
        availableCourses: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            selectedCategory: null,
        };
    },
    computed: {
        filteredCourses() {
            return this.availableCourses.filter(
                (course) =>
                    course.category === this.selectedCategory.name &&
                    course.min_cgpa <= this.studentCGPA
            );
        },
    },
    methods: {
        selectCategory(category) {
            this.selectedCategory = category;
        },
        registerForCourse(courseId) {
            // Handle the registration logic here
            console.log(`Registering for course with ID: ${courseId}`);
            // You can make an API call to your backend to handle the registration
        },
    },
};
</script>

<style scoped>
.course-registration {
    max-width: 1000px;
    margin: 0 auto;
}
</style>
