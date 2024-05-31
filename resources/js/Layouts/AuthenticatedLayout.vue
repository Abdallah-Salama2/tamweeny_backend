<script setup>
import { computed, ref } from 'vue'
import { route } from 'ziggy-js'
import { Link, usePage } from '@inertiajs/vue3'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'

const page = usePage()
// const flashSuccess = computed(() => page.props.flash.success)
// const user = computed(() => page.props.user)
// const isUserMenuOpen = ref(false)
const user = page.props.auth.user

// const toggleUserMenu = () => {
//   isUserMenuOpen.value = !isUserMenuOpen.value
// }
</script>


<template>
  <div class="w-full layout navBar layout ">
    <!-- Top Nav Bar-->
    <nav class="fixed z-50 w-full layout  " style="z-index: 2">
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
          <div class="flex items-center justify-start rtl:justify-end">
            <button
              data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
              aria-controls="logo-sidebar" type="button"
              class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            >
              <!--              <span class="sr-only">Open sidebar</span>-->
              <svg
                class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  clip-rule="evenodd" fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                />
              </svg>
            </button>
            <a :href="route('admin.product.index')" class="flex ms-2 md:me-24">
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
  </div>
  <div class="w-full  flex ">
    <!-- Side Bar-->
    <aside
      id="logo-sidebar"
      class=" fixed top-0 right-0 z-40 w-1/6 layout sideBar h-screen pt-20 transition-transform -translate-x-full   sm:translate-x-0  "
      aria-label="Sidebar" style="z-index:1"
    >
      <div class="h-full px-3 pb-4 overflow-y-auto  dark:layout mt-2">
        <div class=" text-center py-2 font-bold">
          <img
            class="w-24 h-24 rounded-full" style="margin-right: 103px;"
            src="../img/WhatsApp%20Image%202024-05-15%20at%2019.04.29_ad4d8a32.jpg"
            alt="user photo"
          />
          <div class="px-4 py-3" role="none">
            <p
              class="text-md text-gray-900 dark:text-white" role="none"
              style="font-family: Roboto,serif "
            >
              <!--                            {{ user.name }}-->
              3amk
            </p>
            <p
              class=" font-bold text-md text-gray-900 truncate dark:text-gray-300"
              role="none"
            >
              {{ user.email }}
            </p>
          </div>
        </div>
        <ul class="space-y-2 font-medium">
          <!--All products in storage-->
          <li>
            <ResponsiveNavLink
              :href="route('admin.product.index')"
              :active="route().current('admin.product.index')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 18 20"
              >
                <path
                  d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"
                />
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">منتجات المخزن</span>
            </ResponsiveNavLink>
          </li>

          <!--Offers-->
          <li>
            <!--            <div v-if="can('can-list-offers')">-->
            <ResponsiveNavLink
              :href="route('admin.offer.index')"
              :active="route().current('admin.offer.index')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  fill-rule="evenodd"
                  d="M20.29 8.567c.133.323.334.613.59.85v.002a3.536 3.536 0 0 1 0 5.166 2.442 2.442 0 0 0-.776 1.868 3.534 3.534 0 0 1-3.651 3.653 2.483 2.483 0 0 0-1.87.776 3.537 3.537 0 0 1-5.164 0 2.44 2.44 0 0 0-1.87-.776 3.533 3.533 0 0 1-3.653-3.654 2.44 2.44 0 0 0-.775-1.868 3.537 3.537 0 0 1 0-5.166 2.44 2.44 0 0 0 .775-1.87 3.55 3.55 0 0 1 1.033-2.62 3.594 3.594 0 0 1 2.62-1.032 2.401 2.401 0 0 0 1.87-.775 3.535 3.535 0 0 1 5.165 0 2.444 2.444 0 0 0 1.869.775 3.532 3.532 0 0 1 3.652 3.652c-.012.35.051.697.184 1.02ZM9.927 7.371a1 1 0 1 0 0 2h.01a1 1 0 0 0 0-2h-.01Zm5.889 2.226a1 1 0 0 0-1.414-1.415L8.184 14.4a1 1 0 0 0 1.414 1.414l6.218-6.217Zm-2.79 5.028a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01Z"
                  clip-rule="evenodd"
                />
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">العروض </span>
            </ResponsiveNavLink>
            <!--            </div>-->
          </li>


          <!--Categories-->
          <li>
            <a
              href="#"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 18 18"
              >
                <path
                  d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"
                />
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">الفئات</span>
              <span
                class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300"
              >Pro</span>
            </a>
          </li>


          <!--Notification-->
          <li>
            <ResponsiveNavLink
              :href="route('admin.card.index')"
              :active="route().current('admin.Notifications.index')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z"
                />
              </svg>


              <span class="flex-1 ms-3 whitespace-nowrap">التنبيهات</span>
              <span
                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium  bg-gray-700 rounded-full "
                style="background:rgba(97,188,132,70%) "
              >3</span>
            </ResponsiveNavLink>
          </li>


          <!--All Customers-->
          <li>
            <ResponsiveNavLink
              :href="route('admin.customer.index')"
              :active="route().current('admin.customer.index')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 9h3m-3 3h3m-3 3h3m-6 1c-.306-.613-.933-1-1.618-1H7.618c-.685 0-1.312.387-1.618 1M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm7 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"
                />
              </svg>

              <span class="flex-1 ms-3 whitespace-nowrap">العملاء</span>
            </ResponsiveNavLink>
          </li>


          <!--All Deliveries-->
          <li>
            <ResponsiveNavLink
              :href="route('admin.delivery.index')"
              :active="route().current('admin.delivery.index')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  fill-rule="evenodd"
                  d="M20.337 3.664c.213.212.354.486.404.782.294 1.711.657 5.195-.906 6.76-1.77 1.768-8.485 5.517-10.611 6.683a.987.987 0 0 1-1.176-.173l-.882-.88-.877-.884a.988.988 0 0 1-.173-1.177c1.165-2.126 4.913-8.841 6.682-10.611 1.562-1.563 5.046-1.198 6.757-.904.296.05.57.191.782.404ZM5.407 7.576l4-.341-2.69 4.48-2.857-.334a.996.996 0 0 1-.565-1.694l2.112-2.111Zm11.357 7.02-.34 4-2.111 2.113a.996.996 0 0 1-1.69-.565l-.422-2.807 4.563-2.74Zm.84-6.21a1.99 1.99 0 1 1-3.98 0 1.99 1.99 0 0 1 3.98 0Z"
                  clip-rule="evenodd"
                />
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">الموصلين</span>
            </ResponsiveNavLink>
          </li>


          <!--All Suppliers-->
          <li>
            <ResponsiveNavLink
              :href="route('admin.supplier.index')"
              :active="route().current('admin.supplier.index')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 18"
              >
                <path
                  d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"
                />
              </svg>

              <span class="flex-1 ms-3 whitespace-nowrap">الموزعين</span>
            </ResponsiveNavLink>
          </li>


          <!--All Stores In System-->
          <li>
            <ResponsiveNavLink
              :href="route('admin.product.index')"
              :active="route().current('admin.products.')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  fill-rule="evenodd"
                  d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z"
                  clip-rule="evenodd"
                />
              </svg>

              <span class="flex-1 ms-3 whitespace-nowrap">المحلات</span>
            </ResponsiveNavLink>
          </li>


          <!--All Orders Status-->
          <li>
            <ResponsiveNavLink
              :href="route('admin.order.index')"
              :active="route().current('admin.order.index')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  fill-rule="evenodd"
                  d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                  clip-rule="evenodd"
                />
              </svg>

              <span class="flex-1 ms-3 whitespace-nowrap">جميع الطلبات</span>
            </ResponsiveNavLink>
          </li>


          <!-- Supplying Orders For Deliveries-->
          <li>
            <ResponsiveNavLink
              :href="route('supplier.order.index')"
              :active="route().current('supplier.order.index')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  fill-rule="evenodd"
                  d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                  clip-rule="evenodd"
                />
              </svg>

              <span class="flex-1 ms-3 whitespace-nowrap">توزيع الطلبات</span>
            </ResponsiveNavLink>
          </li>


          <!--Add New User-->
          <li>
            <ResponsiveNavLink
              :href="route('admin.user.create')"
              :active="route().current('admin.user.create')"
              class="flex items-center p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  fill-rule="evenodd"
                  d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                  clip-rule="evenodd"
                />
              </svg>

              <span class="flex-1 ms-3 whitespace-nowrap">انشاء حساب للموظفين</span>
            </ResponsiveNavLink>
          </li>

          <!--Log Out-->

          <li>
            <ResponsiveNavLink
              :href="route('logout')" method="POST" as="button"
              class="absolute  bottom-5 right-20 flex  p-2  rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 group "
            >
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"
                />
              </svg>


              <span class="flex-1 ms-3 whitespace-nowrap">تسجيل الخروج</span>
            </ResponsiveNavLink>
          </li>
        </ul>
      </div>
    </aside>

    <!-- Content-->
    <div class="w-5/6 content">
      <slot>Default</slot>
    </div>
  </div>
</template>

<style>
.content {

    margin-top: 73px;
    margin-right: 315px;
    min-height: calc(100vh - 73px);
}

.layout {
    background: rgba(35, 35, 35, 80%);
}

body {
    background: rgba(45, 45, 45, 100%) url('/resources/js/img/base desktop.png') no-repeat center center fixed;
    background-size: cover;
}

body::-webkit-scrollbar {
    display: none;
}

.activeColor {
    color: #61BC84;
}
</style>
