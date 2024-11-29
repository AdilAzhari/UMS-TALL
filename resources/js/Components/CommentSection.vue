<template>
    <div class="comments-section">
        <h3 class="text-lg font-medium text-gray-800">Comments</h3>

        <!-- Comment Input -->
        <div class="comment-input bg-white rounded-lg shadow-md p-6 mt-6">
            <textarea
                v-model="form.content"
                class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-300 focus:outline-none resize-none"
                placeholder="Write your comment..."
            ></textarea>
            <button
                :disabled="form.processing"
                class="mt-2 bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 px-6 rounded-lg"
                @click="submitComment"
            >
                Post Comment
            </button>
        </div>

        <!-- Flash Message Section -->
        <div v-if="$page.props.flash?.success" class="flash-message success">
            {{ $page.props.flash.success }}
        </div>
        <div v-if="$page.props.flash?.error" class="flash-message error">
            {{ $page.props.flash.error }}
        </div>

        <!-- Display Comments -->
        <div class="comments mt-8 space-y-4">
            <CommentList
                :auth="auth"
                :comments="localComments"
                :storyId="props.storyId"
                @add-reply="addReplyToLocalComments"
                @update-comment="updateLocalComment"
                @remove-comment="removeCommentOrReply"
            />
        </div>
    </div>
</template>

<script setup>
import {reactive} from "vue";
import {useForm} from "@inertiajs/vue3";
import CommentList from "../CommentList.vue"; // Adjust path as needed

const props = defineProps({
    comments: Array, // Parent comments with nested replies
    storyId: Number,
    auth: Object,
});

const form = useForm({
    content: "",
    story_id: props.storyId,
    parent_id: null, // Used for replies
});

const localComments = reactive([...props.comments]);

// Method for handling local state updates
const addReplyToLocalComments = (parentId, reply) => {
    const parentComment = findCommentOrReply(localComments, parentId);
    if (parentComment) {
        parentComment.replies = parentComment.replies || [];
        parentComment.replies.push(reply);
    }
};

// Utility to find a comment or reply by ID
const findCommentOrReply = (comments, id) => {
    for (const comment of comments) {
        if (comment.id === id) {
            return comment;
        }
        if (comment.replies && comment.replies.length > 0) {
            const found = findCommentOrReply(comment.replies, id);
            if (found) {
                return found;
            }
        }
    }
    return null;
};

// Method for submitting the comment (or reply if parent_id is set)
const submitComment = () => {
    if (form.content.trim()) {
        // Handle submitting a new comment or a reply
        form.post(`/storyComment/${props.storyId}/comments`, {
            onSuccess: (response) => {
                if (response.props && response.props.comment) {
                    if (form.parent_id) {
                        // If this is a reply, add it to the parent comment's replies
                        addReplyToLocalComments(form.parent_id, response.props.comment);
                    } else {
                        // If this is a new comment, add it to the localComments list
                        localComments.push(response.props.comment);
                    }
                }
                // Reset the form after successful submission
                form.reset();
            },
            onError: (errors) => {
                console.error("Error submitting comment:", errors);
                alert("Failed to submit comment. Please try again.");
            },
        });
    } else {
        alert("Comment cannot be empty!");
    }
};
</script>
