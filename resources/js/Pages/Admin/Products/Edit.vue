<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { route } from 'ziggy-js'
import { createToaster } from '@meforma/vue-toaster'


const isHovered = ref(false)
const csrfToken = ref(document.head.querySelector('meta[name="csrf-token"]').content)
const token = document.head.querySelector('meta[name="csrf-token"]').content

const isPreviewed = ref(false)
const placeholderImageSrc = ref('')

const props = defineProps({
  product: Object,
  categories: Array,
})

const data = useForm({
  product_name: props.product.product_name,
  product_image: props.product.product_image,
  description: props.product.description,
  stock_quantity: props.product.stock_quantity,
  category: props.product.category.category_name,
  selling_price: props.product.productpricing.selling_price,
},{
  headers: {
    'Content-Type': 'multipart/form-data',
  },
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
}

const previewImage = (event) => {
  const file = event.target.files[0]
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      placeholderImageSrc.value = e.target.result
      isPreviewed.value = true
    }
    reader.readAsDataURL(file)
  } else {
    placeholderImageSrc.value = ''
    isPreviewed.value = false
  }
}

const update = () => {
  const toaster = createToaster({ position: 'top-right', duration: 5000, width: '100%' })

  toaster.success('تم تعديل المنتج')
  data.post(route('admin.product.update', props.product))
}
</script>

<template>
  <Head title="Edit Product" />

  <AuthenticatedLayout>
    <div class="overflow-y-visible mt-3 relative">
      <Link :href="route('admin.product.index')">
        <svg
          class="w-10 h-10 absolute right-8 top-5 text-gray-800 dark:text-white" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
        >
          <path
            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 9H8a5 5 0 0 0 0 10h9m4-10-4-4m4 4-4 4"
          />
        </svg>
      </Link>

      <form enctype="multipart/form-data" @submit.prevent="update">
        <input type="hidden" name="_token" :value="csrfToken" />
        <div
          class="relative" style="margin-right: 730px" @mouseenter="isHovered = true"
          @mouseleave="isHovered = false"
        >
          <img
            v-if="!isPreviewed" id="previewImage" :src="product.product_image" alt="product.png"
            style="width: 180px; height: 180px"
          />
          <img v-else :src="placeholderImageSrc" alt="" style="width: 180px; height: 180px" />
        </div>
        <input
          id="fileInput"
          class="border rounded-md file:px-2 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
          type="file" style="margin-right: 630px;margin-top: 20px" @change="previewImage" @input="addFile"
        />

        <div class="gg">
          <div style="float: right" class="mr-96 mt-2">
            <h1 class="text-3xl font-bold">بيانات المنتج</h1>
            <label for="product_name" class="text-white">اسم المنتج</label><br />
            <input id="product_name" v-model="data.product_name" type="text" class="" /><br />
            <span v-if="data.errors.product_name" class="text-red-500">{{ data.errors.product_name }}</span>
            <label for="description" class="text-white">الوصف</label><br />
            <input id="description" v-model="data.description" type="text" /><br />
            <span v-if="data.errors.description" class="text-red-500">{{ data.errors.description }}</span>
            <label for="price" class="text-white">السعر</label><br />
            <input id="price" v-model="data.selling_price" type="number" /><br />
            <label for="stock_quantity" class="text-white">الكمية</label><br />
            <input id="amount" v-model="data.stock_quantity" type="number" /><br />
            <span v-if="data.errors.stock_quantity" class="text-red-500">{{ data.errors.stock_quantity }}</span>
            <label for="category" class="text-white">الفئة</label><br />
            <select
              id="category" v-model="data.category"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
              <option selected>{{ data.category }}</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.category_name }}
              </option>
            </select><br />
          </div>
          <div class="" style="position: absolute; left: 500px; top:420px">
            <button
              class="mb-20" type="submit"
              style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px"
            >
              تحديث
            </button>
            <br />
            <button
              class="mb-20" type="reset" style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px"
              @click="reset"
            >
              تفريغ
            </button>
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

/* Toaster styles */
.toast {
    width: 100%;
    top: 0;
    left: 0;
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.toast .toast-container {
    width: 100%;
    max-width: 100%;
    border-radius: 0;
    margin: 0;
    padding: 10px;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
}
</style>
