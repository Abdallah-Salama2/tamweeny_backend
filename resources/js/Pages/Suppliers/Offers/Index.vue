<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head ,Link } from '@inertiajs/vue3'
import ProductCard from '@/Components/My Components/ProductCard.vue'
import { onMounted, onBeforeMount, ref } from 'vue'
import { route } from 'ziggy-js'

// const ay7aga="asdad";
defineProps({
  products: Array,

})

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class=" flex flex-row flex-wrap gap-10   justify-center  mt-2  ">
      <Link :href="route('admin.product.create')"><img src="../../../img/gNcoH1712448873.webp" alt="" /></Link>


      <!--            <productCard :selectedImage="'https://i.imghippo.com/files/OIG8U1712448601.png'" :show-first-image="false" />-->

      <product-card
        v-for="product in products"
        :key="product.id"
        :product="product"
        :selected-image="'../../public/images/8erMode3m.png'"
        :show-first-image="false"
      />
      <!--        selected image show 8er mod3m-->

      <!--            <productCard :selectedImage="'https://i.imghippo.com/files/OIG8U1712448601.png'" :show-first-image="false"/>-->
    </div>
  </AuthenticatedLayout>
</template>
