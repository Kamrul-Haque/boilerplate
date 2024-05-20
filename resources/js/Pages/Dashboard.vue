<script setup>
import Admin from '@/Layouts/Admin.vue';
import {Head} from '@inertiajs/vue3';
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
    </Admin>
</template>
