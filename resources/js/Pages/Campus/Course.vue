<template>
    <div class="course-page bg-gray-50 min-h-screen p-6">
        <!-- Header Section -->
        <header class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                {{ course.name }} <span class="text-indigo-500">({{ course.code }})</span>
            </h1>
        </header>

        <!-- Tabs Section -->
        <section>
            <!-- Tabs Header -->
            <div class="flex justify-center mb-4 border-b border-gray-200">
                <button
                    v-for="(tab, index) in tabs"
                    :key="index"
                    :class="{
            'text-indigo-600 border-b-2 border-indigo-500 font-semibold':
              activeTab === index,
          }"
                    class="tab-button py-2 px-4 text-gray-600 hover:text-indigo-600 focus:outline-none transition-all duration-200"
                    @click="activeTab = index"
                >
                    <i :class="[tab.iconClass, 'mr-2']"></i>
                    {{ tab.title }}
                </button>
            </div>

            <!-- Tabs Content -->
            <div class="bg-white shadow rounded-md p-6">
                <div v-if="activeTab === 0">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Announcements</h3>
                    <p class="text-gray-600">
                        Welcome to the course! Check here for the latest updates, schedules, and important reminders.
                    </p>
                </div>

                <div v-if="activeTab === 1">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Forum Discussion</h3>
                    <p class="text-gray-600">
                        Engage with your peers! Post questions, share ideas, and contribute to the discussion.
                    </p>
                </div>

                <div v-if="activeTab === 2">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Resources</h3>
                    <ul class="list-disc list-inside text-gray-600">
                        <li><a class="text-indigo-500 hover:underline" href="#">Course Syllabus (PDF)</a></li>
                        <li><a class="text-indigo-500 hover:underline" href="#">Additional Reading Material</a></li>
                        <li><a class="text-indigo-500 hover:underline" href="#">Helpful Links</a></li>
                    </ul>
                </div>

                <div v-if="activeTab === 3">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">FAQs</h3>
                    <p class="text-gray-600">
                        Browse frequently asked questions to clarify any doubts related to the course.
                    </p>
                </div>
            </div>
        </section>

        <!-- Weekly Units Section -->
        <section class="mt-8">
            <div
                v-for="(week, index) in weeks"
                :key="week.id"
                class="mb-4 bg-white shadow rounded-md overflow-hidden"
            >
                <!-- Week Header -->
                <div
                    class="flex justify-between items-center p-4 bg-indigo-500 text-white cursor-pointer hover:bg-indigo-600"
                    @click="toggleWeek(index)"
                >
                    <div>
                        <h2 class="text-lg font-semibold">Week {{ index + 1 }}: {{ week.title }}</h2>
                        <p class="text-sm opacity-80">{{ week.startDate }} - {{ week.endDate }}</p>
                    </div>
                    <i
                        :class="[
              'fas',
              week.isOpen ? 'fa-chevron-up' : 'fa-chevron-down',
              'transition-transform duration-300',
            ]"
                    ></i>
                </div>

                <!-- Week Content -->
                <div v-show="week.isOpen" class="p-4 bg-gray-50">
                    <div
                        v-for="content in week.contents"
                        :key="content.id"
                        class="flex items-start mb-3"
                    >
                        <i :class="[content.iconClass, 'text-indigo-500 text-xl mr-4']"></i>
                        <div>
                            <h4 class="font-semibold text-gray-700">{{ content.title }}</h4>
                            <p v-if="content.todo" class="text-sm text-gray-600">
                                <strong>To do:</strong> {{ content.todo }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "CoursePageWithTabs",
    data() {
        return {
            course: {
                name: "Dynamic Programming",
                code: "CS 4407-01",
            },
            tabs: [
                {title: "Announcements", iconClass: "fas fa-bullhorn"},
                {title: "Forum Discussion", iconClass: "fas fa-comments"},
                {title: "Resources", iconClass: "fas fa-folder-open"},
                {title: "FAQs", iconClass: "fas fa-question-circle"},
            ],
            activeTab: 0,
            weeks: [
                {
                    id: 1,
                    title: "Introduction to Dynamic Programming",
                    startDate: "2024-01-08",
                    endDate: "2024-01-14",
                    isOpen: false,
                    contents: [
                        {id: 1, title: "Learning Guide", iconClass: "fas fa-book-open", todo: "Read notes."},
                        {id: 2, title: "Forum Discussion", iconClass: "fas fa-comments", todo: "Post ideas."},
                        {id: 3, title: "Assignment", iconClass: "fas fa-tasks", todo: "Submit homework."},
                    ],
                },
                ...Array.from({length: 3}, (_, i) => ({
                    id: i + 2,
                    title: `Advanced Topic ${i + 1}`,
                    startDate: `2024-01-${15 + i * 7}`,
                    endDate: `2024-01-${21 + i * 7}`,
                    isOpen: false,
                    contents: [
                        {id: 1, title: `Lecture ${i + 1}`, iconClass: "fas fa-chalkboard-teacher"},
                        {id: 2, title: `Assignment ${i + 1}`, iconClass: "fas fa-tasks"},
                    ],
                })),
            ],
        };
    },
    methods: {
        toggleWeek(index) {
            this.weeks[index].isOpen = !this.weeks[index].isOpen;
        },
    },
};
</script>

<style scoped>
.tab-button {
    @apply text-sm md:text-base;
}
</style>
