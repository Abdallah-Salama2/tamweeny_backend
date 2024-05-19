<template>
    <!-- Product Card -->
    <div class="w-full flex flex-col cardWidth relative shadow-2xl rounded-3xl  items-center" style="background: #1E1E1E">
        <div class="logo">
            <img src="../img/Ellipse%202.png" alt="logo.png">
        </div>
        <div>
            <label for="name" class="text-white">الاسم</label><br>
            <input id="name" type="text" name="name" class="" :value="user.name"><br>
            <label for="email" class="text-white">البريد الألكترونى</label><br>
            <input id="email" type="email" name="name" :value="user.email"><br>
            <label for="nationalId" class="text-white">الرقم القومى</label><br>
            <input id="nationalId" type="number" name="name" :value="user.national_id"><br>
            <label for="phoneNumber" class="text-white">رقم المحمول</label><br>
            <input id="number" type="number" name="name" :value="user.phone_number"><br>
            <label for="birthDate" class="text-white" >تاريخ الميلاد</label><br>
            <input id="birthDate" type="date" name="name" :value="user.birth_date" ><br>
            <label for="address" class="text-white">عنوان السكن</label><br>
            <input id="address" type="text" name="name" :value="user.street +' '+ user.city_state"><br>
            <div v-if="card">
            <label for="cardNumber" class="text-white">رقم بطاقة التموين</label><br>
            <input id="cardNumber" type="number" name="card_name"  class="mb-5"  :value="user.card ? user.card.card_number : ''"><br>
            </div>
<!--            <span class="block spanColor">{{ user.card.card_number }}</span>-->

        </div>

        <Link v-if="showOrders" class="labelColor">سجل الطلبات</Link>

    </div>
</template>


<script setup>
import { Link } from '@inertiajs/vue3';

import {defineProps, ref} from 'vue';
import {route} from "ziggy-js";
import {router} from "@inertiajs/vue3";

// Define a ref to store the products
// const products = ref([]);
// Define a ref to track hover states for each product
const props = defineProps({
    user: Object,
    // cardNumber:Object,
    // cardNumber:user.card.card_name,
    showOrders: {
        type: Boolean,
        default: false
    },
    card: {
        type: Boolean,
        default: true
    },
});


</script>

<style scoped>
.cardWidth {
    width: 90vw;
    max-width: 460px;
}
.labelColor{
    color:#DEA568;
    font-weight:bold;
    font-size: 29px;
}
.color {
    background-color: #1e1e1e;
}

p, h6, label {
    color: #c6ffe6;
}

.spanColor {
    color: #61bc84;
}

/* Only apply pointer-events: none; when not hovering */
.btn-wrapper:not(:hover) {
    pointer-events: none;
}

input {
    color: white;
    background-color: transparent;
    width: 300px;
    border-radius: 10px;
    margin-bottom: 10px;
//border: none;
    /* Add more custom styles here */
}

.cursor-pointer {
    cursor: pointer;
}

.btn-wrapper {
    text-align: center;
}
</style>
