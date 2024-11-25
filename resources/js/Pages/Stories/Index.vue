<template>
    <div class="story-detail bg-gray-50 min-h-screen flex justify-center py-8">
        <main
            class="max-w-4xl w-full flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8"
        >
            <!-- Main Content -->
            <div class="flex-1">
                <!-- Story Card -->
                <section
                    class="story-card bg-white rounded-lg shadow-md p-6 space-y-4 border border-gray-200"
                >
                    <h2 class="text-2xl font-semibold text-gray-800">
                        {{ story.title }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        by
                        <span class="font-medium">{{
                            story.student
                        }}</span>
                        •
                        {{ story.published_at_human }}
                    </p>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        {{ story.content }}
                    </p>
                </section>

                <!-- Like Button -->
                <div class="text-center mt-6">
                    <button
                        @click="toggleLike"
                        :class="isLiked ? 'bg-blue-600' : 'bg-gray-300'"
                        class="py-2 px-6 text-sm font-medium rounded-full text-white transition-transform transform hover:scale-105"
                    >
                        {{ isLiked ? "❤️ Liked" : "🤍 Like This Story" }}
                    </button>
                </div>

                <!-- Success Message -->
                <div
                    v-if="$page.props.flash?.success"
                    class="bg-green-100 text-green-800 text-sm p-3 rounded-lg mt-4"
                >
                    {{ $page.props.flash.success }}
                </div>

                <!-- Comments Section -->
                <section
                    class="comments bg-white rounded-lg shadow-md p-6 mt-8 space-y-4"
                >
                    <h3 class="text-lg font-medium text-gray-800">Comments</h3>

                    <!-- Comment Input -->
                    <div class="flex items-start space-x-3">
                        <textarea
                            v-model="commentText"
                            placeholder="Write your comment..."
                            class="flex-1 border border-gray-300 rounded-lg p-2 shadow-sm text-sm focus:ring-2 focus:ring-blue-300 focus:outline-none resize-none"
                        ></textarea>
                        <button
                            @click="submitComment"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-transform transform hover:scale-105"
                        >
                            Post
                        </button>
                    </div>

                    <!-- Display Comments -->
                    <div v-if="comments.length" class="space-y-4">
                        <div
                            v-for="comment in comments"
                            :key="comment.id"
                            class="comment bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-start space-x-3 shadow-sm"
                        >
                            <div class="flex-grow">
                                <p class="text-sm font-medium text-gray-800">
                                    {{ comment.student}}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ comment.created_at_human }}
                                </p>
                                <p class="text-gray-700 text-sm mt-2">
                                    {{ comment.content }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-sm text-gray-500 italic">
                        Be the first to comment!
                    </div>
                </section>
            </div>

            <!-- Recommended Stories -->
            <aside class="w-full lg:w-1/3 bg-gray-50 p-6 space-y-6">
                <h3 class="text-lg font-medium text-gray-800">
                    Recommended Stories
                </h3>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6"
                >
                    <div
                        v-for="recommendedStory in recommendedStories"
                        :key="recommendedStory.id"
                        class="recommendation-card bg-white rounded-lg shadow-lg overflow-hidden group transform transition-all hover:scale-105 hover:shadow-2xl"
                    >
                        <div class="relative">
                            <img
                                :src="
                                    recommendedStory.image_url ||
                                    '/default-image.jpg'
                                "
                                alt="Story Image"
                                class="w-full h-48 object-cover"
                            />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black opacity-50"
                            ></div>
                            <div
                                class="absolute bottom-4 left-4 text-white font-semibold text-lg"
                            >
                                {{ recommendedStory.title }}
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-sm text-gray-500">
                                by {{ recommendedStory.student}}
                            </p>
                        </div>
                        <div class="px-4 pb-4">
                            <a
                                :href="`/stories/${recommendedStory.id}`"
                                class="text-sm text-blue-600 hover:underline"
                            >
                                Read Story
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
        </main>
    </div>
</template>

<script>
import AppLayoutVue from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayoutVue,
    props: {
        story: Object,
        comments: Array,
        recommendedStories: Array, // Add this prop to receive recommended stories
    },
    data() {
        return {
            commentText: "",
            isLiked: false,
        };
    },
    methods: {
        toggleLike() {
            this.isLiked = !this.isLiked;
        },
        async submitComment() {
            if (this.commentText.trim()) {
                try {
                    this.$inertia.post(
                        "/comments",
                        {
                            story_id: this.story.id,
                            content: this.commentText.trim(),
                        },
                        {
                            onSuccess: (page) => {
                                const newComment = page.props.newComment;
                                this.comments.unshift(newComment);
                                this.commentText = "";
                            },
                            onError: (errors) => {
                                console.error(errors);
                                alert(
                                    "Failed to post your comment. Please try again."
                                );
                            },
                        }
                    );
                } catch (error) {
                    console.error("Unexpected error:", error);
                    alert(
                        "Could not post your comment. Please try again later."
                    );
                }
            } else {
                alert("Comment cannot be empty!");
            }
        },
    },
};
</script>

<style scoped>
.story-detail {
    font-family: "Inter", sans-serif;
}

.story-card,
.comments,
aside {
    max-width: 100%;
    border-radius: 12px;
}

.recommendation-card {
    position: relative;
}

.recommendation-card img {
    transition: transform 0.2s ease-in-out;
}

.recommendation-card:hover img {
    transform: scale(1.1);
}

.recommendation-card .bg-gradient-to-t {
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));
}

.recommendation-card a:hover {
    text-decoration: underline;
}

.recommendation-card:hover .bg-gradient-to-t {
    background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0));
}
</style>
