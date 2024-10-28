<template>
    <div class="px-6 lg:px-12 py-8">
        <!-- Search and Filters Section -->
        <div class="mb-6" v-if="activeView === 'past'">
            <!-- Search Bar -->
            <div class="mb-4">
                <input
                    type="text"
                    v-model="searchQuery"
                    placeholder="Search for courses"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-purple-500"
                />
            </div>

            <!-- Filters Row -->
            <div class="flex items-center gap-4">
                <!-- Term Dropdown -->
                <div class="relative">
                    <select
                        v-model="selectedTerm"
                        class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 focus:outline-none focus:border-purple-500"
                    >
                        <option value="all">TERM</option>
                        <option value="fall">Fall 2024</option>
                        <option value="spring">Spring 2024</option>
                        <option value="summer">Summer 2024</option>
                    </select>
                    <div
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                    >
                        <svg
                            class="w-4 h-4 text-gray-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </div>
                </div>

                <!-- Type Dropdown -->
                <div class="relative">
                    <select
                        v-model="selectedType"
                        class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 focus:outline-none focus:border-purple-500"
                    >
                        <option value="all">TYPE</option>
                        <option value="core">Core</option>
                        <option value="elective">Elective</option>
                        <option value="required">Required</option>
                    </select>
                    <div
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                    >
                        <svg
                            class="w-4 h-4 text-gray-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </div>
                </div>

                <!-- Clear All Button -->
                <button
                    @click="clearFilters"
                    class="text-purple-600 hover:text-purple-800 font-medium"
                >
                    CLEAR ALL
                </button>
            </div>
        </div>

        <!-- Tab View -->
        <div class="bg-white shadow-lg rounded-lg p-8">
            <!-- Toggle buttons for current, future, past views -->
            <div class="flex justify-center space-x-4 mb-6">
                <button
                    v-for="view in ['current', 'future', 'past']"
                    :key="view"
                    class="px-4 py-2 rounded-full transition-all focus:outline-none"
                    :class="{
                        'bg-purple-700 text-white': activeView === view,
                        'bg-gray-200 text-gray-700': activeView !== view,
                    }"
                    @click="activeView = view"
                >
                    {{ view.charAt(0).toUpperCase() + view.slice(1) }}
                </button>
            </div>

            <!-- Table to display filtered courses -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th
                                class="py-3 px-4 text-left font-semibold text-gray-700"
                            >
                                Course Name
                            </th>
                            <th
                                class="py-3 px-4 text-left font-semibold text-gray-700"
                            >
                                Status
                            </th>
                            <th
                                class="py-3 px-4 text-left font-semibold text-gray-700"
                            >
                                Proctor
                            </th>
                            <th
                                class="py-3 px-4 text-left font-semibold text-gray-700"
                            >
                                Credit
                            </th>
                            <th
                                class="py-3 px-4 text-left font-semibold text-gray-700"
                            >
                                Category
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="course in filteredCourses"
                            :key="course.id"
                            class="border-t hover:bg-gray-50"
                        >
                            <td class="py-3 px-4">
                                {{ course.code }} - {{ course.name }}
                            </td>
                            <td class="py-3 px-4">{{ course.status }}</td>
                            <td class="py-3 px-4">
                                {{ course.proctor || "N/A" }}
                            </td>
                            <td class="py-3 px-4">{{ course.credit }}</td>
                            <td class="py-3 px-4">{{ course.category }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        studentProgram: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            activeView: "current", // Controls the tab view
            selectedTerm: "all",
            selectedType: "all",
            searchQuery: "",
        };
    },
    computed: {
        filteredCourses() {
            if (!this.studentProgram || !this.studentProgram.courses) {
                return [];
            }

            let courses = this.studentProgram.courses[this.activeView] || [];

            // Apply term filter
            if (this.selectedTerm !== "all") {
                courses = courses.filter(
                    (course) => course.term === this.selectedTerm
                );
            }

            // Apply type filter
            if (this.selectedType !== "all") {
                courses = courses.filter(
                    (course) => course.category === this.selectedType
                );
            }

            return courses;
        },
    },
    methods: {
        clearFilters() {
            this.selectedTerm = "all";
            this.selectedType = "all";
            this.searchQuery = "";
        },
    },
});
</script>

<style scoped>
.appearance-none {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
</style>
