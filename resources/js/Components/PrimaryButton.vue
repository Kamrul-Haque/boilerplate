<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    block: Boolean,
    rounded: Boolean,
    href: String,
    method: String,
});
</script>

<template>
    <Link v-if="href"
          :href="href"
          :method="method"
          :class="[rounded ? 'rounded-full' : '', block ? 'w-full' : '']"
          class="btn btn-primary">
        <slot/>
    </Link>
    <button v-else
            :class="[rounded ? 'rounded-full' : '', block ? 'w-full' : '']"
            class="btn btn-primary">
        <slot/>
    </button>
</template>
