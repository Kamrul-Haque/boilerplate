<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    clickable: {
        type: Boolean,
        required: false,
        default: false
    },
})
</script>

<template>
    <Link v-if="clickable"
          :href="route('home')"
          class="text-gray-800 block w-auto fill-current">
        <i class="mdi mdi-laravel"></i>
    </Link>
    <div v-else
         class="text-gray-800">
        <i class="mdi mdi-laravel"></i>
    </div>
</template>
