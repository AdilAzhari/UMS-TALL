<template>
    <div>
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 p-4 flex justify-between items-center">
            <!-- Left side: Search Bar -->
            <div class="flex items-center">
                <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 w-96">
                    <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    <input class="bg-transparent w-full text-sm text-gray-700 focus:outline-none"
                           placeholder="Search for learning guides..."
                           type="search" />
                </div>
            </div>

            <!-- Right side: Time, Date, Notifications, and Profile -->
            <div class="flex items-center space-x-6">
                <!-- Time -->
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500">Time</span>
                        <span class="text-sm font-medium">{{ currentTime }}</span>
                    </div>
                </div>

                <!-- Date -->
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500">Date</span>
                        <span class="text-sm font-medium">{{ currentDate }}</span>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="relative">
                    <button class="p-1 rounded-full hover:bg-gray-100" @click="toggleNotifications">
                        <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                        <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                    </button>
                    <!-- Notifications Dropdown -->
                    <div v-if="showNotifications" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-1 z-20">
                        <!-- Add your notifications content here -->
                    </div>
                </div>

                <!-- Profile -->
                <div class="relative">
                    <div class="flex items-center">
                        <img :alt="$page.props.auth.user.name" :src="$page.props.auth.user.image" class="w-8 h-8 rounded-full border border-gray-300" />
                        <span class="font-medium text-gray-700 ml-2">{{ $page.props.auth.user.name }}</span>
                        <button class="ml-1" @click="toggleDropdown">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            </svg>
                        </button>
                    </div>

                    <!-- Profile Dropdown -->
                    <div v-if="isDropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
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
                        <p class="px-4 py-2 text-sm text-gray-600">{{ $page.props.auth.user.student_id }}</p>
                        <a :href="`/profile/${$page.props.auth.user.id}`" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" @click="manageAccount">
                            MANAGE MY ACCOUNT
                        </a>
                        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#" @click="signOut">
                            Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="max-w-5xl mx-auto p-6 space-y-8">
            <!-- Your existing weeks content here -->
            <div v-for="week in weeks" :key="week.id" class="bg-white rounded-xl shadow-sm border">
                <!-- ... rest of your existing layout ... -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        weeks: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            currentTime: "",
            currentDate: "",
            isDropdownOpen: false,
            showNotifications: false
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
                hour12: true
            });
            this.currentDate = now.toLocaleDateString("en-US", {
                weekday: "long",
                month: "long",
                day: "numeric",
                year: "numeric"
            });
        },
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
            if (this.isDropdownOpen) this.showNotifications = false;
        },
        toggleNotifications() {
            this.showNotifications = !this.showNotifications;
            if (this.showNotifications) this.isDropdownOpen = false;
        },
        manageAccount() {
            console.log("Navigate to profile page");
            this.isDropdownOpen = false;
        },
        signOut() {
            console.log("Sign out user");
            this.isDropdownOpen = false;
        }
    }
};
</script>
