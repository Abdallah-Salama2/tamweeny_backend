<script setup>
import DangerButton from '@/Components/Breeze Componenets/DangerButton.vue'
import InputError from '@/Components/Breeze Componenets/InputError.vue'
import InputLabel from '@/Components/Breeze Componenets/InputLabel.vue'
import Modal from '@/Components/Breeze Componenets/Modal.vue'
import SecondaryButton from '@/Components/Breeze Componenets/SecondaryButton.vue'
import TextInput from '@/Components/Breeze Componenets/TextInput.vue'
import { useForm } from '@inertiajs/vue3'
import { nextTick, ref } from 'vue'

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null)

const form = useForm({
  password: '',
})

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true

  nextTick(() => passwordInput.value.focus())
}

const deleteUser = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  })
}

const closeModal = () => {
  confirmingUserDeletion.value = false

  form.reset()
}
</script>

<template>
  <section class="space-y-6">
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">مسح الحساب</h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        بمجرد حذف حسابك، ستُحذف جميع الموارد والبيانات الخاصة به نهائيًا. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.
      </p>
    </header>

    <DangerButton @click="confirmUserDeletion">
      امسح الحساب
    </DangerButton>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          هل أنت متأكد أنك تريد حذف حسابك
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          بمجرد حذف حسابك، ستُحذف جميع الموارد والبيانات الخاصة به نهائيًا. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.
        </p>

        <div class="mt-6">
          <InputLabel for="password" value="Password" class="sr-only" />

          <TextInput
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4"
            placeholder="Password"
            @keyup.enter="deleteUser"
          />

          <InputError :message="form.errors.password" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal"> الغاء </SecondaryButton>

          <DangerButton
            class="ms-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteUser"
          >
            امسح الحساب
          </DangerButton>
        </div>
      </div>
    </Modal>
  </section>
</template>
