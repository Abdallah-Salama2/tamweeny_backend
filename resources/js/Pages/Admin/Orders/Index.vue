<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import ProductCard from "@/Components/ProductCard.vue";
import {onMounted, onBeforeMount, ref} from "vue";
import {route} from "ziggy-js";

// const ay7aga="asdad";
defineProps({
    orders: Array,

})

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="overflow-hidden">
            <h1 class=" font-bold " style="color: #c6ffe6; font-size: 60px; margin-right: 25px ;  "> جميع الطلبات </h1>
            <div class="relative  shadow-md sm:rounded-lg mt-28">
                <table class="w-11/12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  mr-12"
                       style="">
                    <thead class="text-xs  text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            رقم الطلب
                        </th>
                        <th scope="col" class="px-6 py-3">
                            اسم العميل
                        </th>
                        <th scope="col" class="px-6 py-3">
                            حالة الطلب
                        </th>
                        <th scope="col" class="px-6 py-3">
                            سعر الطلب
                        </th>
                        <th scope="col" class="px-6 py-3">
                            الطيار
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="order in orders"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ order.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ order.customer.name }}
                        </td>
                        <td class="px-6 py-4">
                            <div
                                :class="{
                                'bg-orange-600 p-2 rounded-3xl':order.delivery_status === 'onHold',
                                'bg-blue-600 p-2 rounded-3xl': order.delivery_status === 'Pending',
                                'bg-green-800 p-2 rounded-3xl': order.delivery_status === 'Delivered',

                            }"
                                style="width: fit-content;">
                                {{ order.delivery_status }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{ order.order_price }}
                        </td>
                        <td class="px-6 py-4">
                            {{ order.delivery ? order.delivery.name : 'N/A' }}
                        </td>


                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style>

</style>
