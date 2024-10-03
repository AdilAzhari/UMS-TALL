<template>
    <div>
        <h1 class="text-3xl font-bold mb-4">Profile</h1>
        <div class="bg-white shadow-sm p-6 rounded-lg">
            <p><strong>Name:</strong> {{ user.name }}</p>
            <p><strong>Email:</strong> {{ user.email }}</p>
            <!-- Add more fields as necessary -->
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    user: Object,
});
</script>
