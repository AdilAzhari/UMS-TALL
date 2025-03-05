<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
        <!-- Notification -->
        <transition name="slide-fade">
            <div v-if="flashMessage"
                 class="fixed top-4 right-4 z-50 flex items-center justify-between p-4 bg-green-500 text-white rounded-lg shadow-lg max-w-sm">
                <span>{{ flashMessage }}</span>
                <button @click="dismissNotification" class="ml-4 p-1 hover:bg-green-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </transition>
        <!-- Header with More Structured Information -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="p-6 bg-indigo-50 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-indigo-800 mb-2">{{ announcement.title }}</h2>
                <div class="flex items-center justify-between text-gray-600">
                    <div class="flex items-center space-x-3">
                        <img
                            :src="announcement.user.avatar || '/default-avatar.png'"
                            class="w-10 h-10 rounded-full object-cover"
                            :alt="announcement.user.name"
                        />
                        <span class="text-sm font-medium">{{ announcement.user.name }}</span>
                    </div>
                    <p class="text-xs text-gray-500">
                        Created: {{ formatDate(announcement.created_at) }}
                    </p>
                </div>
            </div>

            <!-- Announcement Content with Enhanced Styling -->
            <div class="p-6">
                <p class="text-gray-700 leading-relaxed">
                    {{ announcement.message || "No additional details provided." }}
                </p>
            </div>
        </div>

        <!-- Replies Section with Improved Layout -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">
                    Replies ({{ announcement.comments.length }})
                </h3>
                <span
                    v-if="announcement.comments.length === 0"
                    class="text-sm text-gray-500 italic"
                >
                    Be the first to reply!
                </span>
            </div>

            <!-- Comments List with Enhanced Design -->
            <div v-if="announcement.comments.length > 0" class="divide-y divide-gray-100">
                <div
                    v-for="reply in sortedComments"
                    :key="reply.id"
                    class="p-4 hover:bg-gray-50 transition-colors comment-item"
                >
                    <div class="flex items-start space-x-3">
                        <img
                            :src="reply.user.avatar || '/default-avatar.png'"
                            class="w-8 h-8 rounded-full object-cover mt-1"
                            :alt="reply.user.name"
                        />
                        <div>
                            <p class="text-gray-600 text-sm">{{ reply.comment }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ reply.user.name }} • {{ formatRelativeTime(reply.created_at) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reply Form with Enhanced Interaction -->
        <form @submit.prevent="submitReply" class="mt-6 bg-white rounded-xl shadow-md p-6">
            <textarea
                v-model="newReply"
                class="w-full p-3 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300"
                rows="4"
                placeholder="Write a thoughtful reply..."
                aria-label="Reply to announcement"
                aria-describedby="reply-help"
                required
                maxlength="500"
            ></textarea>
            <div class="flex justify-between items-center mt-3">
                <span class="text-xs text-gray-500">
                    {{ newReply.length }}/500 characters
                </span>
                <button
                    type="submit"
                    :disabled="!newReply.trim() || newReply.length > 500 || isSubmitting"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm
                           hover:bg-indigo-700 transition-colors
                           disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    {{ isSubmitting ? 'Submitting...' : 'Submit Reply' }}
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import {router, usePage} from '@inertiajs/vue3'; // Import router
import campusLayout from "@/Layouts/CampusLayout.vue";
import {computed, ref, watch} from "vue";

export default {
    layout: campusLayout,
    name: "AnnouncementDetails",
    props: {
        announcement: {
            type: Object,
            required: true,
            validator: (obj) => {
                return obj.title && obj.user && obj.message && Array.isArray(obj.comments);
            }
        },
        courseId: {
            type: Number,
            required: true,
        }
    },
    data() {
        return {
            newReply: "",
            maxReplyLength: 500,
            isSubmitting: false,
        };
    },
    mounted() {
        console.log("Component mounted.", this.courseId);
    },
    setup() {
        const page = usePage();
        const flashMessage = ref(page.props.flash.message);
        let timeoutId = null;

        // Watch for changes in flash.message
        watch(
            () => page.props.flash.message,
            (message) => {
                if (message) {
                    flashMessage.value = message;

                    // Clear the message after 5 seconds
                    if (timeoutId) clearTimeout(timeoutId);
                    timeoutId = setTimeout(() => {
                        flashMessage.value = null;
                    }, 5000);
                }
            }
        );

        // Manually dismiss the notification
        const dismissNotification = () => {
            flashMessage.value = null;
            if (timeoutId) clearTimeout(timeoutId);
        };

        return {
            flashMessage,
            dismissNotification,
        };
    },
    computed: {
        sortedComments() {
            return [...this.announcement.comments].sort(
                (a, b) => new Date(b.created_at) - new Date(a.created_at)
            );
        }
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleDateString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit",
            });
        },
        formatRelativeTime(date) {
            const now = new Date();
            const targetDate = new Date(date);

            if (isNaN(targetDate)) return "Invalid date";

            const diff = (now - targetDate) / 1000;

            if (diff < 60) return "Just now";
            if (diff < 3600) return `${Math.floor(diff / 60)} min ago`;
            if (diff < 86400) return `${Math.floor(diff / 3600)} hours ago`;
            return this.formatDate(date);
        },
        async submitReply() {
            if (this.isSubmitting) return;
            if (!this.newReply.trim()) {
                alert("Reply cannot be empty.");
                return;
            }
            if (this.newReply.length > this.maxReplyLength) {
                alert(`Reply cannot exceed ${this.maxReplyLength} characters.`);
                return;
            }

            this.isSubmitting = true;
            try {
                await router.post(
                    route('campus.course.announcements.storeComment', {courseId: this.courseId}),
                    {
                        comment: this.newReply,
                        announcement_id: this.announcement.id,
                        course_id: this.courseId,
                    },
                    {
                        preserveScroll: true,
                        onSuccess: () => {
                            this.newReply = "";
                        },
                        onError: (errors) => {
                            alert("Failed to submit reply. Please try again.");
                        },
                    }
                );
            } catch (error) {
                alert("An unexpected error occurred. Please try again.");
            } finally {
                this.isSubmitting = false;
            }
        }
    }
};
</script>

<style scoped>
/* Notification Animation */
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: translateX(100%);
}

/* Textarea and other styles */
textarea {
    resize: none;
    transition: all 0.3s ease;
}

textarea:focus {
    box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.5);
}

.comment-item:hover {
    background-color: #f9fafb; /* Light gray background on hover */
    transform: translateY(-2px); /* Slight lift effect */
    transition: all 0.2s ease;
}
</style>
