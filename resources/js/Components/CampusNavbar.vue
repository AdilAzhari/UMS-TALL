<template>
    <nav class="bg-white shadow-md py-4 px-6">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <img alt="Campus Logo" class="w-10 h-10"/>
                <h1 class="text-2xl font-extra bold text-indigo-700">Online Campus</h1>
            </div>

            <!-- Navigation Links -->
            <ul class="flex space-x-6 items-center">
                <li>
                    <router-link
                        class="text-gray-600 hover:text-indigo-600 font-medium"
                        to="/dashboard"
                    >
                        Dashboard
                    </router-link>
                </li>
                <li>
                    <router-link
                        class="text-gray-600 hover:text-indigo-600 font-medium"
                        to="/my-courses"
                    >
                        My Courses
                    </router-link>
                </li>
            </ul>

            <!-- Notifications, Calendar, and Chat -->
            <div class="flex items-center space-x-6">
                <!-- Notifications -->
                <button
                    class="relative text-gray-600 hover:text-indigo-600 focus:outline-none"
                >
                    <i class="fas fa-bell"></i>
                    <span
                        class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1"
                    >
            3
          </span>
                </button>

                <!-- Calendar Badge -->
                <router-link
                    class="relative text-gray-600 hover:text-indigo-600 focus:outline-none"
                    to="/calendar"
                >
                    <i class="fas fa-calendar-alt"></i>
                    <span
                        class="absolute top-0 right-0 bg-blue-500 text-white text-xs rounded-full px-1"
                    >
            2
          </span>
                </router-link>

                <!-- Chat Badge -->
                <router-link
                    class="relative text-gray-600 hover:text-indigo-600 focus:outline-none"
                    to="/chat"
                >
                    <i class="fas fa-comments"></i>
                    <span
                        class="absolute top-0 right-0 bg-green-500 text-white text-xs rounded-full px-1"
                    >
            5
          </span>
                </router-link>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button
                        class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600 focus:outline-none"
                        @click="toggleDropdown"
                    >
                        <img
                            alt="Profile Picture"
                            class="w-10 h-10 rounded-full border"
                            src="https://via.placeholder.com/40"
                        />
                        <span class="font-medium">John Doe</span>
                        <i
                            :class="{ 'fa-chevron-down': !dropdownOpen, 'fa-chevron-up': dropdownOpen }"
                            class="fas"
                        ></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        v-if="dropdownOpen"
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-md py-2"
                    >
                        <router-link
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-indigo-100"
                            to="/profile"
                        >
                            Profile
                        </router-link>
                        <router-link
                            class="block px-4 py-2 text-sm text-gray-600 hover:bg-indigo-100"
                            to="/logout"
                        >
                            Logout
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "CampusNavbar",
    data() {
        return {
            dropdownOpen: false,
        };
    },
    methods: {
        toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 1200px;
    margin: 0 auto;
}

.relative {
    position: relative;
}
</style>
