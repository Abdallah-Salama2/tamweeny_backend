<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import ProductCard from '@/Components/My Components/ProductCard.vue'
import { route } from 'ziggy-js'
import Filters from '@/Components/My Components/Filters.vue'
import SearchBar from '@/Components/SearchBar.vue'
import Pagination from '@/Components/My Components/Pagination.vue'

// const ay7aga="asdad";
defineProps({
  products: Array,
  categories: Array,
  name: String,
  filters: {
    type: Object,
    default: () => ({}),
  },
})

const updateName = (newName) => {
  const url = new URL(window.location.href)
  url.searchParams.set('name', newName)
  window.location.href = url.toString()
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <!--    <p class="text-white">SEARCH & FILTERS & CATEFGORY</p>-->
    <p>Cards Apporval , Flash Messages , Stores , Categories</p>

    <div />
    <search-bar :name="name" class="py-4" @update:name="updateName" />
    <filters :filters="filters" :categories="categories" class="mr-12 py-2" />

    <div class=" flex flex-row flex-wrap gap-10   justify-center  mt-2  ">
      <Link :href="route('admin.product.create')">
        <img
          class="cardWidth"
          src="https://i.imghippo.com/files/gNcoH1712448873.png" alt=""
        />
      </Link>


      <!--            <productCard :selectedImage="'https://i.imghippo.com/files/OIG8U1712448601.png'" :show-first-image="false" />-->
      <!--            <div>{{products}}</div>-->
      <product-card
        v-for="product in products.data"
        :key="product.id"
        :product="product"
        :selected-image="'https://i.imghippo.com/files/zs3Zz1712448566.png'"
        :show-first-image="false"
      />

      <!--            <productCard :selectedImage="'https://i.imghippo.com/files/OIG8U1712448601.png'" :show-first-image="false"/>-->
    </div>
    <Pagination class="text-center mt-4 text-white" :links="products.links || []" />
  </AuthenticatedLayout>
</template>
<style scoped>
.cardWidth {
    height: 450px;
    width: 90vw;
    max-width: 340px;
}
</style>
