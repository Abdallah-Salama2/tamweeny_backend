<script setup>
import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'))
}
</script>

<template>
  <GuestLayout>
    <Head title="تسجيل الدخول" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>
    <form @submit.prevent="submit">
      <input type="hidden" name="_token" :value="csrfToken" />

      <h1 class="text-white text-center font-medium">تسجيل الدخول الى حسابك</h1>

      <!--                <InputLabel for="password" value="كلمة السر"/>-->


      <div class="flex mt-6 mr-12" style="width:300px ;">
        <span
          class="inline-flex items-center px-3 text-sm text-gray-900 iconColor border rounded-e-0 border-gray-300 border-e-0 rounded-s-md  dark:text-gray-400 dark:border-gray-600"
        >
          <svg
            class="w-4 h-4 mt-1 text-gray-800 dark:text-white" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"
            />
            <path
              d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"
            />
          </svg>
        </span>
        <input
          id="website-admin" v-model="form.email"
          type="text"
          class="rounded-none rounded-e-lg bg-transparent  border text-gray-900  placeholder-green-500 font-medium
                           block flex-1 min-w-0 w-full text-sm border-gray-100 p-2.5  dark:border-gray-600  dark:text-white"
          placeholder="البريد الألكترونى"
        />
      </div>

      <!--                <InputLabel for="password" value="كلمة السر"/>-->

      <div class="flex mt-6 mr-12" style="width:300px ;">
        <span
          class="inline-flex items-center iconColor px-3 text-sm text-gray-900  border rounded-e-0 border-gray-300 border-e-0 rounded-s-md  dark:text-gray-400 dark:border-gray-600"
        >
          <svg
            class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              fill-rule="evenodd"
              d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"
              clip-rule="evenodd"
            />
          </svg>

        </span>
        <input
          id="website-admin" v-model="form.password"
          type="text"
          class="rounded-none rounded-e-lg bg-transparent  border text-gray-900 focus:ring-blue-500 focus:border-blue-500  placeholder-green-500 font-medium
                           block flex-1 min-w-0 w-full text-sm border-gray-100 p-2.5  dark:border-gray-600  dark:text-white dark:focus:ring-blue-500
                            dark:focus:border-blue-500"

          placeholder="كلمة السر"
        />
      </div>

      <div class="block mt-4 mr-12">
        <label class="flex items-center">
          <Checkbox v-model:checked="form.remember" name="remember" />
          <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">تذكرني</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4 w">
        <!--                <Link-->
        <!--                    v-if="canResetPassword"-->
        <!--                    :href="route('password.request')"-->
        <!--                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"-->
        <!--                >-->
        <!--                    Forgot your password?-->
        <!--                </Link>-->

        <PrimaryButton
          class="ms-4 text-xs  iconColor textColor" :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing" style="margin-left: 62px"
        >
          تسجيل الدخول
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<style>
body {
    background: rgba(45, 45, 45, 100%) url('/resources/js/img/base desktop.png') no-repeat center center fixed;
    background-size: cover;

}

.iconColor {
    background-color: #345E37;
}

.textColor {
    color: #C6FFE6;
}
</style>
