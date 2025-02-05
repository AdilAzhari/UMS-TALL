<template>
    <div>
        <CampusHeader/>
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <main class="content-area">
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
            <slot/>
        </main>
    </div>
</template>

<script>
import CampusHeader from '@/./Components/Campus/Header.vue';
import Breadcrumbs from '@/./Components/Campus/Breadcrumb.vue';
import {ref, watch} from "vue";
import {usePage} from "@inertiajs/vue3";

export default {
    name: 'CampusLayout',
    components: {
        CampusHeader,
        Breadcrumbs,
    },
    props: {
        breadcrumbs: {
            type: Array,
            required: true,
            default: () => [
                {label: 'Home', path: '/'},
                {label: 'Campus Courses', path: '/dashboard'},
            ],
        },
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
};
</script>

<style scoped>
.content-area {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
}
</style>
