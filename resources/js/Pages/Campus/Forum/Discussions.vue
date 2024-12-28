<!-- resources/js/Pages/Forums/Index.vue -->
<script setup>
import {ref} from 'vue'
import {Link} from '@inertiajs/vue3'
import {Calendar, Filter, MessageCircle, Search, User} from 'lucide-vue-next'

const discussions = ref([
    {
        id: 1,
        title: "How to approach Dynamic Programming problems?",
        author: "John Doe",
        replies: 23,
        views: 156,
        created_at: "2024-01-15",
        category: "Algorithms",
        lastReply: "2024-01-20"
    },
    {
        id: 2,
        title: "Best practices for React State Management",
        author: "Jane Smith",
        replies: 45,
        views: 289,
        created_at: "2024-01-14",
        category: "Web Development",
        lastReply: "2024-01-19"
    },
])
</script>

<template>
    <div class="p-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Forum Discussions</h1>
            <Link
                :href="route('discussions.create')"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
            >
                Start New Discussion
            </Link>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4">
                <div class="flex gap-4 items-center">
                    <div class="flex-1 relative">
                        <Search class="absolute left-3 top-2.5 h-5 w-5 text-gray-400"/>
                        <input
                            class="pl-10 w-full p-2 border rounded-md"
                            placeholder="Search discussions..."
                            type="text"
                        />
                    </div>
                    <div class="flex gap-2">
                        <select class="p-2 border rounded-md">
                            <option>All Categories</option>
                            <option>Algorithms</option>
                            <option>Web Development</option>
                            <option>Database</option>
                        </select>
                        <button class="flex items-center gap-2 p-2 border rounded-md">
                            <Filter class="h-5 w-5"/>
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Discussions List -->
        <div class="space-y-4">
            <div
                v-for="discussion in discussions"
                :key="discussion.id"
                class="bg-white rounded-lg shadow hover:shadow-md transition-shadow"
            >
                <div class="p-4">
                    <div class="flex items-start gap-4">
                        <!-- Discussion Main Content -->
                        <div class="flex-1">
                            <Link
                                :href="route('discussions.show', discussion.id)"
                                class="text-lg font-semibold hover:text-blue-600"
                            >
                                {{ discussion.title }}
                            </Link>
                            <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                                <span class="flex items-center gap-1">
                                    <User class="h-4 w-4"/>
                                    {{ discussion.author }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <Calendar class="h-4 w-4"/>
                                    {{ discussion.created_at }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <MessageCircle class="h-4 w-4"/>
                                    {{ discussion.replies }} replies
                                </span>
                            </div>
                        </div>

                        <!-- Category and Last Reply -->
                        <div class="text-right">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                {{ discussion.category }}
                            </span>
                            <div class="text-sm text-gray-500 mt-2">
                                Last reply: {{ discussion.lastReply }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            <nav class="flex gap-2">
                <button class="px-4 py-2 border rounded-md hover:bg-gray-50">Previous</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md">1</button>
                <button class="px-4 py-2 border rounded-md hover:bg-gray-50">2</button>
                <button class="px-4 py-2 border rounded-md hover:bg-gray-50">3</button>
                <button class="px-4 py-2 border rounded-md hover:bg-gray-50">Next</button>
            </nav>
        </div>
    </div>
</template>
