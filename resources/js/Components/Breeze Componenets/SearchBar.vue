<template>
  <form class="max-w-md mx-auto" @submit.prevent="search">
    <label
      for="default-search"
      class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
    >Search</label>
    <div class="relative">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg
          class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"
        >
          <path
            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
          />
        </svg>
      </div>
      <input
        id="default-search"
        v-model="searchQuery"
        type="search"
        style="background-color: #232421;border: none"
        class="block w-full p-4 ps-10 text-sm text-gray-900  rounded-lg   dark:placeholder-gray-400 dark:text-white "
        placeholder="Search Mockups, Logos..." required
      />
      <button
        type="submit"
        class="text-gray-800 absolute end-2.5 bottom-2.5  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2  dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        style="background-color: rgba(97, 160 ,132)"
      >
        بحث
      </button>
    </div>
  </form>
</template>
<script setup>

import { ref } from 'vue'

const props = defineProps({
  name: String,
})

const emit = defineEmits(['update:name'])

const searchQuery = ref(props.name)

const search = () => {
  emit('update:name', searchQuery.value)
}
</script>
