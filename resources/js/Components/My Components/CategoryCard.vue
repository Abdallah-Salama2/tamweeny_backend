<template>
  <!-- Product Card -->
  <div class="cardWidth relative shadow-2xl rounded-3xl color">
    <Link class="relative" :href="route('admin.categories.show', category.categoryName)">
      <!-- Category Image -->
      <img
        v-if="category.categoryImage"
        :src="category.categoryImage"
        alt="categoryImage"
        class="border border-transparent rounded-3xl"
        style="height: 443px; width: 100%;"
      />
      <!-- Use a placeholder image if product image is null -->
      <img
        v-else
        src="../../img/elementor-placeholder-image.png"
        alt="Placeholder"
        class="border border-transparent rounded-3xl"
        style="height: 443px; width: 100%;"
      />

      <!-- Overlay with category name -->
      <div class="overlay">
        <h1 class="overlay-text">{{ category.categoryName }}</h1>
      </div>
    </Link>

    <!-- Product details -->
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

defineProps({
  category: Object,
})
</script>

<style scoped>
.cardWidth {
    width: 90vw;
    max-width: 340px;
    max-height: 443px;
}

.bgcolor {
    background-color: rgba(0, 0, 0, 50%);
}

.color {
    background-color: #1e1e1e;
}

p, h6, .iconColor, label {
    color: #c6ffe6;
}

.spanColor {
    color: #61bc84;
}

.relative {
    position: relative;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.35); /* Overlay background with rgba */
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 25px; /* Ensures the overlay matches the image's rounded corners */
}

.overlay-text {
    color: white;
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
    z-index: 1; /* Ensure text is above the background */
}
</style>
