<script setup>
import Admin from '@/Layouts/Admin.vue';
import {Head} from '@inertiajs/vue3';
import Switch from "@/Components/Switch.vue";
import {ref} from "vue";

let value = ref(false);
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
    </Admin>
</template>
