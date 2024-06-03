<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import ProductCard from '@/Components/My Components/ProductCard.vue'
import { onMounted, onBeforeMount, ref } from 'vue'
import UserCard from '@/Components/My Components/UserCard.vue'

// const ay7aga="asdad";
defineProps({
  users: Array,
  // cardNumber:Array

})

</script>

<template>
  <Head title="Users" />

  <AuthenticatedLayout>
    <!--    <p>{{ users }}</p>-->
    <div class=" flex flex-row flex-wrap gap-10   justify-center  mt-2  ">
      <user-card
        v-for="user in users"
        :key="user.id"
        :user="user"
        :show-orders="true"
      />
    </div>
  </AuthenticatedLayout>
</template>
