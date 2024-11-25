<template>
    <div class="comments-section">
        <h3 class="text-lg font-medium text-gray-800">Comments</h3>

        <!-- Comment Input -->
        <div class="comment-input bg-white rounded-lg shadow-md p-6 mt-6">
            <textarea
                v-model="newCommentText"
                placeholder="Write your comment..."
                class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-300 focus:outline-none resize-none"
            ></textarea>
            <button
                @click="submitComment"
                class="mt-2 bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 px-6 rounded-lg"
            >
                Post Comment
            </button>
        </div>
        <div v-if="$page.props.flash.message" class="flash-message success">
            {{ $page.props.flash.message }}
        </div>
        <div v-if="$page.props.flash.error" class="flash-message error">
            {{ $page.props.flash.error }}
        </div>

        <!-- Display Comments -->
        <div class="comments mt-8 space-y-4">
            <div
                v-for="comment in comments"
                :key="comment.id"
                class="comment bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm"
            >
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-800">
                            {{ comment.student.user.name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ comment.created_at_human }}
                        </p>
                    </div>
                    <div>
                        <button
                            @click="toggleReplyForm(comment.id)"
                            class="text-blue-600 text-xs hover:underline"
                        >
                            Reply
                        </button>
                    </div>
                </div>
                <p class="text-sm text-gray-700 mt-2">{{ comment.content }}</p>

                <!-- Reply Form -->
                <div v-if="isReplyingToComment(comment.id)" class="mt-4">
                    <textarea
                        v-model="replyText"
                        placeholder="Write your reply..."
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-300 focus:outline-none resize-none"
                    ></textarea>
                    <button
                        @click="submitReply(comment.id)"
                        class="mt-2 bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 px-6 rounded-lg"
                    >
                        Post Reply
                    </button>
                </div>

                <!-- Display Subcomments -->
                <div
                    v-if="comment.replies && comment.replies.length"
                    class="mt-4 ml-6"
                >
                    <div
                        v-for="subcomment in comment.replies"
                        :key="subcomment.id"
                        class="subcomment bg-gray-100 p-4 rounded-lg shadow-sm"
                    >
                        <p class="text-sm font-medium text-gray-800">
                            {{ subcomment.student.user.name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ subcomment.created_at_human }}
                        </p>
                        <p class="text-sm text-gray-700 mt-2">
                            {{ subcomment.content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayoutVue from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayoutVue,
    props: {
        comments: Array, // Array of initial comments with nested replies
        storyId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            newCommentText: "", // Text for new comment
            replyText: "", // Text for new reply
            replyingToCommentId: null, // The ID of the comment being replied to
        };
    },

    methods: {
        // Toggle the visibility of the reply form for a specific comment
        toggleReplyForm(commentId) {
            if (this.replyingToCommentId === commentId) {
                this.replyingToCommentId = null; // Close the reply form if it's already open
            } else {
                this.replyingToCommentId = commentId; // Open reply form for this comment
            }
        },

        // Submit a new comment
        submitComment() {
            if (this.newCommentText.trim()) {
                this.$inertia.post(
                    "/comments",
                    {
                        content: this.newCommentText.trim(),
                        story_id: this.storyId, // Use the `storyId` prop
                        parent_id: null, // No parent ID for top-level comments
                    },
                    {
                        onSuccess: (response) => {
                            if (response.props.newComment) {
                                this.comments.unshift(
                                    response.props.newComment
                                );
                                this.newCommentText = ""; // Reset comment text
                            }
                        },
                        onError: () => {
                            alert(
                                "Failed to submit the comment. Please try again."
                            );
                        },
                    }
                );
            } else {
                alert("Comment cannot be empty!");
            }
        },

        // Submit a reply to a specific comment
        submitReply(commentId) {
            if (this.replyText.trim()) {
                this.$inertia.post(
                    "/comments",
                    {
                        content: this.replyText.trim(),
                        story_id: this.storyId, // Use the `storyId` prop
                        parent_id: commentId, // Pass the parent comment ID
                    },
                    {
                        onSuccess: (response) => {
                            if (response.props.newReply) {
                                const parentComment = this.comments.find(
                                    (c) => c.id === commentId
                                );
                                parentComment.replies.push(
                                    response.props.newReply
                                );
                                this.replyText = ""; // Reset reply text
                                this.replyingToCommentId = null; // Close reply form
                            }
                        },
                        onError: () => {
                            alert(
                                "Failed to submit the reply. Please try again."
                            );
                        },
                    }
                );
            } else {
                alert("Reply cannot be empty!");
            }
        },
        // Check if we are replying to a specific comment
        isReplyingToComment(commentId) {
            return this.replyingToCommentId === commentId;
        },
    },
};
</script>

<style scoped>
.comment {
    border-left: 4px solid #4b90e3;
    background-color: #f8f9fa;
}
.subcomment {
    background-color: #f1f1f1;
    border-left: 2px solid #2c6bb6;
}
.comment-input {
    border-radius: 8px;
}
.subcomment {
    background-color: #f1f1f1;
    border-left: 2px solid #2c6bb6;
    margin-left: 20px; /* Indentation for nested replies */
    padding: 10px;
}
.flash-message {
    padding: 10px;
    margin-top: 10px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
}
.success {
    background-color: #d1e7dd;
    color: #0f5132;
}
.error {
    background-color: #f8d7da;
    color: #842029;
}
</style>
