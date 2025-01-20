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
        ? 'text-primary'
        : 'text-gray-800'
);
</script>

<template>
    <Link :href="href"
          :class="classes"
          class="block w-full pt-2 border-transparent text-left text-base font-medium focus:outline-none focus:text-primary transition duration-150 ease-in-out">
        <slot/>
    </Link>
</template>
