<!-- AppLayout.vue -->
<template>
    <div class="flex h-screen">
        <!-- Sidebar Component -->
        <Sidebar
            :isSidebarOpen="isSidebarOpen"
            @toggleSidebar="toggleSidebar"
        />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <Header />

            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    <slot name="header" />
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import Header from "@/Components/Header.vue";
import Sidebar from "@/Components/Sidebar.vue";

export default {
    components: {
        Header,
        Sidebar,
    },
    setup() {
        const isSidebarOpen = ref(true);

        const toggleSidebar = () => {
            isSidebarOpen.value = !isSidebarOpen.value;
        };

        return {
            isSidebarOpen,
            toggleSidebar,
        };
    },
};
</script>
