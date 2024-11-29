<template>
    <Head>
        <title>Story Detail</title>
    </Head>
    <div class="story-detail bg-gray-50 min-h-screen flex justify-center py-8">
        <main class="max-w-4xl w-full flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8">
            <!-- Main Content -->
            <div class="flex-1">
                <!-- Story Card -->
                <section
                    class="story-card bg-white rounded-lg shadow-md p-6 space-y-4 border border-gray-200"
                >
                    <h2 class="text-2xl font-semibold text-gray-800">{{ story.title }}</h2>
                    <p class="text-sm text-gray-500">
                        by <span class="font-medium">{{ story.student.user.name }}</span> •
                        {{ story.published_at }}
                    </p>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        {{ story.content }}
                    </p>
                </section>

                <!-- Navigation to Stories Index -->
                <div class="flex justify-end mt-6">
                    <Link
                        class="flex items-center space-x-2 text-sm font-medium bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg transition"
                        href="/stories"
                    >
                        <button type="button"></button>
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M19.5 12h-15m0 0l6-6m-6 6l6 6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>Back to Stories</span>
                    </Link>
                </div>

                <!-- Like Button -->
                <div class="text-center mt-6">
                    <button
                        :class="isLiked ? 'bg-blue-600' : 'bg-gray-300'"
                        class="py-2 px-6 text-sm font-medium rounded-full text-white transition-transform transform hover:scale-105"
                        @click="toggleLike"
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
                <comment-section :auth="story.student.user"
                                 :comments="comments"
                                 :storyId="story.id"
                                 @add-reply="handleAddReply"
                />
            </div>

            <!-- Recommended Stories -->
            <aside class="w-full lg:w-1/3 bg-gray-50 p-6 space-y-6">
                <h3 class="text-lg font-medium text-gray-800">Recommended Stories</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
                    <div
                        v-for="recommendedStory in recommendedStories"
                        :key="recommendedStory.id"
                        class="recommendation-card bg-white rounded-lg shadow-lg overflow-hidden group transform transition-all hover:scale-105 hover:shadow-2xl"
                    >
                        <div class="relative">
                            <img
                                :src="recommendedStory.image_url || '/default-image.jpg'"
                                alt="Story Image"
                                class="w-full h-48 object-cover"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black opacity-50"></div>
                            <div class="absolute bottom-4 left-4 text-white font-semibold text-lg">
                                {{ recommendedStory.title }}
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-sm text-gray-500">
                                by {{ recommendedStory.student.user.name }}
                            </p>
                        </div>
                        <div class="px-4 pb-4">
                            <a
                                :href="route('stories.show', recommendedStory.id)"
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
import CommentSection from "@/Components/CommentSection.vue";

export default {
    components: {
        CommentSection
    },
    layout: AppLayoutVue,
    props: {
        story: Object,
        comments: Array,
        recommendedStories: Array, // Add this prop to receive recommended stories
    },
    data() {
        return {
            localComments: [...this.comments],
            isLiked: false,
        };
    },
    methods: {
        toggleLike() {
            this.isLiked = !this.isLiked;
        },
        handleAddReply({commentId, text}) {
            const comment = this.comments.find((c) => c.id === commentId);
            if (comment) {
                comment.replies.push({id: Date.now(), text});
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
