<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { computed, reactive, ref } from 'vue'
import SearchBar from '@/Components/Breeze Componenets/SearchBar.vue'
import Modal from '@/Components/Breeze Componenets/Modal.vue'
import { route } from 'ziggy-js'


const props = defineProps({
  orders: Array,
  name: String,
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

const showModal = ref(false)
const currentOrder = ref(null)
const showMoreFields = ref(false)

const toggleFields = () => {
  showMoreFields.value = !showMoreFields.value
}

const form = useForm({ name: props.name })

const updateName = (newName) => {
  form.name = newName
  form.get(route('admin.order.index'), {
    replace: true,
    preserveState: true,
    preserveScroll: true,
  })
}
const showOrders = ref(false)
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="overflow-hidden">
      <div>
        <search-bar :name="name" class="py-4" @update:name="updateName" />
      </div>
      <div class="relative shadow-md sm:rounded-lg mt-20">
        <table class="w-11/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mr-12">
          <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
              <th scope="col" class="px-6 py-3 cursor-pointer" @click="sortBy('id')">
                رقم الطلب
                <i :class="sortState.column === 'id' ? (sortState.ascending ? 'fas fa-arrow-up' : 'fas fa-arrow-down') : 'fas fa-sort'" />
              </th>
              <th scope="col" class="px-6 py-3 cursor-pointer" @click="sortBy('customer.name')">
                اسم العميل
                <i :class="sortState.column === 'customer.name' ? (sortState.ascending ? 'fas fa-arrow-up' : 'fas fa-arrow-down') : 'fas fa-sort'" />
              </th>
              <th scope="col" class="px-6 py-3 cursor-pointer" @click="sortBy('delivery_status')">
                حالة الطلب
                <i :class="sortState.column === 'delivery_status' ? (sortState.ascending ? 'fas fa-arrow-up' : 'fas fa-arrow-down') : 'fas fa-sort'" />
              </th>
              <th scope="col" class="px-6 py-3 cursor-pointer" @click="sortBy('order_price')">
                سعر الطلب
                <i :class="sortState.column === 'order_price' ? (sortState.ascending ? 'fas fa-arrow-up' : 'fas fa-arrow-down') : 'fas fa-sort'" />
              </th>
              <th scope="col" class="px-6 py-3">الطيار</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in sortedOrders" :key="order.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ order.id }}
              </th>
              <td class="px-6 py-4">
                <button class="underline" @click="currentOrder = order; showModal = true">
                  {{ order.customer.name }}
                </button>
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

    <!-- Modal -->
    <Modal :show="showModal" @close="showModal = false">
      <div class="flex flex-col cardWidth shadow-2xl items-center" style="background: rgba(28, 28, 30,0.7);border-radius: 40px;">
        <div class="w-32 h-32 mt-2">
          <img src="../../../img/Ellipse%202.png" alt="logo.png" />
        </div>
        <div>
          <label for="name" class="text-white">الاسم</label><br />
          <input id="name" type="text" name="name" class="mb-3" :value="currentOrder.customer.name" /><br />
          <label for="email" class="text-white">البريد الألكترونى</label><br />
          <input id="email" type="email" class="mb-3" name="name" :value="currentOrder.customer.email" /><br />

          <div v-if="showMoreFields">
            <label for="nationalId" class="text-white">الرقم القومى</label><br />
            <input id="nationalId" type="number" class="mb-3" name="name" :value="currentOrder.customer.national_id" /><br />
            <label for="phoneNumber" class="text-white">رقم المحمول</label><br />
            <input id="number" type="number" class="mb-3" name="name" :value="currentOrder.customer.phone_number" /><br />
            <label for="birthDate" class="text-white">تاريخ الميلاد</label><br />
            <input id="birthDate" type="date" class="mb-3" name="name" :value="currentOrder.customer.birth_date" /><br />
            <label for="address" class="text-white">عنوان السكن</label><br />
            <input id="address" type="text" class="mb-3" name="name" :value="(currentOrder.customer.street ? currentOrder.customer.street : '') + ' ' + (currentOrder.customer.city_state ? currentOrder.customer.city_state : '')" /><br />
            <div v-if="currentOrder.customer.card">
              <label for="cardNumber" class="text-white">رقم بطاقة التموين</label><br />
              <input id="cardNumber" type="number" name="card_name" class="mb-5" :value="currentOrder.customer.card.card_number" /><br />
            </div>
          </div>
        </div>



        <button class="toggle-button labelColor mb-4" @click="toggleFields">
          <span class="text-small text-gray-400 ml-2">{{ showMoreFields ? 'إخفاء' : 'عرض المزيد' }}</span>
          <i :class="showMoreFields ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-gray-400 text-small" />
        </button>
      </div>
    </Modal>
  </AuthenticatedLayout>
</template>

<style scoped>
.cardWidth {
    width: 90vw;
    max-width: 360px;
}
.labelColor {
    color: #DEA568;
    font-weight: bold;
    font-size: 26px;
}
.color {
    background-color: #1e1e1e;
}

p, h6, label {
    color: #c6ffe6;
}

.spanColor {
    color: #61bc84;
}

input {
    font-weight: 500;
    color: #fff;
    background-color: rgb(28, 28, 30);
    border-radius: 0.4vw;
    border: 1px solid black;
    outline: none;
    padding: 0.4vw;
    width: 240px;
    transition: 0.4s;
}
input:hover {
    box-shadow: 0 0 0 0.15vw rgba(135, 207, 235, 0.186);
}

input:focus {
    box-shadow: 0 0 0 0.15vw skyblue;
}

.cursor-pointer {
    cursor: pointer;
}

.btn-wrapper {
    text-align: center;
}

.toggle-button {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
    background: none;
    border: none;
    cursor: pointer;
}

.text-small {
    font-size: 16px; /* Adjust the font size here */
}
</style>
