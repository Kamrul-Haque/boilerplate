<script setup>
import TextField from "@/Components/TextField.vue";
import {useForm} from "laravel-precognition-vue-inertia";

const form = useForm('get', null, {
    search: '',
});
</script>

<template>
    <div class="block fixed bg-white w-full right-0 shadow-sm h-full z-50 transition-transform duration-300 ease-in-out">
        <!--Responsive Settings Options-->
        <div class="pb-1 border-t border-gray-200 px-4 max-h-[calc(100%-100px)] overflow-y-auto overflow-x-hidden">
            <TextField append-icon="mdi mdi-magnify"
                       v-model="form.search"
                       placeholder="search courses"
                       class="w-full"
                       autofocus
                       required>
            </TextField>
        </div>
    </div>
</template>
