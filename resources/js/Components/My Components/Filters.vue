<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.priceFrom"
          type="text" placeholder="السعر من"
          class="input-filter-r w-28"
        />
        <input
          v-model.number="filterForm.priceTo"
          type="text" placeholder="السعر الى"
          class="input-filter-l w-28"
        />
      </div>
      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.quantityFrom"
          type="text" placeholder="الكمية من "
          class="input-filter-r w-28"
        />
        <input
          v-model.number="filterForm.quantityTo"

          type="text" placeholder="الكمية الى"
          class="input-filter-l w-28"
        />
      </div>

      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.category" class="input-filter w-28">
          <option :value="null">الفئات</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.category_name }}
          </option>
          <!--                    <option>6+</option>-->
        </select>
      </div>


      <button type="submit" class="btn-normal mr-2 rounded-3xl">Filter</button>
      <button type="reset" class="btn-normal mr-2 rounded-3xl" @click="clear">Clear</button>

      <!--      <button type="reset" class="mr-2" @click="clear">Clear</button>-->
    </div>
  </form>
</template>

<script setup>
import { route } from 'ziggy-js'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  filters: Object,
  categories: Array,
})

const filterForm = useForm({
  quantityFrom: props.filters.quantityFrom ?? null,
  quantityTo: props.filters.quantityTo ?? null,
  priceFrom: props.filters.priceFrom ?? null,
  priceTo: props.filters.priceTo ?? null,
  category: props.filters.category ?? null,
})

const filter = () => {
  filterForm.get(
    route('admin.product.index'),
    {
      preserveState: true,
      preserveScroll: true,
    },
  )
}
const clear = () => {
  filterForm.priceFrom = null
  filterForm.priceTo = null
  filterForm.quantityTo = null
  filterForm.quantityFrom = null
  filterForm.category = null
  filter()
}
// const clear = () => {
//   filterForm.priceFrom = null
//   filterForm.priceTo = null
//   filterForm.beds = null
//   filterForm.baths = null
//   filterForm.areaFrom = null
//   filterForm.areaTo = null
//   filter()
// }
</script>
