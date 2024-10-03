<template>
    <header class="bg-white shadow-sm flex items-center justify-between p-4">
      <!-- Left side - any logo, menu button -->
      <div class="flex items-center">
        <img src="../../../public/images/logo Nova Horizon University (NHU).webp"
        alt="Nova Horizon University (NHU)"
        class="h-10" />
      </div>

      <!-- Right side - user profile -->
      <div class="relative">
        <button @click="toggleDropdown" class="flex items-center space-x-2">
          <img
            :src="profileImage"
            alt="Profile Image"
            class="w-10 h-10 rounded-full object-cover"
          />
          <span>{{ userName }}</span>
        </button>

        <!-- Dropdown Content -->
        <div
          v-if="isDropdownOpen"
          class="absolute right-0 mt-2 w-64 bg-purple-700 text-white rounded-lg shadow-lg p-4"
        >
          <div class="flex items-center space-x-3">
            <img
              :src="profileImage"
              alt="Profile Image"
              class="w-12 h-12 rounded-full"
            />
            <div>
              <p class="font-semibold">{{ userName }}</p>
              <p class="text-sm">{{ userEmail }}</p>
            </div>
          </div>

          <button class="mt-4 w-full bg-pink-600 text-white py-2 rounded-lg">
            Manage My Account
          </button>

          <div class="mt-4">
            <p class="text-sm font-medium">Bachelor's Degree in {{ degree }}</p>
            <p class="text-xs">{{ studentID }}</p>
            <p class="text-sm text-green-400">Active</p>
          </div>

          <button class="mt-4 w-full text-yellow-400 py-2 rounded-lg flex items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17 16l4-4m0 0l-4-4m4 4H7"
              />
            </svg>
            <span class="ml-2">Sign Out</span>
          </button>
        </div>
      </div>
    </header>
  </template>

  <script setup>
  import { ref } from "vue";

  // Mock user data (replace with actual data from the database)
  const userName = ref("Zahra Ahmad");
  const userEmail = ref("Aivoen630@hotmail.com");
  const degree = ref("Computer Science");
  const studentID = ref("S289883");
  const profileImage = ref("/path-to-profile-image.jpg"); // Path to user image

  // Dropdown state
  const isDropdownOpen = ref(false);

  // Function to toggle dropdown
  const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
  };
  </script>

  <style scoped>
  /* Add any custom styles here */
  </style>
