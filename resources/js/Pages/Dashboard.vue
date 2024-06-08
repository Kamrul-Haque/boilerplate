<script setup>
import Admin from '@/Layouts/Admin.vue';
import {Head} from '@inertiajs/vue3';
import Switch from "@/Components/Switch.vue";
import {ref} from "vue";
import AutoComplete from "@/Components/AutoComplete.vue";
import DropZone from "@/Components/DropZone.vue";

let value = ref(false);
const suggestions = [
    {id: 1, name: 'Apple'},
    {id: 2, name: 'Banana'},
    {id: 3, name: 'Cherry'},
    {id: 4, name: 'Date'},
    {id: 5, name: 'Elderberry'},
    {id: 6, name: 'Fig'},
    {id: 7, name: 'Grape'},
    {id: 8, name: 'Honeydew'},
];
const fruit = ref(null)
</script>

<template>
    <Head title="Dashboard"/>

    <Admin>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="card">
            <div class="card-body">You're logged in!</div>
        </div>

        <div class="my-4">
            <Switch v-model="value"></Switch>
            <p class="mt-4">Switch is {{ value ? 'ON' : 'OFF' }}</p>
        </div>

        <div class="my-4">
            <AutoComplete :items="suggestions"
                          item-label="name"
                          item-value="id"
                          v-model="fruit"
                          required
                          label="autocomplete"
                          :error="'input is invalid'"></AutoComplete>
        </div>

        <div class="my-4">
            <DropZone label="dropzone"
                      allow-multiple
                      allow-preview
                      required>
            </DropZone>
        </div>
    </Admin>
</template>
