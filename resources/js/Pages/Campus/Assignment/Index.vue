<template>
    <div class="assignment-show-page bg-gray-100 min-h-screen p-6">
        <!-- Page Header -->
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Programming Assignment - Unit 7</h1>
        </header>

        <!-- Assignment Details Section -->
        <section class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Submission Phase</h2>
            <p class="text-sm text-gray-600">
                <strong>Submissions opened:</strong> Thursday, 26 December 2024, 12:05 AM
            </p>
            <p class="text-sm text-gray-600">
                <strong>Submissions close:</strong> Wednesday, 1 January 2025, 11:55 PM
            </p>
            <p class="text-gray-700 mt-4">
                For Unit 7, you will report the results from neural network training you completed in Unit 6. Write a
                short
                paper explaining the process of developing the network, including:
            </p>

            <ul class="list-disc list-inside text-gray-700 mt-4 mb-4">
                <li>Details on how many iterations of network designs were evaluated.</li>
                <li>What results were obtained?</li>
                <li>
                    What alternatives were tested to determine the best approach for training a network that would yield
                    accurate
                    results in minimal steps?
                </li>
            </ul>

            <p class="text-gray-700">
                The assignment should be 2-3 pages long, double-spaced, using Times New Roman, 12-point font, and 1-inch
                margins.
            </p>
        </section>

        <!-- Assignment Phases -->
        <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Submission Phase -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">Submission Phase</h3>
                <p class="text-sm text-gray-600 mt-2">
                    <strong>Open:</strong> Thursday, 26 December 2024, 12:05 AM
                </p>
                <p class="text-sm text-gray-600">
                    <strong>Deadline:</strong> Wednesday, 1 January 2025, 11:55 PM
                </p>
                <p class="text-sm text-green-600 mt-2">Currently open for submissions</p>
                <button
                    @click="submitAssignment"
                    class="mt-4 w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700"
                >
                    Submit Your Work
                </button>
            </div>

            <!-- Assessment Phase -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">Assessment Phase</h3>
                <p class="text-sm text-gray-600 mt-2">
                    <strong>Open:</strong> Thursday, 2 January 2025, 12:05 AM
                </p>
                <p class="text-sm text-gray-600">
                    <strong>Deadline:</strong> Wednesday, 8 January 2025, 11:55 PM
                </p>
                <p class="text-sm text-yellow-600 mt-2">Assessment phase has not started yet</p>
            </div>

            <!-- Grading Evaluation Phase -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">Grading Evaluation Phase</h3>
                <p class="text-sm text-gray-600 mt-2">Status: Closed</p>
                <p class="text-sm text-gray-500 mt-2">
                    Grading evaluation has been completed for this assignment.
                </p>
            </div>
        </section>

        <!-- Submission Details -->
        <section class="bg-white shadow rounded-lg p-6 mt-6">
            <h2 class="text-lg font-semibold text-gray-800">Your Submission</h2>
            <p class="text-gray-700 mt-4">
                <strong>Submitted by:</strong> Zahra Ahmad
            </p>
            <p class="text-gray-700">
                <strong>Submission Date:</strong> Monday, 30 December 2024, 11:47 AM
            </p>

            <a
                href="#"
                class="text-indigo-600 hover:underline mt-2 inline-block"
            >
                View Submitted Work
            </a>
        </section>
    </div>
</template>

<script>
import Header from '@/Components/Campus/Header.vue';
import Breadcrumbs from "@/Components/Campus/Breadcrumb.vue";
import CampusLayout from "@/Layouts/CampusLayout.vue";
export default {
    layout: CampusLayout,
    name: "ShowAssignment",
    methods: {
        submitAssignment() {
            console.log("Redirecting to submission page...");
        },
    },
    data() {
        return {
            assignmentBreadcrumbs: [
                {label: 'Home', path: '/'},
                {label: 'Courses', path: '/courses'},
                {label: 'Assignments', path: '/assignments'},
                {label: this.$route.params.assignmentTitle || 'Assignment Details'},
            ],
        }
    }
};
</script>

<style scoped>
.assignment-show-page {
    font-family: 'Arial', sans-serif;
}
</style>
