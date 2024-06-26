<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { route } from 'ziggy-js'
import Modal from '@/Components/Breeze Componenets/Modal.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faCheckCircle, faTimesCircle } from '@fortawesome/free-solid-svg-icons'

const props = defineProps({
  cards: Array,
})

const form = useForm({
  cardId: '',
  card_number: '',
  tamween_points: '',
  status: '',
}, {
  headers: {
    'Content-Type': 'multipart/form-data',
  },
})

const currentCard = ref(null)
const showModal = ref(false)
const checkStatus = ref({}) // To store the check status of each card

const assignCardData = (card, status) => {
  form.cardId = card.id
  form.card_number = card.card_number
  form.tamween_points = card.tamween_points
  form.status = status

  form.post(route('admin.card.update'), {
    onSuccess: () => {
      console.log('Form submitted successfully')
    },
    onError: () => {
      console.log('Error submitting form')
    },
  })
}

const checkFiles = (cardId) => {
  // Simulate a file check
  let success = Math.random() > 0.5 // Randomly simulate success or failure

  // Update the checkStatus object
  checkStatus.value[cardId] = success
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="">
      <h1 class="font-bold" style="color: #c6ffe6; font-size: 60px; margin-right: 25px;"> التنبيهات </h1>
      <div class="relative shadow-md sm:rounded-lg mt-20">
        <table class="w-11/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mr-12">
          <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
              <th scope="col" class="px-6 py-3">رقم الطلب</th>
              <th scope="col" class="px-6 py-3">اسم العميل</th>
              <th scope="col" class="px-6 py-3">حالة البطاقه</th>
              <th scope="col" class="px-6 py-3">بيانات الطلب</th>
              <th scope="col" class="px-6 py-3">اضافة رقم البطاقه</th>
              <th scope="col" class="px-6 py-3">اضافة النقاط التموينيه</th>
              <th scope="col" class="px-6 py-3">قبول ام رفض الطلب</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="card in cards" :key="card.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white "
              >
                {{ card.id }}
              </th>
              <td class="px-6 py-4">
                {{ card.name }}
              </td>
              <td class="px-6 py-4">
                <div
                  :class="{
                    'bg-orange-600 p-2 rounded-3xl': card.card_status_text === 'Declined',
                    'bg-blue-600 p-2 rounded-3xl': card.card_status_text === 'Pending',
                    'bg-green-800 p-2 rounded-3xl': card.card_status_text === 'Accepted'
                  }"
                  style="width: fit-content;"
                >
                  {{ card.card_status_text }}
                </div>
              </td>
              <td class="px-6 py-4  ">
                <button
                  class="underline"
                  @click="currentCard = card; showModal = true"
                >
                  البيانات
                </button>

                <FontAwesomeIcon
                  v-if="checkStatus[card.id] !== undefined"
                  :icon="checkStatus[card.id] ? faCheckCircle : faTimesCircle"
                  class="w-6 h-6 mr-2"
                  :class="checkStatus[card.id] ? 'text-green-500' : 'text-red-500'"
                />
              </td>
              <td class="px-6 py-4">
                <input
                  v-model="card.card_number"
                  type="text"
                  placeholder="الرقم"
                  class="input-filter w-28"
                  :disabled="card.card_status_text !== 'Pending'"
                />
              </td>
              <td class="px-6 py-4">
                {{ card.tamween_points }}
              </td>
              <td class="px-6 py-4">
                <button
                  class="mb-1"
                  type="button"
                  :class="{
                    'bg-gray-500': card.card_status_text !== 'Pending',
                    'bg-green-700': card.card_status_text === 'Pending'
                  }"
                  :disabled="card.card_status_text !== 'Pending'"
                  style="color:#C6FFE6; width: 50%; justify-content: center; padding: 10px; border-radius: 20px"
                  @click="assignCardData(card, 'Add')"
                >
                  تأكيد
                </button>
                <br />
                <button
                  class="mb-1"
                  type="button"
                  :class="{
                    'bg-gray-500': card.card_status_text !== 'Pending',
                    'bg-red-700': card.card_status_text === 'Pending'
                  }"
                  :disabled="card.card_status_text !== 'Pending'"
                  style="color:#C6FFE6; width: 50%; justify-content: center; padding: 10px; border-radius: 20px"
                  @click="assignCardData(card, 'Decline')"
                >
                  الغاء
                </button>
                <br />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>

  <!-- Modal -->
  <Modal class="" :show="showModal" @close="showModal = false">
    <div class="w-full flex flex-col relative shadow-2xl rounded-3xl color" style="height: 800px; width: 400px; margin: auto;">
      <div class="mt-4 p-2 flex-1 flex-col items-center text-center text-xl justify-between">
        <p class="mb-4 pColor">
          الاسم
          <span class="block spanColor">{{ currentCard.name }}</span>
        </p>
        <p class="mb-4 pColor">
          الجنس
          <span class="block spanColor">{{ currentCard.gender }}</span>
        </p>
        <p class="mb-4 pColor">
          الحساب الاكتروني
          <span class="block spanColor">{{ currentCard.email }}</span>
        </p>
        <p class="mb-4 pColor">
          المرتب
          <span class="block spanColor">{{ currentCard.salary }}</span>
        </p>
        <p class="mb-4 pColor">
          رقم الهاتف
          <span class="block spanColor">{{ currentCard.phone_number }}</span>
        </p>
        <p class="mb-4 pColor">
          بطاقة الرقم القومي وشهادة الميلاد
          <a :href="currentCard.national_id_card_and_birth_certificate" target="_blank" class="block underline text-blue-500">
            عرض الملف
          </a>
        </p>
        <p class="mb-4 pColor">
          بطاقات الرقم القومي وشهادات ميلاد التابعين
          <span v-for="(path, index) in JSON.parse(currentCard.followers_national_id_cards_and_birth_certificates)" :key="index">
            <a :href="path" target="_blank" class="block underline text-blue-500">
              عرض الملف {{ index + 1 }}
            </a>
          </span>
        </p>
        <button
          class="mt-4"
          style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px"
          @click="checkFiles(currentCard.id)"
        >
          فحص الملفات
        </button>
        <button
          class="mt-4"
          style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px"
          @click="showModal = false"
        >
          إغلاق
        </button>
      </div>
    </div>
  </Modal>
</template>

<style scoped>
.cardWidth {
    width: 90vw;
    max-width: 340px;
}

.color {
    background-color: #1e1e1e;
}

p, h6, .iconColor, label {
    color: #c6ffe6;
}

.iconn {
    color: #c6ffe6;
}

.spanColor {
    color: #61bc84;
}

.btn-wrapper:not(:hover) {
//pointer-events: none;
}

.cursor-pointer {
//cursor: pointer;
}

.btn-wrapper {
    text-align: center;
}

.f {
    color: white;
    background-color: transparent;
    width: 100%;
    border-radius: 10px;
    margin-bottom: 10px;
//border: none;
}
</style>
