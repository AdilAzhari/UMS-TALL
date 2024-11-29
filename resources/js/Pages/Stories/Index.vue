<template>
    <Head>
        <title>
            Student Stories
        </title>
    </Head>
    <div class="stories-index">
        <!-- Header Section -->
        <header class="bg-white shadow-md rounded-md py-4 px-6 mb-6">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">Student Stories</h1>
                <button
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded shadow-md"
                    @click="navigateToCreateStory"
                >
                    + Share Your Story
                </button>
            </div>
        </header>

        <!-- Main Content Section -->
        <main class="py-4 px-6">
            <div class="container mx-auto">
                <!-- Search and Filter -->
                <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                    <input
                        v-model="searchQuery"
                        class="border border-gray-300 rounded-lg py-2 px-4 w-full md:w-1/2 shadow-sm focus:border-purple-500"
                        placeholder="Search stories..."
                        type="text"
                    />
                    <select
                        v-model="selectedTag"
                        class="border border-gray-300 rounded-lg py-2 px-4 mt-4 md:mt-0 md:ml-4 shadow-sm focus:border-purple-500"
                    >
                        <option value="">All Tags</option>
                        <option
                            v-for="tag in tags"
                            :key="tag.id"
                            :value="tag.name"
                        >
                            {{ tag.name }}
                        </option>
                    </select>
                </div>

                <!-- Stories List -->
                <div
                    v-if="filteredStories.length"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                >
                    <div
                        v-for="story in filteredStories"
                        :key="story.id"
                        class="story-card bg-white border rounded-lg shadow-md p-6 flex flex-col hover:shadow-lg transition-shadow"
                    >
                        <h2
                            class="text-lg font-semibold text-gray-800 truncate"
                        >
                            {{ story.title }}
                        </h2>
                        <p class="text-sm text-gray-600 mt-2 line-clamp-3">
                            {{ story.content }}
                        </p>
                        <div class="mt-auto">
                            <div class="text-xs text-gray-500 mt-4">
                                <span>by {{ story.student.user.name }}</span> •
                                <span>{{ story.published_at }}</span>
                            </div>
                            <button
                                class="text-purple-600 hover:text-purple-800 mt-2 text-sm font-medium"
                                @click="viewStory(story.id)"
                            >
                                Read More
                            </button>
                        </div>
                    </div>
                </div>

                <!-- No Stories Found -->
                <div v-else class="text-center text-gray-600 mt-12">
                    <p>No stories found. Be the first to share yours!</p>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-12">
                    <Pagination :links="stories.links"/>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import AppLayoutVue from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";

export default {
    components: {Pagination},
    layout: AppLayoutVue,
    props: {
        stories: Object, // Stories data with pagination from the backend
        tags: Array, // Tags data from the backend
    },
    data() {
        return {
            searchQuery: "",
            selectedTag: "",
        };
    },
    computed: {
        filteredStories() {
            let result = this.stories.data; // Stories on the current page

            // Filter by search query
            if (this.searchQuery) {
                result = result.filter((story) =>
                    story.title
                        .toLowerCase()
                        .includes(this.searchQuery.toLowerCase())
                );
            }

            // Filter by selected tag
            if (this.selectedTag) {
                result = result.filter((story) =>
                    story.tags.some((tag) => tag.name === this.selectedTag)
                );
            }

            return result;
        },
    },
    methods: {
        navigateToCreateStory() {
            this.$inertia.visit("/stories/create"); // Redirect to create story page
        },
        viewStory(id) {
            this.$inertia.visit(`/stories/${id}`); // Redirect to the individual story page
        },
    },
};
</script>

<style scoped>
/* Utility class for truncating text to 3 lines */
.line-clamp-3 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}

/* Add hover effect to the story cards */
.story-card:hover {
    transform: scale(1.02);
    transition: transform 0.2s ease-in-out;
}
</style>
