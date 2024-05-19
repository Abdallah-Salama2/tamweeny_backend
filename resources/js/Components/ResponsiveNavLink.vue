<script setup>
import {computed} from 'vue';
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'block w-full ps-3 pe-4 py-2  text-start text-base font-medium  ' +
        'activeColor bg-gray-800 focus:outline-none focus:text-black-800 dark:focus:text-black focus:bg-indigo-100 ' +
        'dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out'
        : 'text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot/>
    </Link>
</template>

<style>
.activeColor{
    color: #61BC84;
}
.layout {
    background: rgba(35, 35, 35, 80%);
}
</style>
