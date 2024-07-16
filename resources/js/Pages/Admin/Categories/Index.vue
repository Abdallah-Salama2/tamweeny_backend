<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

import CategoryCard from '@/Components/My Components/CategoryCard.vue'
import { computed } from 'vue'

defineProps({
  categories: Array,
})

const page = usePage()
const permissions = computed(() => page.props.auth.permissions)
console.log(page.props.flash) // Debugging line
// const flashSuccess = computed(() => page.props.flash.success)
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <!--    <p>Cards Approval, Flash Messages, Stores, Categories</p>-->
    <!--    <p>{{ categories }}</p>-->
    <div class="flex flex-row flex-wrap gap-10 justify-center mt-5">
      <Link
        v-if="permissions.includes('add-categories')"
        href=""
      >
        <img
          class="cardWidth"
          src="../../../img/gNcoH1712448873.webp" alt=""
        />
      </Link>

      <category-card
        v-for="category in categories"
        :category="category"
      />
      <!--    <Pagination class="text-center mt-4 text-white" :links="products.links || []" />-->
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
