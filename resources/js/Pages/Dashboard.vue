<template>
    <AppLayout>
        <template #header>
            <h1 class="text-3xl font-bold text-gray-900">
                Welcome, {{ $page.props.user.name }}
            </h1>
        </template>
        <div></div>
    </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
    components: {
        AppLayout,
    },
});
</script>
