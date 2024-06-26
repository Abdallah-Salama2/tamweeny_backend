<template>
  <Head title="Users" />

  <AuthenticatedLayout>
    <form @submit.prevent="create">
      <!--      <h1>ADD STORE LOCATION ON MAP BY LATITUDE AND LONGITUDE</h1>-->
      <!--        v-if="permissions.includes('list-orders')"-->

      <div
        class="overflow-y-visible mt-3 relative"
      >
        <div class="mr-2 absolute top-10 right-32 text-xl">
          <div v-if="permissions.includes('add-supplier')">
            <label for="supplier">موزع</label>
            <input
              id="supplier" type="radio" name="userType" class="mt-1" style="margin-right: 12px"
              :checked="userType === 'Supplier'" @click="userType = 'Supplier'"
            /><br /><br />
          </div>

          <label for="delivery">طيار</label>

          <input v-if="permissions.includes('add-supplier')" id="delivery" type="radio" name="userType" class="mr-4 mb-1" checked @click="userType = 'Delivery'" />
        </div>

        <div class="" style="margin-right: 780px">
          <Link><img src="../../../img/Ellipse%202.png" class="" alt="logo.png" /></Link>
        </div>

        <div style="float: right" class="mr-96 mt-2 personalInfo">
          <h1 class="text-3xl font-bold">البيانات الشخصيه</h1>
          <label for="name" class="text-white">الاسم</label><br />
          <input id="name" v-model="data.name" type="text" class="" required /><br />
          <label for="nationalId" class="text-white">الرقم القومى</label><br />
          <input id="nationalId" v-model="data.nationalId" type="number" name="nationalId" required /><br />
          <label for="phoneNumber" class="text-white">رقم المحمول</label><br />
          <input id="number" v-model="data.phoneNumber" type="tel" name="phoneNumber" required /><br />
          <label for="birthDate" class="text-white">تاريخ الميلاد</label><br />
          <input id="birthDate" v-model="data.birthDate" type="date" name="birthDate" required /><br />
          <label for="address" class="text-white">عنوان السكن</label><br />
          <input id="address" v-model="data.address" type="text" name="address" required /><br />
          <section v-if="userType === 'Supplier'">
            <label for="storeName" class="text-white">اسم محل التوزيع</label><br />
            <input id="storeName" v-model="data.storeName" type="text" name="name" required /><br />
            <label for="storeAddress" class="text-white">عنوان محل التوزيع</label><br />
            <input id="storeAddress" v-model="data.storeAddress" type="text" name="name" required /><br />
          </section>
        </div>

        <div class="ml-64 mt-10 pass" style="float: left">
          <section v-if="userType === 'Supplier'">
            <label for="cardNumber" class="text-white">رقم البطاقة الضريبية</label><br />
            <input id="cardNumber" v-model="data.cardNumber" type="number" name="card_name" class="mb-5" required /><br />
            <label for="taxNumber" class="text-white">رقم التسجيل الضريبي</label><br />
            <input id="taxNumber" v-model="data.taxNumber" type="number" name="card_name" class="mb-5" required /><br />
          </section>

          <h1 class="text-3xl font-bold">كلمة السر والامان </h1>
          <label for="email" class="text-white">البريد الألكترونى</label><br />
          <input id="email" v-model="data.email" type="email" name="name" required /><br />
          <label for="password" class="text-white">كلمة السر </label><br />
          <input id="password" v-model="data.password" type="password" name="card_name" class="mb-5" required /><br />
        </div>
      </div>
      <div class="" style="margin-right: 760px; margin-top: 500px;">
        <button
          type="submit" class="mb-20"
          style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px"
        >
          تأكيد
        </button>
        <br />
      </div>
    </form>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import { route } from 'ziggy-js'
import ResponsiveNavLink from '@/Components/Breeze Componenets/ResponsiveNavLink.vue'

const userType = ref('Delivery')

const page = usePage()

const permissions = computed(() => page.props.auth.permissions)

const data = useForm({
  name: null,
  nationalId: null,
  phoneNumber: null,
  birthDate: null,
  address: null,
  cardNumber: null,
  email: null,
  password: null,
  taxNumber: null,
  storeAddress: null,
  storeName: null,
})

const create = () => {
  data.post(route('admin.user.store', { userType: userType.value }))
}
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
}
.cursor-pointer {
    cursor: pointer;
}
.btn-wrapper {
    text-align: center;
}
</style>
