<template>
    <AppLayout>
        <template #header>
            <h1 class="text-3xl font-bold text-gray-900">Payments</h1>
        </template>

        <!-- Main content goes here -->
        <div>
            <!-- Your payments content -->
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { defineComponent } from "vue";
export default defineComponent({
    components: {
        AppLayout,
    },
});
</script>
