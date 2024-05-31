<template>
  <header>
    <div class="w-1/5 p-10 text-white flex flex-col items-start relative hi color">
      <div class="w-full flex flex-col items-center">
        <img src="https://i.ibb.co/smSWSSn/Frame-75.png" alt="Frame-75" class="w-21 h-21 mb-2 rounded-full" />
        <p class="text-xl text-center">محمد متولي السيد</p>
      </div>
      <nav>
        <ul class="w-full flex flex-col items-start text-3xl font-bold mt-20">
          <li class="mb-10">
            <a class="cursor-pointer" @click="navigateTo('Owner.storage')">المخزن</a>
          </li>
          <li class="mb-10">
            <a class="cursor-pointer" @click="navigateTo('Owner.offers')">العروض</a>
          </li>
          <li class="mb-10">
            <a class="cursor-pointer" @click="navigateTo('Owner.profile')">البيانات الشخصية</a>
          </li>
        </ul>
      </nav>
      <a class="text-4xl font-bold absolute bottom-10 right-11 cursor-pointer" @click="navigateTo('Login')">تسجيل خروج</a>
    </div>
  </header>

  <main>
    <div
      v-if="flashSuccess"
      class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
    >
      {{ flashSuccess }}
    </div>
    <slot>
      Default
    </slot>
  </main>
</template>

<script setup>
import { route } from 'ziggy-js'
import { router } from '@inertiajs/vue3'
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'


const page = usePage()

const navigateTo = (routeName) => {
  router.get(route(routeName))
}
const flashSuccess = computed(() => page.props.flash.success)

</script>

<style scoped>
.color {
    background-color: rgba(35, 35, 35, 0.85);
}

.hi {
    height: 100vh;
    position: fixed;
    top: 0;
    right: 0;
}

.marginLeft {
    margin-right: 370px;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
