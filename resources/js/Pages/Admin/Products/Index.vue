<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import SearchBar from '@/Components/SearchBar.vue'
import { computed } from 'vue'
import Filters from '@/Components/My Components/Filters.vue'
import ProductCard from '@/Components/My Components/ProductCard.vue'
import Pagination from '@/Components/My Components/Pagination.vue'

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

const page = usePage()


console.log(page.props.flash) // Debugging line

const flashSuccess = computed(() => page.props.flash.success)
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div
      v-if="flashSuccess"
      class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2 mr-2"
    >
      {{ flashSuccess }}
    </div>

    <p>Cards Approval, Flash Messages, Stores, Categories</p>
    <search-bar :name="name" class="py-4" @update:name="updateName" />
    <filters :filters="filters" :categories="categories" class="mr-12 py-2" />

    <div class="flex flex-row flex-wrap gap-10 justify-center mt-2">
      <Link v-if="products.links[0].url === null" :href="route('admin.product.create')">
        <img
          class="cardWidth"
          src="https://i.imghippo.com/files/gNcoH1712448873.png" alt=""
        />
      </Link>

      <product-card
        v-for="product in products.data"
        :key="product.id"
        :product="product"
        :selected-image="'https://i.imghippo.com/files/zs3Zz1712448566.png'"
        :show-first-image="false"
      />
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
