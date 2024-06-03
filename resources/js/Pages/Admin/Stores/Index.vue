<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
  stores: Array,
})


</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="overflow-hidden">
      <h1 class="font-bold mt-2" style="color: #c6ffe6; font-size: 60px; margin-right: 25px;"> جميع المحلات </h1>
      <div class="relative shadow-md sm:rounded-lg mt-20">
        <table class="w-11/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mr-12">
          <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
              <th scope="col" class="px-6 py-3">
                رقم المحل
              </th>
              <th scope="col" class="px-6 py-3">
                اسم المحل
              </th>
              <th scope="col" class="px-6 py-3">
                اسم المالك
              </th>
              <th scope="col" class="px-6 py-3">
                عنوان المحل
              </th>
              <th scope="col" class="px-6 py-3">
                رقم الهاتف
              </th>
              <th scope="col" class="px-6 py-3">
                نوع المحل
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="store in stores" :key="store.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ store.id ? store.id : 'N/A' }}
              </th>
              <td class="px-6 py-4">
                {{ store.store_name ? store.store_name : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ store.user ? store.user.name : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ store.address ? store.address : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ store.phone_number ? store.phone_number : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ store.valid ? store.valid : 'N/A' }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style>
/* You can add additional styles if needed */
</style>
