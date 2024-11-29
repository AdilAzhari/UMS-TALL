<template>
    <div>
        <div
            v-for="comment in comments"
            :key="comment.id"
            class="comment bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm"
        >
            <div class="flex justify-between items-start">
                <div class="flex-grow">
                    <p class="text-sm font-medium text-gray-800">
                        {{ comment.student.user.name }}
                    </p>
                    <p class="text-xs text-gray-500">{{ comment.published_at }}</p>
                    <p class="text-sm text-gray-800 mt-2">
                        {{ comment.content }}
                    </p>
                </div>
                <div class="flex flex-col items-end space-y-2">
                    <div v-if="auth.id === comment.student.user.id" class="flex space-x-2">
                        <button
                            class="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                            @click="startEditing(comment)"
                        >
                            Edit
                        </button>
                        <button
                            class="text-red-600 hover:text-red-800 transition-colors duration-200"
                            @click="deleteComment(comment.id)"
                        >
                            Delete
                        </button>
                    </div>
                    <button
                        class="text-blue-600 hover:text-blue-800 transition-colors duration-200 text-xs"
                        @click="toggleReply(comment.id)"
                    >
                        Reply
                    </button>
                </div>
            </div>

            <!-- Reply Form -->
            <div v-if="isReplyingToComment(comment.id)" class="mt-4">
                <textarea
                    v-model="form.content"
                    class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-300 focus:outline-none resize-none"
                ></textarea>
                <div class="flex space-x-2 mt-2">
                    <button
                        :disabled="form.processing"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 px-6 rounded-lg"
                        @click="submitReply(comment.id)"
                    >
                        Post Reply
                    </button>
                    <button
                        class="bg-gray-300 hover:bg-gray-400 text-black text-sm py-2 px-6 rounded-lg"
                        @click="cancelReply"
                    >
                        Cancel
                    </button>
                </div>
            </div>

            <!-- Nested Replies -->
            <CommentList
                v-if="comment.replies && comment.replies.length"
                :auth="auth"
                :comments="comment.replies"
                :storyId="storyId"
                @add-reply="$emit('add-reply', ...arguments)"
                @update-comment="$emit('update-comment', ...arguments)"
                @remove-comment="$emit('remove-comment', ...arguments)"
            />
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    comments: Array,
    auth: Object,
    storyId: Number,
});

const form = useForm({
    content: "",
    parent_id: null,
});

const replyingToCommentId = ref(null);

const isReplyingToComment = (commentId) => replyingToCommentId.value === commentId;
const toggleReply = (commentId) => {
    replyingToCommentId.value = replyingToCommentId.value === commentId ? null : commentId;
};
const cancelReply = () => {
    replyingToCommentId.value = null;
    form.content = "";
};

const submitReply = (parentId) => {
    form.parent_id = parentId;
    form.post(`/storyComment/${props.storyId}/comments`, {
        onSuccess: (response) => {
            if (response.props && response.props.comment) {
                $emit("add-reply", parentId, response.props.comment);
            }
            cancelReply();
        },
    });
};
</script>
