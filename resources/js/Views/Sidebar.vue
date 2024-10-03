da
<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { defineProps, defineEmits } from "vue";
import {
    HomeIcon,
    CreditCardIcon,
    AcademicCapIcon,
    MegaphoneIcon,
    TrophyIcon,
    DocumentTextIcon,
    UserGroupIcon,
    LinkIcon,
    ComputerDesktopIcon,
} from "@heroicons/vue/24/outline";

const isSidebarOpen = ref(true);
const emit = defineEmits(["toggle-sidebar"]);
const props = defineProps(["isSidebarOpen"]);

const toggleSidebar = () => {
    emit("toggle-sidebar");
};

const menuItems = [
    { name: "Home", icon: HomeIcon, route: "Home" },
    { name: "Payments", icon: CreditCardIcon, route: "payments" },
    { name: "My Courses", icon: AcademicCapIcon, route: "courses" },
    { name: "Share Your Story!", icon: MegaphoneIcon, route: "share" },
    { name: "Academic Achievements", icon: TrophyIcon, route: "achievements" },
    { name: "Self Service Forms", icon: DocumentTextIcon, route: "forms" },
    { name: "Admissions", icon: UserGroupIcon, route: "admissions" },
    { name: "Useful Links", icon: LinkIcon, route: "links" },
    {
        name: "Online Campus",
        icon: ComputerDesktopIcon,
        route: "online-campus",
    },
];
</script>

<template>
    <div
        :class="[
            'bg-purple-800 text-white space-y-1 py-7 px-2 transition-all duration-300 ease-in-out',
            { 'w-64': isSidebarOpen, 'w-16': !isSidebarOpen },
        ]"
        class="relative"
    >
        <!-- Toggle Button -->
        <button
            @click="$emit('toggle-sidebar')"
            class="absolute top-5 right-5 text-white"
        >
            <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

        <!-- University Logo and Title -->
        <div class="flex justify-center mb-4">
            <!-- Logo when sidebar is closed or opened -->
            <img
                src="../../../public/images/logo Nova Horizon University (NHU).webp"
                alt="Nova Horizon University (NHU)"
                class="h-10 w-auto"
            />

            <!-- University Title (Visible only when the sidebar is open) -->
            <h2 v-if="isSidebarOpen" class="text-2xl font-bold ml-3">
                Nova Horizon University
            </h2>
        </div>

        <!-- Menu Items -->
        <Link
            v-for="item in menuItems"
            :key="item.name"
            :to="{ name: item.route }"
            class="flex items-center py-3 px-4 rounded hover:bg-purple-700 transition duration-200"
        >
            <!-- Icons -->
            <component :is="item.icon" class="w-6 h-6 text-yellow-400" />

            <!-- Menu Text (Visible only when the sidebar is open) -->
            <span v-if="isSidebarOpen" class="ml-3 text-base font-semibold">
                {{ item.name }}
            </span>
        </Link>
    </div>
</template>

<style scoped>
.logo {
    height: 40px; /* Adjust the height as needed */
    width: auto; /* This will maintain the aspect ratio */
}
</style>
