<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import ProductCard from '@/Components/My Components/ProductCard.vue'
import Pagination from '@/Components/My Components/Pagination.vue'
import { route } from 'ziggy-js'

defineProps({
  products: Array,

})



const page = usePage()


console.log(page.props.flash) // Debugging line

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <Link :href="route('admin.categories.index')">
      <svg class="w-10 h-10 mr-5 mt-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 9H8a5 5 0 0 0 0 10h9m4-10-4-4m4 4-4 4" />
      </svg>
    </Link>
    <!--    <p>{{ products }}</p>-->
    <div class="flex flex-row flex-wrap gap-10 justify-center ">
      <product-card
        v-for="product in products"
        :product="product"
        :selected-image="'https://i.imghippo.com/files/zs3Zz1712448566.png'"
        :show-first-image="false"
      />
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
