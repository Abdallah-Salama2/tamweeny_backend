<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { ref, reactive, computed } from 'vue'
import { route } from 'ziggy-js'
import Swal from 'sweetalert2'
import SearchBar from '@/Components/My Components/SearchBar.vue'
import Modal from '@/Components/Breeze Componenets/Modal.vue'

const id = ref('')
const props = defineProps({
  orders: Array,
  deliveries: Array,
  name: String,
})

const data = useForm({
  order_id: '',
  delivery_name: 'اختر',
  owner_id: '',
})

const assignedDeliveries = ref({})
const assignDelivery = (orderId, ownerId) => {
  data.order_id = orderId
  data.owner_id = ownerId
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
          Swal.fire('تم التعيين!', 'تم تعيين الطيار بنجاح.', 'success')
          const order = props.orders.find(o => o.id === orderId)
          if (order) {
            order.delivery_status = 'Pending' // Update local state
            order.delivery_name = data.delivery_name // Store the assigned delivery name
          }
        },
        onError: () => {
          Swal.fire('خطأ!', 'حدث خطأ أثناء تعيين الطيار.', 'error')
        },
      })
    }
  })
}

const form = useForm({ name: props.name })
const updateName = (newName) => {
  form.name = newName
  form.get(route('supplier.order.index'), {
    replace: true,
    preserveState: true,
    preserveScroll: true,
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

const page = usePage()
const user = computed(() => page.props.auth.user)

const showModal = ref(false)
const currentOrder = ref(null)
const showMoreFields = ref(false)

const toggleFields = () => {
  showMoreFields.value = !showMoreFields.value
}

const showOrderDetails = (order) => {
  currentOrder.value = order
  showModal.value = true
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="">
      <search-bar :name="name" class="py-4" @update:name="updateName" />

      <form @submit.prevent="">
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
                <th scope="col" class="px-6 py-3">اضافة</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="order in sortedOrders" :key="order.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  {{ order.id }}
                </th>
                <td class="px-6 py-4">
                  <button class="underline" @click="showOrderDetails(order)">
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
                  <select v-if="order.delivery_status === 'onHold'" v-model="data.delivery_name" class="mt-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>اختر</option>
                    <option v-for="delivery in deliveries" :key="delivery.id" :value="delivery.name">
                      {{ delivery.name }}
                    </option>
                  </select>
                  <span v-else>{{ order.delivery ? order.delivery.name : 'N/A' }}</span>
                </td>
                <td class="px-6 py-4 text-center">
                  <button class="mb-1" :class="{'bg-gray-500': order.delivery_status !== 'onHold', 'bg-green-700': order.delivery_status === 'onHold'}" :disabled="order.delivery_status !== 'onHold'" style="color:#C6FFE6;width:50%;justify-content: center;padding: 10px;border-radius: 20px" @click="assignDelivery(order.id, user.id)">
                    تأكيد
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
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
.cardWidth {
    width: 400px;
}
</style>
