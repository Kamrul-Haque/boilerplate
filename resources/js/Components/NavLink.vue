<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean
    }
});
</script>

<template>
    <Link :href="href"
          as="div"
          class="font-semibold text-gray-700 w-full px-5 py-5 my-0 cursor-pointer hover:text-opacity-75 transition-all ease-in-out duration-150 inline-flex items-center gap-2 text-nowrap"
          :class="[active ? 'text-primary border-b-2 border-primary' : 'border-b-2 border-transparent']">
        <slot/>
    </Link>
</template>
