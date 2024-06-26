<template>
  <div class="flex flex-col cardWidth shadow-2xl  items-center" style="background: rgba(28, 28, 30,0.7);border-radius: 40px;">
    <div class="w-32 h-32 mt-2">
      <img src="../../img/Ellipse%202.png" alt="logo.png" />
    </div>
    <div>
      <label for="name" class="text-white">الاسم</label><br />
      <input id="name" type="text" name="name" class="mb-3" :value="user.name" /><br />
      <label for="email" class="text-white">البريد الألكترونى</label><br />
      <input id="email" type="email" class="mb-3" name="name" :value="user.email" /><br />

      <div v-if="showMoreFields">
        <label for="nationalId" class="text-white">الرقم القومى</label><br />
        <input id="nationalId" type="number" class="mb-3" name="name" :value="user.national_id" /><br />
        <label for="phoneNumber" class="text-white">رقم المحمول</label><br />
        <input id="number" type="number" class="mb-3" name="name" :value="user.phone_number" /><br />
        <label for="birthDate" class="text-white">تاريخ الميلاد</label><br />
        <input id="birthDate" type="date" class="mb-3" name="name" :value="user.birth_date" /><br />
        <label for="address" class="text-white">عنوان السكن</label><br />
        <input id="address" type="text" class="mb-3" name="name" :value="user.street ? user.street : '' + ' ' + (user.city_state ? user.city_state : '')" /><br />
        <div v-if="card">
          <label for="cardNumber" class="text-white">رقم بطاقة التموين</label><br />
          <input id="cardNumber" type="number" name="card_name" class="mb-5" :value="user.card ? user.card.card_number : ''" /><br />
        </div>
      </div>
    </div>

    <button v-if="showOrders" class="labelColor mb-2 mt-2" @click="showModal = true">
      سجل الطلبات
    </button>
    <Modal class="" :show="showModal" @close="showModal = false">
      <div class="w-full flex flex-col relative shadow-2xl rounded-3xl color" style="height: 400px; width: 400px; margin: auto;">
        <table class="w-12/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
              <th scope="col" class="px-6 py-3">تاريخ الطلب</th>
              <th scope="col" class="px-6 py-3">سعر الطلب</th>
              <th scope="col" class="px-6 py-3">حالة الطلب</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in user.order" :key="order.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ order.order_date ? order.order_date : "N/A" }}
              </th>
              <td class="px-6 py-4">{{ order.order_price ? order.order_price : "N/A" }}</td>
              <td class="px-6 py-4">{{ order.delivery_status ? order.delivery_status : "N/A" }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </Modal>

    <button class="toggle-button labelColor mb-4" @click="toggleFields">
      <span class="text-small text-gray-400 ml-2">{{ showMoreFields ? 'إخفاء' : 'عرض المزيد' }}</span>
      <i :class="showMoreFields ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class=" text-gray-400 text-small " style="" />
    </button>
  </div>
</template>

<script setup>
import { defineProps, ref } from 'vue'
import Modal from '@/Components/Breeze Componenets/Modal.vue'

defineProps({
  user: Object,
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
const showMoreFields = ref(false)

const toggleFields = () => {
  showMoreFields.value = !showMoreFields.value
}
</script>

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
