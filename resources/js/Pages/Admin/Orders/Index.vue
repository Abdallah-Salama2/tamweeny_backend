<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { computed, reactive } from 'vue'

const props = defineProps({
  orders: Array,
})

const sortState = reactive({
  column: null,
  ascending: true,
})

const getNestedValue = (obj, path) => {
  return path.split('.').reduce((acc, part) => acc && acc[part], obj)
}

const sortedOrders = computed(() => {
  if (!sortState.column) return props.orders

  const sorted = [...props.orders].sort((a, b) => {
    const aValue = getNestedValue(a, sortState.column)
    const bValue = getNestedValue(b, sortState.column)
    if (aValue > bValue) {
      return sortState.ascending ? 1 : -1
    } else if (aValue < bValue) {
      return sortState.ascending ? -1 : 1
    }
    return 0
  })
  return sorted
})

const sortBy = (column) => {
  if (sortState.column === column) {
    sortState.ascending = !sortState.ascending
  } else {
    sortState.column = column
    sortState.ascending = true
  }
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="overflow-hidden">
      <h1 class="font-bold mt-2" style="color: #c6ffe6; font-size: 60px; margin-right: 25px;"> جميع الطلبات </h1>
      <div class="relative shadow-md sm:rounded-lg mt-20">
        <table class="w-11/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mr-12">
          <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
              <th scope="col" class="px-6 py-3" @click="sortBy('id')">
                رقم الطلب
                <i :class="sortState.column === 'id' ? (sortState.ascending ? 'fas fa-arrow-up' : 'fas fa-arrow-down') : 'fas fa-sort'" />
              </th>
              <th scope="col" class="px-6 py-3" @click="sortBy('customer.name')">
                اسم العميل
                <i :class="sortState.column === 'customer.name' ? (sortState.ascending ? 'fas fa-arrow-up' : 'fas fa-arrow-down') : 'fas fa-sort'" />
              </th>
              <th scope="col" class="px-6 py-3" @click="sortBy('delivery_status')">
                حالة الطلب
                <i :class="sortState.column === 'delivery_status' ? (sortState.ascending ? 'fas fa-arrow-up' : 'fas fa-arrow-down') : 'fas fa-sort'" />
              </th>
              <th scope="col" class="px-6 py-3" @click="sortBy('order_price')">
                سعر الطلب
                <i :class="sortState.column === 'order_price' ? (sortState.ascending ? 'fas fa-arrow-up' : 'fas fa-arrow-down') : 'fas fa-sort'" />
              </th>
              <th scope="col" class="px-6 py-3">
                الطيار
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in sortedOrders" :key="order.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ order.id }}
              </th>
              <td class="px-6 py-4">
                {{ order.customer.name }}
              </td>
              <td class="px-6 py-4">
                <div
                  :class="{
                    'bg-orange-600 p-2 rounded-3xl': order.delivery_status === 'onHold',
                    'bg-blue-600 p-2 rounded-3xl': order.delivery_status === 'Pending',
                    'bg-green-800 p-2 rounded-3xl': order.delivery_status === 'Delivered'
                  }"
                  style="width: fit-content;"
                >
                  {{ order.delivery_status }}
                </div>
              </td>
              <td class="px-6 py-4">
                {{ order.order_price }}
              </td>
              <td class="px-6 py-4">
                {{ order.delivery ? order.delivery.name : 'N/A' }}
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
