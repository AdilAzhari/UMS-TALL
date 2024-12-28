<template>
    <!--    <div class="flex h-screen">-->
    <!-- Navbar -->
    <CampusNavbar/>

    <!-- Main Content -->
    <div class="flex-1 bg-gray-100 overflow-y-auto">
        <slot></slot>
    </div>
    <!--    </div>-->
</template>

<script>
import CampusNavbar from "@/Components/CampusNavbar.vue"

export default {
    name: "CampusLayout",
    components: {
        CampusNavbar,
    },
};
</script>

<style scoped>
.flex {
    display: flex;
}

.h-screen {
    height: 100vh;
}

.overflow-y-auto {
    overflow-y: auto;
}
</style>
