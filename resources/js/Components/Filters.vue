<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input
                    type="text" placeholder="السعر من"
                    class="input-filter-r w-28"
                />
                <input
                    type="text" placeholder="السعر الى"
                    class="input-filter-l w-28"
                />
            </div>

            <div class="flex flex-nowrap items-center">
                <select class="input-filter w-28 rtl:">
                    <option :value="null">الفئات</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
<!--                    <option>6+</option>-->
                </select>

            </div>


            <button type="submit" class="btn-normal mr-2 rounded-3xl">Filter</button>
            <!--      <button type="reset" class="mr-2" @click="clear">Clear</button>-->
        </div>
    </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'
import {route} from 'ziggy-js'

const props = defineProps({
    filters: Object,
    categories: Array,
})
//
// const filterForm = useForm({
//   priceFrom: props.filters.priceFrom ?? null,
//   priceTo: props.filters.priceTo ?? null,
//   beds: props.filters.beds ?? null,
//   baths: props.filters.baths ?? null,
//   areaFrom: props.filters.areaFrom ?? null,
//   areaTo: props.filters.areaTo ?? null,
// })

const filter = () => {
    filterForm.get(
        route('listing.index'),
        {
            preserveState: true,
            preserveScroll: true,
        },
    )
}

const clear = () => {
    filterForm.priceFrom = null
    filterForm.priceTo = null
    filterForm.beds = null
    filterForm.baths = null
    filterForm.areaFrom = null
    filterForm.areaTo = null
    filter()
}
</script>
