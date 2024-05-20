<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import ProductCard from "@/Components/ProductCard.vue";
import {onMounted, onBeforeMount, ref} from "vue";
import {route} from "ziggy-js";
import Filters from "@/Components/Filters.vue";
import SearchBar from "@/Components/SearchBar.vue";

// const ay7aga="asdad";
defineProps({
    products: Array,
    categories:Array,
})

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <p class="text-white">SEARCH & FILTERS & CATEFGORY</p>
        <div></div>
        <search-bar class="py-4"></search-bar>
        <filters :categories="categories" class="mr-12 py-2"></filters>

        <div class=" flex flex-row flex-wrap gap-10   justify-center  mt-2  ">
            <Link :href="route('admin.product.create')"><img class="cardWidth"
                                                             src="https://i.imghippo.com/files/gNcoH1712448873.png"
                                                             alt=""></Link>


            <!--            <productCard :selectedImage="'https://i.imghippo.com/files/OIG8U1712448601.png'" :show-first-image="false" />-->
            <!--            <div>{{products}}</div>-->
            <product-card
                v-for="product in products"
                :key="product.id"
                :product="product"
                :selectedImage="'https://i.imghippo.com/files/zs3Zz1712448566.png'"
                :showFirstImage="false"
            />

            <!--            <productCard :selectedImage="'https://i.imghippo.com/files/OIG8U1712448601.png'" :show-first-image="false"/>-->

        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
.cardWidth {
    height: 450px;
    width: 90vw;
    max-width: 340px;
}
</style>
