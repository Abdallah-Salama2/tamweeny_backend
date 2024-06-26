<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import Modal from '@/Components/Breeze Componenets/Modal.vue'
import { ref, reactive, computed } from 'vue'
import { route } from 'ziggy-js'
import { createToaster } from '@meforma/vue-toaster'

defineProps({
  stores: Array,
})

const data = useForm({
  product_id: '',
  quantity: '',
  store_id: '',
})
const showModal = ref(false)
const currentStore = ref(null)
const quantities = reactive({})

const addQuantity = (productId, storeId) => {
  const toaster = createToaster({ position: 'top-right', duration: 5000, width: '100%' })

  data.product_id = productId
  data.store_id = storeId
  data.quantity = quantities[productId] || 0

  data.post(route('admin.store.update', productId), {
    onSuccess: () => {
      toaster.success('تم اضافة الكمية')
      const product = currentStore.value.products.find(p => p.pivot.product_id === productId)
      if (product) {
        product.pivot.quantity += data.quantity
      }
    },
    onError: () => {
      toaster.error('حدث خطأ أثناء إضافة الكمية')
    },
  })
}

const getQuantity = (productId) => {
  return computed({
    get: () => quantities[productId] || '',
    set: (value) => quantities[productId] = value,
  })
}

const page = usePage()
const user = computed(() => page.props.auth.user)
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
            <tr
              v-for="store in stores" :key="store.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white"
            >
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ store.id ? store.id : 'N/A' }}
              </th>
              <td class="px-6 py-4 ">
                <button class="underline " @click="currentStore = store; showModal = true">
                  {{ store.store_name ? store.store_name : 'N/A' }}
                </button>
              </td>
              <td class="px-6 py-4">
                {{ store.user ? store.user.name : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ store.address ? store.address : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ user.phone_number ? user.phone_number : 'N/A' }}
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

  <Modal :show="showModal" @close="showModal = false">
    <div
      class="w-full flex flex-col relative shadow-2xl rounded-3xl color"
      style="height: 600px; margin: auto; overflow-y: auto; overflow-x: hidden;"
    >
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
          <tr>
            <th scope="col" class="px-3 py-3">اسم المنتج</th>
            <th scope="col" class="px-3 py-3">الكمية</th>
            <th scope="col" class="px-3 py-3">الكمية المضافه</th>
            <th scope="col" class="px-3 py-3">تعديل</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="product in currentStore.products" :key="product.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white"
          >
            <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ product.description ? product.description : "N/A" }}
            </th>
            <td class="px-3 py-4">{{ product.pivot.quantity ? product.pivot.quantity : "N/A" }}</td>
            <td class="px-3 py-4">
              <input v-model="getQuantity(product.pivot.product_id).value" type="number" class="w-24 h-10" />
            </td>
            <td class="px-3 py-4">
              <button
                class="mb-1 bg-green-700" type="button"
                style="color:#C6FFE6; width: 100%; justify-content: center; padding: 10px; border-radius: 20px;"
                @click="addQuantity(product.pivot.product_id, currentStore.id)"
              >
                تأكيد
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Modal>
</template>

<style scoped>
/* You can add additional styles if needed */

input {
    font-weight: 500;
    color: #fff;
    background-color: rgb(28, 28, 30);
    border-radius: 0.4vw;
    border: 1px solid black;
    outline: none;
    padding: 0.4vw;
    width: 70px;
    transition: 0.4s;
}

input:hover {
    box-shadow: 0 0 0 0.15vw rgba(135, 207, 235, 0.186);
}

input:focus {
    box-shadow: 0 0 0 0.15vw skyblue;
}
</style>
