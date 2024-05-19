<template>
    <Head title="Users"/>

    <AuthenticatedLayout>
        <form @submit.prevent="create" >
            <div class="   overflow-y-visible   mt-3   relative ">
                <div class="mr-2  absolute  top-10 right-32 text-xl">
                    <label for="supplier">موزع</label>
                    <input id=supplier type="radio" name="userType" class="mt-1" style="margin-right: 12px"
                           @click="userType = 'Supplier'" checked><br><br>
                    <label for="delivery">طيار</label>
                    <input id=delivery type="radio" name="userType" class="mr-4 mb-1" @click="userType = 'Delivery' ">
                </div>

                <div class=" " style="margin-right: 780px">
                    <Link><img src="../../../img/Ellipse%202.png" class="" alt="logo.png"></Link>
                </div>

                <div style="float: right" class="mr-96 mt-2 personalInfo">
                    <h1 class="text-3xl font-bold">البيانات الشخصيه</h1>
                    <label for="name" class="text-white">الاسم</label><br>
                    <input v-model="data.name" id="name" type="text" class=""><br>
<!--                    <div v-if="data.errors.name" class="input-error">-->
<!--                        {{ data.errors.name }}-->
<!--                        &lt;!&ndash; form.erros used to show validation error hyro7 3la beds fe validation w yshof eih rules bta3etha &ndash;&gt;-->
<!--                    </div>-->
                    <label for="nationalId" class="text-white">الرقم القومى</label><br>
                    <input v-model="data.nationalId" id="nationalId" type="number" name="nationalId"><br>
<!--                    <div v-if="data.errors.nationalId" class="input-error">-->
<!--                        {{ data.errors.nationalId }}-->
<!--                        &lt;!&ndash; form.erros used to show validation error hyro7 3la beds fe validation w yshof eih rules bta3etha &ndash;&gt;-->
<!--                    </div>-->
                    <label for="phoneNumber" class="text-white">رقم المحمول</label><br>
                    <input v-model="data.phoneNumber" id="number" type="tel" name="phoneNumber"><br>
                    <label for="birthDate" class="text-white">تاريخ الميلاد</label><br>
                    <input v-model="data.birthDate" id="birthDate" type="date" name="birthDate"><br>
                    <label for="address" class="text-white">عنوان السكن</label><br>
                    <input v-model="data.address" id="address" type="text" name="address"><br>
                    <section v-if="userType === 'Supplier'">
                    <label for="storeName" class="text-white">اسم محل التوزيع</label><br>
                    <input v-model="data.storeName" id="storeName" type="text" name="name"><br>
                    <label for="storeAddress" class="text-white">عنوان محل التوزيع</label><br>
                    <input v-model="data.storeAddress" id="storeAddress" type="text" name="name"><br>
                    <!--                    <label for="cardNumber" class="text-white">رقم بطاقة التموين</label><br>-->
                    <!--                    <input v-model="data.cardNumber" id="cardNumber" type="number" name="cardNumber" class="mb-5"><br>-->
                    </section>
                </div>
                <!--                                @role('storeOwner')-->

                <!--                                @endrole-->


                <div class="ml-64 mt-10 pass" style="float: left">
                    <section v-if="userType === 'Supplier'">

                    <label for="cardNumber" class="text-white">رقم البطاقة الضريبية</label><br>
                    <input v-model="data.cardNumber" id="cardNumber" type="number" name="card_name" class="mb-5"><br>
                    <label for="taxNumber" class="text-white">رقم التسجيل الضريبي</label><br>
                    <input v-model="data.taxNumber" id="taxNumber" type="number" name="card_name" class="mb-5"><br>
                    </section>

                    <h1 class="text-3xl font-bold">كلمة السر والامان </h1>

                    <label for="email" class="text-white">البريد الألكترونى</label><br>
                    <input v-model="data.email" id="email" type="email" name="name"><br>

                    <label for="password" class="text-white">كلمة السر </label><br>
                    <input v-model="data.password" id="password" type="password" name="card_name" class="mb-5"><br>


                </div>
                <!--            <span class="block spanColor">{{ user.card.card_number }}</span>-->


            </div>
            <div class="  " style="margin-right: 760px ; margin-top: 500px;">
                <button type="submit" class="mb-20  "
                        style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px">
                    تأكيد
                </button>
                <br>


            </div>
        </form>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import ProductCard from "@/Components/ProductCard.vue";
import {onMounted, onBeforeMount, ref, reactive} from "vue";
import UserCard from "@/Components/UserCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {route} from "ziggy-js";

const userType = ref('Supplier');
// const errors = ref({});

// const ay7aga="asdad";
defineProps({
    users: Array,
    // cardNumber:Array

})

const data = useForm({
    name: null,
    nationalId: null,
    phoneNumber: null,
    birthDate: null,
    address: null,
    cardNumber: null,
    // cardName:"",
    email: null,
    password: null,
    taxNumber: null,
    storeAddress: null,
    storeName: null,


});


const create = () => data.post(route('admin.user.store', {"userType": userType.value}));
//     try {
//         const response = await
//         console.log(response);
//         // Handle successful response
//     } catch (error) {
//         if (error.response.status === 422) {
//             // Update errors ref with validation errors
//             errors.value = error.response.data.errors;
//             // Handle validation errors
//         } else {
//             // Handle other errors
//         }
//     }
// };
//

// const reset = () => {
//     data.name = "";
//     data.nationalId = "";
//     data.phoneNumber = "";
//     data.birthDate = "";
//     data.address = "";
//     data.cardNumber = "";
//     // data.cardName="";
//     data.taxNumber = "";
//     data.email = "";
//     data.password = "";
//     data.storeName = "";
//     data.storeAddress = "";
// }

</script>

<style scoped>


p, h1, label {
    color: #c6ffe6;
}

.spanColor {
    color: #61bc84;
}


.personalInfo input,
.pass input {
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
