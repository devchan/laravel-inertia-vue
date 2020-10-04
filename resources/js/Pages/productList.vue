<template>
<app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Products
        </h2>
    </template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <div class="container my-12 mx-auto px-4 md:px-12">
                    <div class="flex flex-wrap -mx-1 lg:-mx-4">
                        <!-- Column -->
                        <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3" v-for="row in products.data" v-bind:key="row.id">
                            <!-- Article -->
                            <article class="overflow-hidden rounded-lg shadow-lg">
                                <a href="#">
                                    <img alt="Placeholder" class="block h-auto w-full" :src="row.image" @error="setAltImg" />
                                </a>

                                <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                                    <h1 class="text-lg">
                                        <a class="no-underline hover:underline text-black" href="#">
                                            {{ row.name }}
                                        </a>
                                    </h1>

                                    <h2 class="text-lg">
                                        <a class="no-underline hover:underline text-black" href="#">
                                            Price ${{ row.price }}
                                        </a>
                                    </h2>

                                    <h2 class="text-lg">
                                        <a class="no-underline hover:underline text-black" href="#">
                                            Discount {{ row.discount }} %
                                        </a>
                                    </h2>
                                </header>
                            </article>
                            <!-- END Article -->
                        </div>
                        <!-- END Column -->
                    </div>
                </div>
                <Pagination :links="products.links"></Pagination>
            </div>
        </div>
    </div>
</app-layout>
</template>

<script>
import AppLayout from "./../Layouts/AppLayout";
import Welcome from "./../Jetstream/Welcome";
import Pagination from "./../Shared/Pagination";

export default {
    components: {
        AppLayout,
        Welcome,
        Pagination,
    },
    props: ["products"],
    methods: {
        setAltImg(e) {
            e.target.src = "https://dummyimage.com/200";
        },
    },
};
</script>
