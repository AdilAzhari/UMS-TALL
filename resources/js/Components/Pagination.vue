<template>
    <div class="pagination">
        <button
            v-for="link in links"
            :key="link.label"
            :disabled="!link.url"
            @click.prevent="changePage(link.url)"
            class="pagination-button"
            v-html="link.label"
        ></button>
    </div>
</template>

<script>
export default {
    props: {
        links: {
            type: Array,
            required: true,
        },
    },
    methods: {
        changePage(url) {
            this.$inertia.get(url); // Use Inertia to navigate
        },
    },
};
</script>

<style>
.pagination-button {
    margin: 5px;
    padding: 10px;
    border: 1px solid #ddd;
    cursor: pointer;
}
.pagination-button:disabled {
    cursor: not-allowed;
    opacity: 0.5;
}
</style>
