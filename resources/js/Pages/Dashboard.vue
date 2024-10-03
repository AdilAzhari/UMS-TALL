<template>
    <div class="flex h-screen bg-gray-100">
        <Sidebar
            :is-sidebar-open="isSidebarOpen"
            @toggle-sidebar="toggleSidebar"
        />
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Sidebar from "@/Views/Sidebar.vue";

const isSidebarOpen = ref(false);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
</script>
