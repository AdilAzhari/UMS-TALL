<template>
    <div class="bg-white border-b border-gray-200 p-4 flex justify-between items-center">
        <!-- Left side: Search Bar -->
        <div class="flex items-center">
            <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 w-96">
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
                    class="bg-transparent w-full text-sm text-gray-700 focus:outline-none"
                />
            </div>
        </div>

        <!-- Center: Time and Date -->
        <div class="flex items-center space-x-8">
            <div class="flex items-center">
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
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <div class="flex flex-col">
                    <span class="text-xs text-gray-500">NHU Time</span>
                    <span class="text-sm font-medium">{{ currentTime }}</span>
                </div>
            </div>

            <div class="flex items-center">
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
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                    />
                </svg>
                <div class="flex flex-col">
                    <span class="text-xs text-gray-500">NHU Date</span>
                    <span class="text-sm font-medium">{{ currentDate }}</span>
                </div>
            </div>
        </div>

        <!-- Right side: Profile -->
        <div class="relative flex items-center">
            <div class="flex items-center">
                <img
                    :src="$page.props.auth.user.image"
                    :alt="$page.props.auth.user.name"
                    class="w-8 h-8 rounded-full border border-gray-300"
                />
                <span class="font-medium text-gray-700 ml-2">{{
                    $page.props.auth.user.name
                }}</span>
                <button @click="toggleDropdown" class="ml-1">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </button>
            </div>

            <!-- Dropdown Menu -->
            <div
                v-if="isDropdownOpen"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 top-full"
            >
                <div class="px-4 py-2 bg-purple-700 text-white rounded-t-md">
                    <p class="font-semibold">{{ $page.props.auth.user.name }}</p>
                    <p class="text-sm">{{ $page.props.auth.user.email }}</p>
                </div>
                <p class="px-4 py-2 text-sm">
                    {{ $page.props.auth.user.degree }}
                    <span class="ml-2 px-2 py-1 bg-green-500 text-white text-xs rounded-full">
                        {{ $page.props.auth.user.status }}
                    </span>
                </p>
                <p class="px-4 py-2 text-sm text-gray-600">
                    {{ $page.props.auth.user.student_id }}
                </p>
                <a
                    @click="manageAccount"
                    :href="`/profile/${$page.props.auth.user.id}`"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    MANAGE MY ACCOUNT
                </a>
                <a
                    @click="signOut"
                    href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                    Sign Out
                </a>
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
                month: "long",
                day: "numeric",
                year: "numeric",
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
            this.isDropdownOpen = false;
        },
    },
};
</script>
