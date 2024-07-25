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
         class="flex justify-between bg-success opacity-25 border-2 border-success rounded-lg p-4 bottom-10 fixed right-5 z-10 text-sm text-success w-full md:w-1/3 break-all"
         role="alert">
        <div class="flex-1">
            <span class="mdi mdi-check-circle text-lg mr-4"></span>
            {{ flash.success }}
        </div>
        <span class="mdi mdi-close-circle-outline text-lg ml-4"
              @click="show=false"></span>
    </div>
    <div v-if="flash.error && show"
         class="flex justify-between bg-error opacity-25 border-2 border-error rounded-lg p-4 bottom-10 fixed right-5 z-10 text-sm text-error w-full md:w-1/3 break-all"
         role="alert">
        <div class="flex-1">
            <span class="mdi mdi-alert-circle text-lg mr-4"></span>
            {{ flash.error }}
        </div>
        <span class="mdi mdi-close-circle-outline text-lg ml-4"
              @click="show=false"></span>
    </div>
</template>
