<template>
    <div
        class="bg-white border-b border-gray-200 p-2 flex justify-between items-center"
    >
        <!-- Search Bar -->
        <div class="flex items-center bg-gray-100 rounded-md px-2 py-1">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-gray-400 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                />
            </svg>
            <input
                type="search"
                placeholder="Search for apps or actions"
                class="bg-transparent text-sm text-gray-700 focus:outline-none"
            />
        </div>

        <!-- Time, Date, and Profile -->
        <div class="flex items-center space-x-4">
            <!-- Time and Date components remain unchanged -->

            <!-- User Profile -->
            <div class="relative flex items-center">
                <img
                    :src="$page.props.auth.user.image"
                    :alt="$page.props.auth.user.name"
                    class="w-8 h-8 rounded-full border border-gray-300"
                />
                <span class="font-medium text-gray-700 ml-2">{{
                    $page.props.auth.user.name
                }}</span>

                <!-- Dropdown Trigger -->
                <button @click="toggleDropdown" class="text-gray-600 ml-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                        />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div
                    v-if="isDropdownOpen"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 top-full"
                >
                    <div
                        class="px-4 py-2 bg-purple-700 text-white rounded-t-md"
                    >
                        <p class="font-semibold">
                            {{ $page.props.auth.user.name }}
                        </p>
                        <p class="text-sm">{{ $page.props.auth.user.email }}</p>
                    </div>
                    <p class="px-4 py-2 text-sm">
                        {{ $page.props.auth.user.degree }}
                        <span
                            class="ml-2 px-2 py-1 bg-green-500 text-white text-xs rounded-full"
                            >{{ $page.props.auth.user.status }}</span
                        >
                    </p>
                    <p class="px-4 py-2 text-sm text-gray-600">
                        {{ $page.props.auth.user.student_id }}
                    </p>
                    <a
                        @click="manageAccount"
                        :href="`/profile/${$page.props.auth.user.id}`"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >MANAGE MY ACCOUNT</a
                    >
                    <a
                        @click="signOut"
                        href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >Sign Out</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { usePage } from "@inertiajs/vue3";

export default {
    data() {
        return {
            currentTime: "",
            currentDate: "",
            isDropdownOpen: false,
        };
    },
    mounted() {
        this.updateDateTime();
        setInterval(this.updateDateTime, 1000);
    },
    methods: {
        updateDateTime() {
            const now = new Date();
            this.currentTime = now.toLocaleTimeString("en-US", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: true,
            });
            this.currentDate = now.toLocaleDateString("en-US", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
            });
        },
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
        manageAccount() {
            console.log("Navigate to profile page");
            this.isDropdownOpen = false;
        },
        signOut() {
            console.log("Sign out user");
            // Implement your sign out logic here
            this.isDropdownOpen = false;
        },
    },
};
</script>
