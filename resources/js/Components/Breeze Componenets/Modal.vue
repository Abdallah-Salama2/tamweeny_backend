<template>
  <Teleport to="body">
    <Transition leave-active-class="duration-200">
      <div v-show="show" class="fixed inset-0 flex justify-center items-center z-50">
        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0"
        >
          <div v-show="show" class="fixed inset-0">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75" @click="close" />
          </div>
        </Transition>

        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            v-show="show"
            class="   rounded-lg overflow-hidden shadow-xl transform transition-all  sm:mx-auto"
            :class="maxWidthClass"
          >
            <slot v-if="show" />
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Teleport, Transition } from 'vue'
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  maxWidth: {
    type: String,
    default: '2xl',
  },
  closeable: {
    type: Boolean,
    default: true,
  },
})

const emit = defineEmits(['close'])

const close = () => {
  if (props.closeable) {
    emit('close')
  }
}

const maxWidthClass = computed(() => {
  return {
    sm: 'sm:max-w-sm',
    md: 'sm:max-w-md',
    lg: 'sm:max-w-lg',
    xl: 'sm:max-w-xl',
    '2xl': 'sm:max-w-2xl',
  }[props.maxWidth]
})
</script>

<style scoped>
/* Style for centering the modal */
.fixed.inset-0 {
    display: flex;
    justify-content: center;
    align-items: center;

}

.cardBackvorund{
    background: rgba(35, 35, 35, 80%);

}
</style>
