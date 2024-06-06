<script setup>
import {computed, onMounted, ref, watch} from "vue";
import {usePage} from "@inertiajs/vue3";

let show = ref(false);
const page = usePage();

const flash = computed(() => {
    return page.props.flash
});

watch(flash, (newValue, oldValue) => {
    show.value = true;
});

onMounted(() => {
    setTimeout(() => {
        if (show.value)
            show.value = false;
    }, 4000);
});
</script>

<template>
    <div>
        <div v-if="flash.success && show"
             class="flex justify-between bg-green-500 bg-opacity-25 rounded-lg p-4 mb-4 text-sm text-success w-full break-all"
             role="alert">
            <div class="flex-1">
                <span class="mdi mdi-check-circle text-lg mr-4"></span>
                {{ flash.success }}
            </div>
            <span class="mdi mdi-close-circle-outline text-lg ml-4"
                  @click="show=false"></span>
        </div>
        <div v-if="flash.error && show"
             class="flex justify-between bg-red-500 bg-opacity-25 rounded-lg p-4 mb-4 text-sm text-error w-full break-all"
             role="alert">
            <div class="flex-1">
                <span class="mdi mdi-alert-circle text-lg mr-4"></span>
                {{ flash.error }}
            </div>
            <span class="mdi mdi-close-circle-outline text-lg ml-4"
                  @click="show=false"></span>
        </div>
    </div>
</template>
