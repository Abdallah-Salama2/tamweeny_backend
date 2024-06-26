<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const page = usePage()
const permissions = computed(() => page.props.auth.permissions)
// const ay7aga="asdad";
defineProps({
  suppliers: Array,
  deliveries: Array,
  // cardNumber:Array

})
const selectedDataType = ref('deliveries')

</script>

<template>
  <Head title="Users" />

  <AuthenticatedLayout>
    <div class="overflow-hidden">
      <h1 class="font-bold mt-2" style="color: #c6ffe6; font-size: 60px; margin-right: 25px;"> بيانات الموظفين </h1>

      <!-- Radio buttons to select data type -->
      <div
        v-if="permissions.includes('list-suppliers')"
        class="mt-4 font-medium" style="color: #9CA3AF;font-size: 20px"
      >
        <label class="mr-8 " style="">
          <input v-model="selectedDataType" type="radio" value="deliveries" class="" />
          الموصلين
        </label>
        <label class="mr-6">
          <input v-model="selectedDataType" type="radio" value="suppliers" />
          الموردين
        </label>
      </div>
      <div
        v-else
        class="mt-8 font-medium" style="color: #9CA3AF;font-size: 26px"
      >
        <label class="mr-12" style="">
          <input v-model="selectedDataType" type="radio" value="deliveries" class="" style="display:none;" />
          الموصلين
        </label>
      </div>



      <div class="relative shadow-md sm:rounded-lg mt-20">
        <table class="w-11/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mr-12">
          <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
              <th scope="col" class="px-6 py-3">
                رقم
              </th>
              <th scope="col" class="px-6 py-3">
                الاسم
              </th>
              <th scope="col" class="px-6 py-3">
                الحساب الالكتروني
              </th>
              <th scope="col" class="px-6 py-3">
                الرقم القومي
              </th>
              <th scope="col" class="px-6 py-3">
                رقم الهاتف
              </th>
              <th scope="col" class="px-6 py-3">
                العنوان
              </th>
              <th scope="col" class="px-6 py-3">
                تاريخ الميلاد
              </th>
              <th
                v-if="selectedDataType ==='suppliers'"
                scope="col" class="px-6 py-3"
              >
                رقم البطاقة الضريبية
              </th>
              <th
                v-if="selectedDataType ==='suppliers'"
                scope="col" class="px-6 py-3"
              >
                رقم التسجيل الضريبي
              </th>
              <th
                v-else
                scope="col" class="px-6 py-3"
              >
                عدد الطلبات
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in selectedDataType === 'suppliers' ? suppliers : deliveries" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ user.id ? user.id : 'N/A' }}
              </th>
              <td class="px-6 py-4">
                {{ user.name ? user.name : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ user.email ? user.email : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ user.national_id ? user.national_id : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ user.phone_number ? user.phone_number : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ user.city_state ? user.city_state : 'N/A' }}
              </td>
              <td class="px-6 py-4">
                {{ user.birth_date ? user.birth_date : 'N/A' }}
              </td>
              <td
                v-if="selectedDataType ==='suppliers'"
                class="px-6 py-4"
              >
                {{ user.store_owner_info ? JSON.parse(user.store_owner_info).tax_card_number : 'N/A' }}
              </td>
              <td
                v-if="selectedDataType==='suppliers'"
                class="px-6 py-4"
              >
                {{ user.store_owner_info ? JSON.parse(user.store_owner_info).tax_registration_number : 'N/A' }}
              </td>
              <td
                v-else
                class="px-6 py-4"
              >
                {{ user.delivery_info ? JSON.parse(user.delivery_info).order_count : 'N/A' }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
