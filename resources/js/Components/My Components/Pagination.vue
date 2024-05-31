<template>
  <div>
    <button
      v-for="link in links"
      :key="link.label"
      :disabled="!link.url"
      :class="['pagination-link', { 'is-active': link.active, 'is-disabled': !link.url }]"
      @click="goToPage(link.url)"
      v-html="link.label"
    />
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  },
  methods: {
    goToPage(url) {
      if (url) {
        this.$inertia.get(url)
      }
    },
  },
}
</script>

<style scoped>
.pagination-link {
    padding: 10px;
    margin: 0 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
}

.pagination-link.is-active {
    background-color: #007bff;
    color: white;
}

.pagination-link.is-disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
