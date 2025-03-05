<!-- CampusHeader.vue -->
<template>
    <header class="bg-gradient-to-r from-white to-blue-50 shadow-md px-6 py-4 flex items-center justify-between sticky top-0 z-50">
        <!-- Logo -->
        <div class="flex items-center space-x-4">
            <img src="/logo.png" alt="Campus Logo" class="h-10 w-auto">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Campus Portal
            </h1>
        </div>

        <!-- Quick Links -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="/contact" class="text-gray-600 hover:text-blue-600 transition-colors duration-200">Contact Info</a>
            <a href="/student-portal" class="text-gray-600 hover:text-blue-600 transition-colors duration-200">Student Portal</a>
        </div>

        <!-- Search Bar -->
        <div class="flex-grow max-w-md mx-6">
            <div class="relative">
                <input
                    type="text"
                    class="w-full border-2 border-gray-200 rounded-full px-6 py-2 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                    placeholder="Search..."
                />
                <button
                    type="button"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors duration-200"
                >
                    <i class="fas fa-search text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Actions Section -->
        <div class="flex items-center space-x-6">
            <!-- Notifications -->
            <div class="relative">
                <button
                    @click="toggleNotifications"
                    class="text-gray-600 hover:text-blue-600 transition-colors duration-200 relative"
                >
                    <i class="fas fa-bell text-xl"></i>
                    <span
                        v-if="notifications.length > 0"
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse"
                    >
            {{ notifications.length }}
          </span>
                </button>

                <!-- Notifications Dropdown -->
                <div
                    v-if="showNotifications"
                    class="absolute right-0 mt-3 w-80 bg-white border border-gray-100 rounded-xl shadow-lg z-10 transform origin-top transition-all duration-200 ease-out"
                >
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Notifications</h3>
                    </div>
                    <div v-if="notifications.length > 0" class="max-h-96 overflow-y-auto">
                        <div
                            v-for="(notification, index) in notifications"
                            :key="index"
                            class="p-4 border-b border-gray-50 hover:bg-blue-50 transition-colors duration-200"
                        >
                            <p class="text-sm text-gray-700">{{ notification.message }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ notification.time }}</p>
                        </div>
                    </div>
                    <div v-else class="p-4 text-center text-gray-500">No new notifications</div>
                </div>
            </div>

            <!-- Calendar -->
            <button class="text-gray-600 hover:text-blue-600 transition-colors duration-200">
                <i class="fas fa-calendar-alt text-xl"></i>
            </button>

            <!-- Chat -->
            <button class="text-gray-600 hover:text-blue-600 transition-colors duration-200">
                <i class="fas fa-comments text-xl"></i>
            </button>

            <!-- Current Date and Time -->
            <div class="hidden lg:block text-gray-600 font-medium">
                {{ currentDateTime }}
            </div>

            <!-- User Profile -->
            <div class="relative">
                <button
                    @click="toggleProfileMenu"
                    class="flex items-center space-x-3 hover:bg-blue-50 rounded-lg px-4 py-2 transition-colors duration-200"
                >
                    <img
                        src="/profile-placeholder.png"
                        alt="User Avatar"
                        class="h-10 w-10 rounded-full border-2 border-gray-200"
                    />
                    <span class="hidden md:block text-gray-700">{{ user.name }}</span>
                </button>

                <!-- Profile Dropdown -->
                <div
                    v-if="showProfileMenu"
                    class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-xl shadow-lg z-10"
                >
                    <div class="p-2">
                        <a
                            href="/profile"
                            class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                        >
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a
                            href="/settings"
                            class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                        >
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                        <hr class="my-2 border-gray-100">
                        <button
                            @click="logout"
                            class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200"
                        >
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>

export default {
    name: 'CampusHeader',
    data() {
        return {
            showNotifications: false,
            showProfileMenu: false,
            notifications: [
                { message: 'New assignment posted in Math 101', time: '2 hours ago' },
                { message: 'Exam schedule updated', time: '1 day ago' },
            ],
            user: {
                name: 'John Doe',
            },
            currentDateTime: new Date().toLocaleString(),
        }
    },
    mounted() {
        setInterval(() => {
            this.currentDateTime = new Date().toLocaleString()
        }, 1000)
    },
    methods: {
        toggleNotifications() {
            this.showNotifications = !this.showNotifications
            this.showProfileMenu = false
        },
        toggleProfileMenu() {
            this.showProfileMenu = !this.showProfileMenu
            this.showNotifications = false
        },
        logout() {
            console.log('User logged out')
        },
    },
}
</script>
