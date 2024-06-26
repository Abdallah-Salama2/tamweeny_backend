<script setup>
import { route } from 'ziggy-js'
</script>

<template>
  <nav class="fixed  w-full layout  " style="z-index: 2">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <a :href="route('admin.product.index')" class="flex ms-2 ">
            <img src="https://i.ibb.co/t8pzc58/Logo-2.png" alt="Logo-2" class=" w-12" />
            <span
              class="self-center text-xl font-semibold mr-2 sm:text-2xl whitespace-nowrap dark:text-white"
            >Tamweeny</span>
          </a>
        </div>
        <!--                    <div class="flex items-center">-->
        <!--                        <div class="flex items-center ms-3">-->
        <!--                            <div class="relative">-->
        <!--                                <button @click="toggleUserMenu" type="button"-->
        <!--                                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"-->
        <!--                                        aria-haspopup="true" :aria-expanded="isUserMenuOpen.toString()">-->
        <!--                                    <span class="sr-only">Open user menu</span>-->
        <!--                                    <img class="w-12 h-12 rounded-full"-->
        <!--                                         src="../img/WhatsApp%20Image%202024-05-15%20at%2019.04.29_ad4d8a32.jpg"-->
        <!--                                         alt="user photo">-->
        <!--                                </button>-->
        <!--                            </div>-->
        <!--                            <div v-if="isUserMenuOpen"-->
        <!--                                 class="absolute top-full left-0 z-50 mt-2 w-64 bg-white -translate-y-2 border border-gray-200 dark:bg-gray-800 dark:border-gray-700"-->
        <!--                                 id="dropdown-user" role="menu">-->
        <!--                                <div class="px-4 py-3" role="none">-->
        <!--                                    <p class="text-sm text-gray-900 dark:text-white" role="none"-->
        <!--                                       style="font-family: Roboto,serif ">-->
        <!--                                        3amk-->
        <!--                                    </p>-->
        <!--                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"-->
        <!--                                       role="none">-->
        <!--                                        3amk@admin.com-->
        <!--                                    </p>-->
        <!--                                </div>-->
        <!--                                <ul class="py-1" role="none">-->
        <!--                                    <li>-->
        <!--                                        <Link :href="route('profile.edit')"-->
        <!--                                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600  dark:hover:rounded-3xl dark:hover:text-white"-->
        <!--                                              role="menuitem">البيانات الشخصيه-->
        <!--                                        </Link>-->
        <!--                                    </li>-->
        <!--                                    <li>-->
        <!--                                        <Link :href="route('logout')" method="POST" as="button"-->
        <!--                                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:rounded-3xl  dark:hover:text-white"-->
        <!--                                              role="menuitem">تسجيل الخروج-->
        <!--                                        </Link>-->
        <!--                                    </li>-->
        <!--                                </ul>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
      </div>
    </div>
  </nav>
</template>

<style scoped>

</style>
