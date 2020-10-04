<template>
<ul class="flex list-reset border border-grey-light rounded w-auto font-sans" v-if="showPagination">
    <li v-for="(link, key) in links" :key="key" v-bind:class="isActive(link)">
        <inertia-link class="block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2" :href="link.url" v-if="link.url">{{
        link.label
      }}</inertia-link>
        <a class="block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2" v-else @click.prevent="handleNoLink">
            {{ link.label }}</a>
    </li>
</ul>

<!-- component -->
</template>

<script>
export default {
    props: {
        links: Array,
    },
    computed: {
        showPagination() {
            return this.links.length > 3;
        },
    },
    methods: {
        isActive(link) {
            return link.active === true ? "active" : "normal";
        },
        handleNoLink() {
            return false;
        },
    },
};
</script>
