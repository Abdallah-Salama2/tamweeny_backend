<template>

    <!-- Product Card -->
    <div class=" flex flex-col cardWidth relative shadow-2xl rounded-3xl color" >
        <div class="relative">
            <!-- Main image -->
            <div @mouseenter="isHovered = true" @mouseleave="isHovered = false"
                 class="gg">

                <img v-if="product.product_image"
                     :src="product.product_image"
                     alt="productImage"
                     class="border border-transparent rounded-3xl w-full h-60"
                     :style="{ opacity: isHovered ? 0.6 : 1 }"
                >
                <!-- Use a placeholder image if product image is null -->
                <img v-else
                     src="../img/elementor-placeholder-image.png"
                     alt="Placeholder"
                     class="border border-transparent rounded-3xl w-full h-60"
                     :style="{ opacity: isHovered ? 0.1 : 1 }"

                >

                <!--                @mouseenter="isHovered(product.id, true)"-->
                <!--                @mouseleave="isHovered(product.id, false)"-->
                <!--                -->
                <div v-if="isHovered"
                     class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center "
                >
                    <div class="flex">
                        <svg class="w-6 mt-1 h-6 iconn text-gray-800 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             viewBox="0 0 24 24">
                            <path
                                d="M18.045 3.007 12.31 3a1.965 1.965 0 0 0-1.4.585l-7.33 7.394a2 2 0 0 0 0 2.805l6.573 6.631a1.957 1.957 0 0 0 1.4.585 1.965 1.965 0 0 0 1.4-.585l7.409-7.477A2 2 0 0 0 21 11.479v-5.5a2.972 2.972 0 0 0-2.955-2.972Zm-2.452 6.438a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                        </svg>
                        <!--    <as relation-->
                        <button @click="showModal = true"
                                class="text-2xl font-bold cursor-pointer mb-4 text-emerald-400">اضافة عرض
                        </button>
                    </div>
                    <div class="flex">
                        <svg class="w-6 h-6 mt-1 ml-1 text-gray-800 iconn dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                        </svg>
                        <!--    <as relation-->
                        <Link :href="route('admin.product.edit',product)"
                              class="text-2xl font-bold cursor-pointer mb-4 text-emerald-400">تعديل منتج
                        </Link>
                    </div>
                    <div class="flex">

                        <svg class="w-6 h-6 mt-1  ml-1 text-gray-800 iconn dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="2" height="2" fill="currentColor"
                             viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                  d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <Link :href="route('admin.product.destroy',product)" method="delete" as="button"
                              class="text-2xl font-bold  mb-4 text-emerald-400">
                            حذف منتج
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <Modal class="" :show="showModal" @close="showModal = false">
            <!-- Content of the modal -->
<!--            <Link @click="showModal = false" class=" absolute left-2 top-2">-->
<!--                <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"-->
<!--                     width="24" height="24" fill="none" viewBox="0 0 24 24">-->
<!--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"-->
<!--                          d="M6 18 17.94 6M18 18 6.06 6"/>-->
<!--                </svg>-->
<!--            </Link>-->
            <div class="w-full flex flex-col  relative shadow-2xl rounded-3xl color"
                 style="height: 800px; width: 400px; margin: auto;">
                <img v-if="product.product_image"
                     :src="product.product_image"
                     alt="productImage"
                     class="border border-transparent rounded-3xl w-full" style="height: 250px"
                >
                <div class="mt-4 p-2  flex-1 flex-col items-center text-center text-xl justify-between  ">
                    <h6 class="mb-4 pColor">{{ product.description }}</h6>
                    <p class="mb-4 pColor">
                        سعر الوحدة
                        <span class="block spanColor">{{ product.productpricing.base_price }}</span>
                    </p>
                    <p class="mb-4 pColor">
                        الكمية المتاحة
                        <span class="block spanColor">{{ product.stock_quantity }}</span>
                    </p>
                    <p class="mb-4 pColor">
                        الفئة
                        <span class="block spanColor">{{ product.category.category_name }}</span>
                    </p>
                    <form @submit.prevent="create">
                        <label for="price" class="text-white">السعر داخل العرض</label><br>
                        <input v-model="product.selling_price" id="price" type="number"><br>
                        <label for="offerQuantity" class="text-white"> عدد القطع داخل العرض</label><br>
                        <input v-model="product.selling_price" id="offerQuantity" type="number"><br>
                        <button class="mt-4" type="submit"
                                style="background:#345E37;color:#C6FFE6;width: 200px;justify-content: center;padding: 10px;border-radius: 20px">
                            اضافة عرض
                        </button>
                    </form>
                </div>

            </div>
            <div class=" ">
                <!-- Your modal content here -->

            </div>
        </Modal>
        <!-- Second image and discount -->
        <img :src="selectedImage" alt="status" class="absolute top-0" style="left: 2px;">
        <div v-if="showFirstImage">
            <img :src="'https://i.imghippo.com/files/pgMMB1712509469.png'" alt="status" class="absolute top-0"
                 style="right: 0;">
            <p class="absolute top-0 right-4 text-lg font-semibold">{{ product.productpricing.discount }}% -</p>
        </div>

        <!-- Product details -->
        <div class="p-1 flex-1 flex-col items-center text-center text-xl justify-between font-bold">
            <h6 class="mb-7 pColor">{{ product.description }}</h6>
            <p class="mb-7 pColor">
                سعر الوحدة
                <span class="block spanColor">{{ product.productpricing.selling_price }}</span>
            </p>
            <p>
                الكمية المتاحة
                <span class="block spanColor">{{ product.stock_quantity }}</span>
            </p>
        </div>

    </div>

</template>


<script setup>
import {computed, defineProps, ref} from 'vue';
import {route} from "ziggy-js";
import {router, Link} from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";

// Define a ref to store the products
// const products = ref([]);
// Define a ref to track hover states for each product
// const isHovering = ref({});
const props = defineProps({
    // isHovered: false,

    product: Object,
    selectedImage: {
        type: String,
        default: "https://i.imghippo.com/files/zs3Zz1712448566.png"
    },
    showFirstImage: {
        type: Boolean,
        default: true
    },
    buttonLink: {
        type: String,
        default: "#" // Default link
    },
    showFirstButton: {
        type: Boolean,
        default: true // Default to showing the first button
    },
});

const isHovered = ref(false)

const showModal = ref(false);
// Function to toggle modal visibility
const toggleModal = () => {
    showModal.value = !showModal.value;
}

// Function to close the modal
const closeModal = () => {
    showModal.value = false;
}


</script>

<style scoped>
.cardWidth {
    width: 90vw;
    max-width: 340px;
}

.color {
    background-color: #1e1e1e;
}

p, h6, .iconColor, label {
    color: #c6ffe6;
}
.iconn{
    color: #c6ffe6;
}
.spanColor {
    color: #61bc84;
}

/* Only apply pointer-events: none; when not hovering */
.btn-wrapper:not(:hover) {
//pointer-events: none;
}

/* Ensure links remain clickable */
.cursor-pointer {
//cursor: pointer;
}

.btn-wrapper {
    text-align: center;
}

input {
    color: white;
    background-color: transparent;
    width: 100%;

    border-radius: 10px;
    margin-bottom: 10px;
//border: none;
    /* Add more custom styles here */
}
</style>
