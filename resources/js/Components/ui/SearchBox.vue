<script setup>
import TextField from "@/Components/TextField.vue";
import {useForm} from "laravel-precognition-vue-inertia";

const form = useForm('get', null, {
    search: '',
});
</script>

<template>
    <TextField append-icon="mdi mdi-magnify"
               v-model="form.search"
               @change="form.validate('search')"
               :error="form.errors.search"
               placeholder="search courses by course title, instructor name or category name"
               class="w-full"
               autofocus
               required
               rounded>
    </TextField>
</template>
