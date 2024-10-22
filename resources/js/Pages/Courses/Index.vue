<template>
    <AppLayout>
        <div class="p-6 bg-white">
            <h1 class="text-3xl font-bold mb-6 text-purple-800">
                BACHELOR'S DEGREE IN COMPUTER SCIENCE
            </h1>

            <div class="flex space-x-6">
                <!-- Left column -->
                <div class="w-2/3">
                    <!-- Get Ready Section -->
                    <div class="bg-purple-100 rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">
                            GET READY FOR THE NEW TERM!
                        </h2>
                        <p class="mb-4">
                            {{ $page.props.auth.user.name }}, time to plan your
                            next term! Registration is officially open until
                            <strong>October 23rd, 2024</strong>.
                        </p>
                        <button
                            class="bg-pink-500 text-white px-6 py-2 rounded-full hover:bg-pink-600 transition duration-300"
                        >
                            REGISTER NOW
                        </button>
                    </div>

                    <!-- Courses Tab Navigation -->
                    <div class="mb-6">
                        <div
                            class="flex justify-between border-b border-gray-300 pb-2 mb-4"
                        >
                            <div>
                                <button
                                    :class="{
                                        'text-purple-800 font-semibold':
                                            currentTab === 'current',
                                        'text-gray-500':
                                            currentTab !== 'current',
                                    }"
                                    class="mr-4"
                                    @click="currentTab = 'current'"
                                >
                                    CURRENT
                                </button>
                                <button
                                    :class="{
                                        'text-purple-800 font-semibold':
                                            currentTab === 'past',
                                        'text-gray-500': currentTab !== 'past',
                                    }"
                                    @click="currentTab = 'past'"
                                >
                                    PAST
                                </button>
                            </div>
                            <a href="#" class="text-purple-800 font-semibold"
                                >here</a
                            >
                        </div>
                    </div>

                    <!-- Courses List (Conditional on Tab) -->
                    <div
                        v-if="currentTab === 'current'"
                        class="bg-white rounded-lg shadow-md p-6"
                    >
                        <h2 class="text-xl font-semibold mb-4">
                            COURSES - SEPTEMBER 2024
                        </h2>
                        <p class="text-sm text-gray-600 mb-4">
                            Manage all of your courses from this page. From here
                            you can see your course status, proctor information,
                            or cancel courses.
                        </p>
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="pb-2">Sequence</th>
                                    <th class="pb-2">Course Name</th>
                                    <th class="pb-2">Status</th>
                                    <th class="pb-2">Proctor</th>
                                    <th class="pb-2">Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="course in currentCourses"
                                    :key="course.id"
                                    class="border-t"
                                >
                                    <td class="py-2">
                                        <span
                                            class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs"
                                            v-if="course.isRetake"
                                        >
                                            Retake
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        {{ course.course_name }}
                                    </td>
                                    <td class="py-2">
                                        <span
                                            class="inline-block w-3 h-3 rounded-full bg-green-500 mr-2"
                                        ></span>
                                        Registered
                                    </td>
                                    <td class="py-2">
                                        {{ course.proctorStatus }}
                                    </td>
                                    <td class="py-2">Future Payment</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div
                        v-if="currentTab === 'past'"
                        class="bg-white rounded-lg shadow-md p-6"
                    >
                        <h2 class="text-xl font-semibold mb-4">PAST COURSES</h2>
                        <!-- Add past courses table here if needed -->
                    </div>
                </div>

                <!-- Right column -->
                <div class="w-1/3">
                    <!-- Academic Progress Section -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">
                            ACADEMIC PROGRESS
                        </h2>
                        <p class="mb-2">
                            You can take up to 4 courses this term. Check our
                            course load policy.
                        </p>

                        <!-- Academic Progress Grid -->
                        <div class="flex space-x-4">
                            <div class="w-1/3 text-center">
                                <p class="text-lg font-bold text-purple-800">
                                    Major Required
                                </p>
                                <p class="text-sm">
                                    {{ studentProgram.majorCompleted }}
                                    /
                                    {{ academicProgress.totalMajors }}
                                </p>
                            </div>
                            <div class="w-1/3 text-center">
                                <p class="text-lg font-bold text-purple-800">
                                    General Education
                                </p>
                                <p class="text-sm">
                                    {{ academicProgress.genEdCompleted }} /
                                    {{ academicProgress.totalGenEd }}
                                </p>
                            </div>
                            <div class="w-1/3 text-center">
                                <p class="text-lg font-bold text-purple-800">
                                    Electives
                                </p>
                                <p class="text-sm">
                                    {{ academicProgress.electivesCompleted }} /
                                    {{ academicProgress.totalElectives }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">CHECKLIST</h2>
                        <p class="mb-4">Stay on track this term:</p>
                        <ul class="list-disc pl-6">
                            <li class="mb-2">Run Degree Audit</li>
                            <li>Register for classes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: {
        studentProgram: {
            type: Object,
            require: true,
        },
    },
    data() {
        return {
            currentTab: "current", // Controls the tab view
            currentCourses: [
                {
                    id: 1,
                    course_name: "Software Engineering 2",
                    isRetake: true,
                    proctorStatus: "Not Proctored",
                },
                {
                    id: 2,
                    course_name: "Operating Systems 2",
                    isRetake: false,
                    proctorStatus: "Proctor approved",
                },
                {
                    id: 3,
                    course_name: "Comparative Programming Languages",
                    isRetake: true,
                    proctorStatus: "Proctor approved",
                },
                {
                    id: 4,
                    course_name: "Systems & Application Security",
                    isRetake: false,
                    proctorStatus: "Not Proctored",
                },
            ],
            academicProgress: {
                majorCompleted: 8,
                totalMajors: 12,
                genEdCompleted: 6,
                totalGenEd: 8,
                electivesCompleted: 2,
                totalElectives: 4,
            },
        };
    },
};
</script>
