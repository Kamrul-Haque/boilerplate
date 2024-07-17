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
          class="font-bold w-full px-5 py-5 my-0 cursor-pointer hover:text-opacity-75 transition-all ease-in-out duration-150"
          :class="[active ? 'text-primary border-b-2 border-primary' : 'border-b-2 border-transparent']">
        <slot/>
    </Link>
</template>
