<template>
  <!-- Product Card -->
  <div class="w-full flex flex-col cardWidth relative shadow-2xl rounded-3xl  items-center" style="background: #1E1E1E">
    <div class="logo">
      <img src="../../img/Ellipse%202.png" alt="logo.png" />
    </div>
    <div>
      <label for="name" class="text-white">الاسم</label><br />
      <input id="name" type="text" name="name" class="" :value="user.name" /><br />
      <label for="email" class="text-white">البريد الألكترونى</label><br />
      <input id="email" type="email" name="name" :value="user.email" /><br />
      <label for="nationalId" class="text-white">الرقم القومى</label><br />
      <input id="nationalId" type="number" name="name" :value="user.national_id" /><br />
      <label for="phoneNumber" class="text-white">رقم المحمول</label><br />
      <input id="number" type="number" name="name" :value="user.phone_number" /><br />
      <label for="birthDate" class="text-white">تاريخ الميلاد</label><br />
      <input id="birthDate" type="date" name="name" :value="user.birth_date" /><br />
      <label for="address" class="text-white">عنوان السكن</label><br />
      <input id="address" type="text" name="name" :value="user.street ? user.street :'' +' '+ user.city_state ? user.city_state :''" /><br />
      <div v-if="card">
        <label for="cardNumber" class="text-white">رقم بطاقة التموين</label><br />
        <input id="cardNumber" type="number" name="card_name" class="mb-5" :value="user.card ? user.card.card_number : ''" /><br />
      </div>
      <!--            <span class="block spanColor">{{ user.card.card_number }}</span>-->
    </div>

    <button v-if="showOrders" class="labelColor" @click="showModal = true">
      سجل الطلبات
    </button>
    <Modal class="" :show="showModal" @close="showModal = false">
      <!-- Content of the modal -->
      <!--            <Link @click="showModal = false" class=" absolute left-2 top-2">-->
      <!--                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"-->
      <!--                     width="24" height="24" fill="none" viewBox="0 0 24 24">-->
      <!--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"-->
      <!--                          d="M6 18 17.94 6M18 18 6.06 6"/>-->
      <!--                </svg>-->
      <!--            </Link>-->
      <div
        class="w-full flex flex-col  relative shadow-2xl rounded-3xl color"
        style="height: 400px; width: 400px; margin: auto;"
      >
        <table class="w-12/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
          <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
              <th scope="col" class="px-6 py-3">
                تاريخ الطلب
              </th>
              <th scope="col" class="px-6 py-3">
                سعر الطلب
              </th>
              <th scope="col" class="px-6 py-3">
                حالة الطلب
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in user.order" :key="order.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ order.order_date ? order.order_date : "N/A" }}
              </th>
              <td class="px-6 py-4">
                {{ order.order_price ? order.order_price : "N/A" }}
              </td>
              <td class="px-6 py-4">
                {{ order.delivery_status ? order.delivery_status : "N/A" }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class=" ">
        <!-- Your modal content here -->
      </div>
    </Modal>
  </div>
</template>


<script setup>
import { defineProps, ref } from 'vue'

import Modal from '@/Components/Modal.vue'

// Define a ref to store the products
// const products = ref([]);
// Define a ref to track hover states for each product
defineProps({
  user: Object,
  // cardNumber:Object,
  // cardNumber:user.card.card_name,
  showOrders: {
    type: Boolean,
    default: false,
  },
  card: {
    type: Boolean,
    default: true,
  },
})

const showModal = ref(false)

</script>

<style scoped>
.cardWidth {
    width: 90vw;
    max-width: 460px;
}
.labelColor{
    color:#DEA568;
    font-weight:bold;
    font-size: 29px;
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

/* Only apply pointer-events: none; when not hovering */
.btn-wrapper:not(:hover) {
    pointer-events: none;
}

input {
    color: white;
    background-color: transparent;
    width: 300px;
    border-radius: 10px;
    margin-bottom: 10px;
//border: none;
    /* Add more custom styles here */
}

.cursor-pointer {
    cursor: pointer;
}

.btn-wrapper {
    text-align: center;
}
</style>
