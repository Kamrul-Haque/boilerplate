<script setup>
import {computed, ref, watch} from "vue";
import {usePage} from "@inertiajs/vue3";

let show = ref(false);
const page = usePage();

const flash = computed(() => {
    return page.props.flash;
});

watch(flash, () => {
    show.value = true;
});

watch(show, () => {
    if (show.value) {
        setTimeout(() => {
            show.value = false;
        }, 3000)
    }
});
</script>

<template>
    <div v-if="flash.success && show"
         class="flex items-center bg-success bg-opacity-15 rounded-lg p-4 bottom-20 fixed right-4 z-10 text-sm text-success w-full md:w-1/3 break-all"
         role="alert">
        <i class="mdi mdi-check-circle text-lg mr-4"></i>
        {{ flash.success }}
    </div>
    <div v-if="flash.error && show"
         class="flex items-center bg-error bg-opacity-15 rounded-lg p-4 bottom-20 fixed right-4 z-10 text-sm text-error w-full md:w-1/3 break-all"
         role="alert">
        <i class="mdi mdi-alert-circle text-lg mr-4"></i>
        {{ flash.error }}
    </div>
</template>
