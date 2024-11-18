<template>
    <div
        :class="[
            'bg-purple-800 text-white transition-all duration-300 ease-in-out flex flex-col h-screen overflow-y-auto',
            { 'w-64': isSidebarOpen, 'w-20': !isSidebarOpen },
        ]"
        class="relative"
    >
        <div class="flex items-center justify-center py-4">
            <h2 v-if="isSidebarOpen" class="ml-3 text-2xl font-bold">
                Nova Horizon University
            </h2>
        </div>

        <button
            @click="toggleSidebar"
            class="absolute top-5 right-5 text-white focus:outline-none"
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

        <nav class="mt-10 space-y-2 flex-1">
            <Link
                v-for="item in menuItems"
                :key="item.name"
                :href="route(item.route)"
                @click="handleLinkClick(item.route)"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-purple-700 transition duration-200"
            >
                <component :is="item.icon" class="w-6 h-6 text-yellow-400" />
                <span v-if="isSidebarOpen" class="ml-3 text-base font-semibold">
                    {{ item.name }}
                </span>
            </Link>
            <div v-if="isSidebarOpen" class="flex flex-col">
                <div
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-purple-700 transition duration-200 cursor-pointer"
                    @click="showUsefulLinks = !showUsefulLinks"
                >
                    <LinkIcon class="w-6 h-6 text-yellow-400" />
                    <span class="ml-3 text-base font-semibold"
                        >Useful Links</span
                    >
                    <svg
                        :class="[
                            'w-5 h-5 ml-auto transition-transform',
                            { 'rotate-180': showUsefulLinks },
                        ]"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <div v-if="showUsefulLinks" class="space-y-2 pl-12">
                    <a
                        v-for="link in $page.props.usefulLinks"
                        :key="link.name"
                        :href="link.url"
                        class="flex items-center py-2 hover:bg-purple-700 transition duration-200"
                        target="_blank"
                    >
                        <component :is="link.icon" class="w-5 h-5 text-yellow-400" />
                        <span class="ml-3 text-base font-semibold">{{
                            link.name
                        }}</span>
                    </a>
                </div>
            </div>
        </nav>

        <div v-if="isSidebarOpen" class="mt-auto p-4">
            <h3 class="text-xl font-semibold">Register Now</h3>
            <p class="text-sm text-gray-200">
                Registration is open NOW through October 23rd, 2024.
            </p>
            <button
                class="bg-yellow-500 text-purple-800 mt-2 px-4 py-2 rounded-lg hover:bg-yellow-400"
            >
                Register
            </button>
            <div v-if="error" class="bg-red-500 text-white p-4 mt-4">
                {{ error }}
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import { useForm, Link } from "@inertiajs/vue3";
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
    props: {
        isSidebarOpen: {
            type: Boolean,
            required: true,
        },
    },
    emits: ["toggleSidebar"],
    setup(props, { emit }) {
        const toggleSidebar = () => {
            emit("toggleSidebar");
        };

        const menuItems = ref([
            { name: "Home", icon: HomeIcon, route: "dashboard" },
            { name: "Payments", icon: CreditCardIcon, route: "payments" },
            { name: "My Courses", icon: AcademicCapIcon, route: "courses" },
            { name: "Share Your Story!", icon: MegaphoneIcon, route: "share" },
            {
                name: "Academic Achievements",
                icon: TrophyIcon,
                route: "achievements",
            },
            {
                name: "Online Campus",
                icon: ComputerDesktopIcon,
                route: "online-campus",
            },
        ]);

        const showUsefulLinks = ref(false);

        const error = ref(null);
        const form = useForm({});

        const handleLinkClick = (route) => {
            error.value = null;
            form.get(route, {
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
            toggleSidebar,
            menuItems,
            showUsefulLinks,
            handleLinkClick,
            error,
        };
    },
};
</script>
