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
    <div class=" flex flex-row flex-wrap gap-10   justify-center  mt-2  ">
      <!--            <a href=""><img src="https://i.imghippo.com/files/gNcoH1712448873.png" alt=""></a>-->

      <user-card
        v-for="user in users"
        :key="user.id"
        :user="user"
        :card="false"
      />
    </div>
  </AuthenticatedLayout>
</template>
