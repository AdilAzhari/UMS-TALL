<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
export default defineComponent({
    components: {
        AppLayout,
    },
    props: {
        availableCourses: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            searchQuery: "",
            selectedTerm: "all",
            selectedType: "all",
        };
    },
    computed: {
        filteredCourses() {
            let courses = this.availableCourses;

            if (this.searchQuery) {
                courses = courses.filter(
                    (course) =>
                        course.name
                            .toLowerCase()
                            .includes(this.searchQuery.toLowerCase()) ||
                        course.code
                            .toLowerCase()
                            .includes(this.searchQuery.toLowerCase())
                );
            }

            if (this.selectedTerm !== "all") {
                courses = courses.filter(
                    (course) => course.term === this.selectedTerm
                );
            }

            if (this.selectedType !== "all") {
                courses = courses.filter(
                    (course) => course.type === this.selectedType
                );
            }

            return courses;
        },
    },
    methods: {
        selectCourse(course) {
            this.$emit("select-course", course);
        },
    },
});
</script>

<template>
    <AppLayout>
        <div>
            <!-- Filters -->
            <div class="mb-6 flex space-x-4">
                <input
                    type="text"
                    v-model="searchQuery"
                    placeholder="Search courses..."
                    class="flex-1 px-4 py-2 border rounded-md"
                />
                <select
                    v-model="selectedTerm"
                    class="px-4 py-2 border rounded-md"
                >
                    <option value="all">All Terms</option>
                    <!-- Add your term options -->
                </select>
                <select
                    v-model="selectedType"
                    class="px-4 py-2 border rounded-md"
                >
                    <option value="all">All Types</option>
                    <!-- Add your course type options -->
                </select>
            </div>

            <!-- Course List -->
            <div class="space-y-4">
                <div
                    v-for="course in filteredCourses"
                    :key="course.id"
                    class="border rounded-lg p-4 hover:bg-gray-50"
                >
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold text-lg">
                                {{ course.code }} - {{ course.name }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ course.credits }} Credits
                                <span
                                    v-if="course.requier_proctor"
                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"
                                >
                                    Proctor Required
                                </span>
                            </p>
                            <div class="mt-2 text-sm">
                                <p
                                    v-if="course.prerequisite"
                                    class="text-gray-600"
                                >
                                    Prerequisite: {{ course.prerequisite }}
                                </p>
                            </div>
                        </div>
                        <button
                            @click="selectCourse(course)"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700"
                        >
                            Select Course
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
