<script setup>
import {computed} from "vue";

const props = defineProps({
    path: {
        type: String,
        required: true
    },
    size: {
        type: String,
        required: false,
        default: '50px'
    },
    alt: String
});

const avatarStyle = computed(() => ({
    width: props.size,
    height: props.size,
}));
</script>

<template>
    <div :style="avatarStyle"
         class="rounded-full overflow-hidden border border-gray-100">
        <img :src="path"
             :alt="alt"
             class="w-full h-full object-cover">
    </div>
</template>
