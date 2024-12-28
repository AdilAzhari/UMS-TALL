<template>
    <div class="min-h-screen bg-gray-50">
        <div class="bg-indigo-100 py-6">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-indigo-800">
                    {{ announcement.title }}
                </h2>
                <p class="text-gray-600 mt-2">By: {{ announcement.author }}</p>
            </div>
        </div>

        <div class="container mx-auto py-8 px-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-700">
                    This is a detailed view of the announcement.
                </p>
                <p class="text-sm text-gray-500 mt-4">
                    Created on: {{ formatDate(announcement.created_at) }}
                </p>
            </div>

            <!-- Replies Section -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Replies ({{ replies.length }})
                </h3>
                <div v-if="replies.length > 0">
                    <div
                        v-for="reply in replies"
                        :key="reply.id"
                        class="bg-gray-100 rounded-lg shadow-sm p-4 mb-4"
                    >
                        <p class="text-gray-600">{{ reply.content }}</p>
                        <p class="text-xs text-gray-400 mt-2">
                            By: {{ reply.author }} | {{ formatDate(reply.created_at) }}
                        </p>
                    </div>
                </div>
                <div v-else>
                    <p class="text-gray-600">No replies yet.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AnnouncementDetails",
    data() {
        return {
            announcement: {
                id: 1,
                title: "Week 2 Announcement",
                author: "Dr. Thomas",
                created_at: "2024-12-20T10:00:00Z",
            },
            replies: [
                {id: 1, content: "Thanks for the update!", author: "Student A", created_at: "2024-12-21T08:00:00Z"},
                {id: 2, content: "Noted.", author: "Student B", created_at: "2024-12-21T09:15:00Z"},
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
