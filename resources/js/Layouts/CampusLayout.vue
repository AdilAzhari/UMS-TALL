<template>
    <div>
        <CampusHeader />
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
        <main class="content-area">
            <slot />
        </main>
    </div>
</template>

<script>
import CampusHeader from '@/./Components/Campus/Header.vue';
import Breadcrumbs from '@/./Components/Campus/Breadcrumb.vue';

export default {
    name: 'CampusLayout',
    components: {
        CampusHeader,
        Breadcrumbs,
    },
    props: {
        breadcrumbs: {
            type: Array,
            required: true,
            default: () => [
                {label: 'Home', path: '/'},
                {label: 'Dashboard', path: '/dashboard'},
            ],
        },
    },
};
</script>

<style scoped>
.content-area {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
}
</style>
