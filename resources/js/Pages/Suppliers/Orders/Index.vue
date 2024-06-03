<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import ProductCard from '@/Components/My Components/ProductCard.vue'
import { onMounted, onBeforeMount, ref, reactive, computed } from 'vue'
import { route } from 'ziggy-js'
import Swal from 'sweetalert2'

const id = ref('')
// const ay7aga="asdad";
const props = defineProps({
  orders: Array,
  deliveries: Array,

})
const data = useForm({
  order_id: '',
  'delivery_name': 'اختر',
})
const assignedDeliveries = ref({})

const assignDelivery = (orderId) => {
  data.order_id = orderId
  Swal.fire({
    title: 'هل أنت متأكد؟',
    text: 'هل تريد حقًا تعيين هذا الطيار لهذا الطلب؟',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'نعم، تأكيد',
    cancelButtonText: 'إلغاء',
  }).then((result) => {
    if (result.isConfirmed) {
      data.post(route('supplier.order.update', data.order_id), {
        onSuccess: () => {
          Swal.fire(
            'تم التعيين!',
            'تم تعيين الطيار بنجاح.',
            'success',
          )
          const order = props.orders.find(o => o.id === orderId)
          if (order) {
            order.delivery_status = 'Pending' // Update local state
            order.delivery_name = data.delivery_name // Store the assigned delivery name

          }
        },
        onError: () => {
          Swal.fire(
            'خطأ!',
            'حدث خطأ أثناء تعيين الطيار.',
            'error',
          )
        },
      })
    }
  })

}
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
    <div class="">
      <form @submit.prevent="assignDelivery(data.order_id)">
        <h1 class=" font-bold mt-2 " style="color: #c6ffe6; font-size: 60px; margin-right: 25px ;  ">
          جميع
          الطلبات
        </h1>
        <div class="relative  shadow-md sm:rounded-lg mt-20">
          <table
            class="w-11/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  mr-12"
            style=""
          >
            <thead class="text-xs  text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
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
                  <p class="text-center"> اسم الطيار</p>
                </th>
                <th scope="col" class="px-6 py-3">
                  <p class="text-center">اضافة</p>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="order in sortedOrders" :key="order.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white"
              >
                <th
                  scope="row"
                  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                >
                  {{ order.id }}
                </th>
                <td class="px-6 py-4">
                  {{ order.customer.name }}
                </td>
                <td class="px-6 py-4">
                  <div
                    :class="{
                      'bg-orange-600 p-2 rounded-3xl':order.delivery_status === 'onHold',
                      'bg-blue-600 p-2 rounded-3xl': order.delivery_status === 'Pending',
                      'bg-green-800 p-2 rounded-3xl': order.delivery_status === 'Delivered',

                    }"
                    style="width: fit-content;"
                  >
                    {{ order.delivery_status }}
                  </div>
                </td>
                <td class="px-6 py-4">
                  {{ order.order_price }}
                </td>

                <td
                  v-if="order.delivery_status === 'onHold'"
                  class="px-6 "
                >
                  <select
                    id="delivery" v-model="data.delivery_name"
                    class="mt-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  >
                    <option selected>اختر</option>
                    <option v-for="delivery in deliveries" :key="delivery.id" :value="delivery.name">
                      {{ delivery.name }}
                    </option>
                  </select><br />
                </td>
                <td v-else class="px-6 py-4 text-center">
                  {{ order.delivery ? order.delivery.name : 'N/A' }}
                </td>
                <td class="px-6 py-4  text-center">
                  <button
                    class="mb-1" type="button" :class="{
                      'bg-gray-500': order.delivery_status !== 'onHold',
                      'bg-green-700': order.delivery_status === 'onHold'}"
                    :disabled="order.delivery_status !== 'onHold'"
                    style="color:#C6FFE6;width:50%;justify-content: center;padding: 10px;border-radius: 20px"
                    @click="assignDelivery(order.id)"
                  >
                    تأكيد
                  </button>
                  <br />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <br /><br />
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<style>

</style>
