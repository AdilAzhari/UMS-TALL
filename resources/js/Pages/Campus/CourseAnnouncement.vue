<template>
    <Head>
        <Title> Announcements </Title>
    </Head>
    <div class="announcement-page min-h-screen bg-gray-50">
        <!-- Page Header -->
        <div class="bg-indigo-100 py-6">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-extra bold text-indigo-800">
                    Course Announcements
                </h2>
                <p class="text-gray-600 mt-2">
                    Stay informed with the latest updates and announcements.
                </p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto py-8 px-6">
            <section>
                <div v-if="announcements.length > 0">
                    <div
                        v-for="announcement in announcements"
                        :key="announcement.id"
                        class="flex items-center justify-between bg-white rounded-lg shadow-md p-4 mb-4 hover:shadow-lg transition"
                    >
                        <!-- Title and Author -->
                        <div>
                            <Link
                                :to="`/campus/course/1
                                /announcements/${announcement.id}`"
                                class="text-lg font-semibold text-indigo-700 hover:underline"
                            >
                                {{ announcement.title }}
                            </Link>
                            <p class="text-sm text-gray-500">
                                By: {{ announcement.author }}
                            </p>
                        </div>

                        <!-- Replies Count and Timestamp -->
                        <div class="text-right">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-comments text-indigo-600"></i> {{ announcement.replies_count }} Replies
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ formatDate(announcement.created_at) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- No Announcements -->
                <div v-else>
                    <p class="text-gray-600 text-center">No announcements available yet.</p>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3'

export default {
    name: "AnnouncementList",
    components: {
        Link
    },
    data() {
        return {
            announcements: [
                {
                    id: 1,
                    title: "Week 2 Announcement",
                    author: "Dr. Thomas",
                    created_at: "2024-12-20T10:00:00Z",
                    replies_count: 5
                },
                {
                    id: 2,
                    title: "Week 3 Assignment Due",
                    author: "Prof. John",
                    created_at: "2024-12-18T14:30:00Z",
                    replies_count: 2
                },
                {
                    id: 3,
                    title: "Exam Preparation Resources",
                    author: "Dr. Jane",
                    created_at: "2024-12-15T09:00:00Z",
                    replies_count: 10
                },
                {
                    id: 4,
                    title: "Holiday Schedule Update",
                    author: "Admin Team",
                    created_at: "2024-12-10T08:45:00Z",
                    replies_count: 0
                },
                {
                    id: 5,
                    title: "New Course Materials Available",
                    author: "Dr. Emily",
                    created_at: "2024-12-08T12:00:00Z",
                    replies_count: 3
                },
                {
                    id: 6,
                    title: "Mid-Term Exam Guidelines",
                    author: "Prof. Alan",
                    created_at: "2024-12-05T11:20:00Z",
                    replies_count: 8
                },
            ],
        };
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleDateString("en-US", {
                year: "numeric",
                month: "short",
                day: "numeric",
            });
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 1000px;
    margin: 0 auto;
}
</style>
