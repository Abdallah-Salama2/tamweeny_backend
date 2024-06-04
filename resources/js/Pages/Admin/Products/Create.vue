<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { Inertia } from '@inertiajs/inertia'
import NProgress from 'nprogress'
import { ref } from 'vue'
import axios from 'axios'
import { createToaster } from '@meforma/vue-toaster'

const csrfToken = ref(document.head.querySelector('meta[name="csrf-token"]').content)
const isHovered = ref(false)
const isPreviewed = ref(false)
const placeholderImageSrc = ref('')

defineProps({
  categories: Array,
})

const data = useForm({
  product_name: '',
  product_image: null,
  description: '',
  stock_quantity: '',
  category: 'اختر',
  selling_price: '',
})

const reset = () => {
  data.product_image = null
  data.product_name = ''
  data.description = ''
  data.selling_price = ''
  data.stock_quantity = ''
  data.category = ''
  isPreviewed.value = false
}

const addFile = (event) => {
  data.product_image = event.target.files[0]
  console.log(data.product_image)
}

const previewImage = (event) => {
  const file = event.target.files[0]
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      // Update the placeholderImageSrc directly
      placeholderImageSrc.value = e.target.result
      // Set isPreviewed to true to show the new image
      isPreviewed.value = true
    }
    reader.readAsDataURL(file)
  } else {
    // Clear the placeholderImageSrc and set isPreviewed to false
    placeholderImageSrc.value = ''
    isPreviewed.value = false
  }
}

const create = () => {
  const toaster = createToaster({ position: 'top-right', duration: 5000, width: '100%' })

  toaster.success('تم اضافة المنتج')
  data.post(route('admin.product.store'))
}
</script>

<template>
  <Head title="Create New Product" />
  <AuthenticatedLayout>
    <div class=" overflow-y-visible mt-3   relative">
      <Link :href="route('admin.product.index')">
        <svg class="w-10 h-10 absolute right-8 top-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 9H8a5 5 0 0 0 0 10h9m4-10-4-4m4 4-4 4" />
        </svg>
      </Link>

      <form enctype="multipart/form-data" @submit.prevent="create">
        <input type="hidden" name="_token" :value="csrfToken" />
        <div class="relative" style="margin-right: 730px" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
          <img v-if="!isPreviewed" id="previewImage" src="../../../img/pllacee.png" alt="prdouct.png" style="width: 180px; height: 180px" />
          <img v-else :src="placeholderImageSrc" alt="" style="width: 180px; height: 180px" />
        </div>
        <input
          id="fileInput"
          class="border rounded-md file:px-2 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
          type="file" style="margin-right: 630px;margin-top: 20px" required @change="previewImage" @input="addFile"
        />

        <div class="gg">
          <div style="float: right" class="mr-96 mt-2">
            <h1 class="text-3xl font-bold">بيانات المنتج</h1>
            <label for="product_name" class="text-white">اسم المنتج</label><br />
            <input id="product_name" v-model="data.product_name" type="text" class="" required /><br />
            <span v-if="data.errors.product_name" class="text-red-500">{{ data.errors.product_name }}</span>
            <label for="description" class="text-white">الوصف</label><br />
            <input id="description" v-model="data.description" type="text" required /><br />
            <span v-if="data.errors.description" class="text-red-500">{{ data.errors.description }}</span>
            <label for="price" class="text-white">السعر</label><br />
            <input id="price" v-model="data.selling_price" type="number" required /><br />
            <label for="stock_quantity" class="text-white">الكمية</label><br />
            <input id="amount" v-model="data.stock_quantity" type="number" required /><br />
            <span v-if="data.errors.stock_quantity" class="text-red-500">{{ data.errors.stock_quantity }}</span>
            <label for="category" class="text-white">الفئة</label><br />
            <select id="category" v-model="data.category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
              <option selected>اختر</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
            </select><br />
          </div>
          <div class="" style="position: absolute; left: 500px; top:420px">
            <button class="mb-20" type="submit" style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px">تأكيد</button><br />
            <button class="mb-20" type="reset" style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px" @click="reset">تفريغ</button>
          </div>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
p, h1, label {
    color: #c6ffe6;
}
.spanColor {
    color: #61bc84;
}
.gg input {
    color: white;
    background-color: transparent;
    width: 300px;
    border-radius: 10px;
    margin-bottom: 10px;
}
.cursor-pointer {
    cursor: pointer;
}
.btn-wrapper {
    text-align: center;
}
</style>
