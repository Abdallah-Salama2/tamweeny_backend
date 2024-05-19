<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import ProductCard from "@/Components/ProductCard.vue";
import {onMounted, onBeforeMount, ref, reactive} from "vue";
import {route} from "ziggy-js";
import Swal from "sweetalert2";

const id = ref('');
// const ay7aga="asdad";
const props = defineProps({
    orders: Array,
    deliveries: Array,

})
const data = useForm({
    order_id: '',
    'delivery_name': 'اختر',
});
const assignedDeliveries = ref({});

const assignDelivery = (orderId) => {
    data.order_id = orderId;
    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "هل تريد حقًا تعيين هذا الطيار لهذا الطلب؟",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم، تأكيد',
        cancelButtonText: 'إلغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            data.post(route('supplier.order.update', data.order_id), {
                onSuccess: () => {
                    Swal.fire(
                        'تم التعيين!',
                        'تم تعيين الطيار بنجاح.',
                        'success'
                    );
                    const order = props.orders.find(o => o.id === orderId);
                    if (order) {
                        order.delivery_status = "Pending"; // Update local state
                        order.delivery_name = data.delivery_name; // Store the assigned delivery name

                    }
                },
                onError: () => {
                    Swal.fire(
                        'خطأ!',
                        'حدث خطأ أثناء تعيين الطيار.',
                        'error'
                    );
                }
            });
        }
    });
};

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="">
            <form @submit.prevent="assignDelivery(data.order_id)">

                <h1 class=" font-bold " style="color: #c6ffe6; font-size: 60px; margin-right: 25px ;  "> جميع
                    الطلبات </h1>
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
                                <p class="text-center"> اسم الطيار</p>

                            </th>
                            <th scope="col" class="px-6 py-3">
                                <p class="text-center">اضافة</p>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="order in orders" :key="order.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-white">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ order.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ order.customer.name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ order.delivery_status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ order.order_price }}
                            </td>

                            <td v-if="order.delivery_status === 'onHold'"
                                class="px-6 ">
                                <select id="delivery" v-model="data.delivery_name"
                                        class="mt-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>اختر</option>
                                    <option v-for="delivery in deliveries" :key="delivery.id" :value="delivery.name">
                                        {{ delivery.name }}
                                    </option>

                                </select><br>

                            </td>
                            <td v-else class="px-6 py-4 text-center">
                                {{ order.delivery ? order.delivery.name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4  text-center">
                                <button @click="assignDelivery(order.id)" class="mb-1" type="button"
                                        :class="{
                                    'bg-gray-500': order.delivery_status === 'Pending',
                                    'bg-green-700': order.delivery_status === 'onHold'}"
                                        :disabled="order.delivery_status === 'Pending'"
                                        style="color:#C6FFE6;width:50%;justify-content: center;padding: 10px;border-radius: 20px">
                                    تأكيد
                                </button>
                                <br>
                            </td>


                        </tr>

                        </tbody>
                    </table>
                </div>
                <br><br>
            </form>
        </div>

    </AuthenticatedLayout>
</template>

<style>

</style>