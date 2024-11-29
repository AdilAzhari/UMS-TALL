<template>
    <div
        :class="[
            'relative bg-purple-800 text-white transition-all duration-300 ease-in-out flex flex-col h-screen overflow-y-auto',
            { 'w-64': isSidebarOpen, 'w-20': !isSidebarOpen }
        ]"
    >
        <div class="flex items-center justify-center py-4">
            <h2 v-if="isSidebarOpen" class="ml-3 text-2xl font-bold">
                Nova Horizon University
            </h2>
        </div>

        <button
            class="absolute top-5 right-5 text-white focus:outline-none"
            @click="toggleSidebar"
        >
            <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    d="M6 18L18 6M6 6l12 12"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                />
            </svg>
        </button>

        <nav class="mt-10 space-y-2 flex-1">
            <Link
                v-for="item in menuItems"
                :key="item.name"
                :href="route(item.route)"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-purple-700 transition duration-200"
                @click="handleLinkClick(item.route)"
            >
                <component :is="item.icon" class="w-6 h-6 text-yellow-400"/>
                <span v-if="isSidebarOpen" class="ml-3 text-base font-semibold">
        {{ item.name }}
    </span>
            </Link>

        </nav>
    </div>
</template>
<script>
import {onMounted, ref, watch} from "vue";
import {Link, useForm} from "@inertiajs/vue3";
import {
    AcademicCapIcon,
    ComputerDesktopIcon,
    CreditCardIcon,
    DocumentTextIcon,
    HomeIcon,
    LinkIcon,
    MegaphoneIcon,
    TrophyIcon,
    UserGroupIcon,
} from "@heroicons/vue/24/outline";

export default {
    components: {
        Link,
        LinkIcon,
        HomeIcon,
        CreditCardIcon,
        AcademicCapIcon,
        MegaphoneIcon,
        TrophyIcon,
        DocumentTextIcon,
        UserGroupIcon,
        ComputerDesktopIcon,
    },
    setup() {
        const isSidebarOpen = ref(false);

        // Load sidebar state from localStorage
        onMounted(() => {
            const savedState = localStorage.getItem("isSidebarOpen");
            isSidebarOpen.value = savedState === "true";
        });

        // Watch for state changes
        watch(isSidebarOpen, (newValue) => {
            localStorage.setItem("isSidebarOpen", newValue.toString());
        });

        const toggleSidebar = () => {
            isSidebarOpen.value = !isSidebarOpen.value;
        };

        const menuItems = ref([
            {name: "Home", icon: HomeIcon, route: "dashboard"},
            {name: "Payments", icon: CreditCardIcon, route: "payments"},
            {name: "My Courses", icon: AcademicCapIcon, route: "courses"},
            {name: "Share Your Story!", icon: MegaphoneIcon, route: "stories.index"},
            {name: "Academic Achievements", icon: TrophyIcon, route: "achievements"},
            {name: "Online Campus", icon: ComputerDesktopIcon, route: "online-campus"},
        ]);

        const error = ref(null);
        const form = useForm({});

        const handleLinkClick = (routeName) => {
            error.value = null;
            form.get(route(routeName), {
                preserveState: true,
                preserveScroll: true,
                onError: (errors) => {
                    console.error("Navigation error:", errors);
                    error.value =
                        "An error occurred while navigating. Please try again.";
                },
            });
        };

        return {
            isSidebarOpen,
            toggleSidebar,
            menuItems,
            handleLinkClick,
            error,
        };
    },
};
</script>
