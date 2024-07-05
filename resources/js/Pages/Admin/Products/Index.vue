<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import SearchBar from '@/Components/My Components/SearchBar.vue'
import { computed } from 'vue'
import Filters from '@/Components/My Components/Filters.vue'
import ProductCard from '@/Components/My Components/ProductCard.vue'
import Pagination from '@/Components/My Components/Pagination.vue'

defineProps({
  products: Object,
  categories: Array,
  name: String,
  filters: {
    type: Object,
    default: () => ({}),
  },
})
const form = useForm({ name: name })

const updateName = (newName) => {
  form.name = newName
  form.get(route('admin.product.index'), {
    replace: true,
    preserveState: true,
    preserveScroll: true,
  })
}

const page = usePage()

const permissions = computed(() => page.props.auth.permissions)

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

    <!--    <p class="bg-red-600">-->
    <!--      Add Offer and fix flash msg And Fix products for supplier to be feched from stores_products according to each store-->
    <!--      and for supplier to create product with offer to be sold with cash and deleting offer only not whole product-->
    <!--    </p>-->
    <search-bar :name="name" class="py-4 " @update:name="updateName" />
    <filters
      v-if="permissions.includes('filter-products')"
      :filters="filters" :categories="categories" class="mr-12 py-2"
    />

    <div class="flex flex-row flex-wrap gap-10 justify-center mt-2">
      <Link
        v-if="permissions.includes('add-products')"
        :href="route('admin.product.create')"
      >
        <img class="cardWidth" src="../../../img/gNcoH1712448873.webp" alt="" />
      </Link>

      <product-card
        v-for="product in products.data"
        :key="product.id"
        :product="product"
        :selected-image="'../../public/images/mod3m.png'"
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
