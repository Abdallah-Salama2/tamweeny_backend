<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class=" flex flex-col  items-center  mt-36  ">
    <div>
      <div>
        <h1 class="text-white text-center text-3xl font-medium">مرحباً بك فى تموينى</h1>
        <h2 class="text-white text-center">لتوريد الغذاء</h2>
      </div>
      <Link href="/">
        <ApplicationLogo class="w-60 h-60 mt-4 fill-current text-gray-500" />
      </Link>
    </div>

    <div
      class="w-full sm:max-w-md mt-6 px-6 py-4   overflow-hidden sm:rounded-lg"
    >
      <slot />
    </div>
  </div>
</template>

<style>
body {
    background: rgba(45, 45, 45, 100%) url('/resources/js/img/base desktop.png') no-repeat center center fixed;
    background-size: cover;

}
</style>
