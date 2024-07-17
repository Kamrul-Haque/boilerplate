<script setup>
import {Head} from '@inertiajs/vue3';
import Auth from "@/Layouts/Auth.vue";
</script>

<template>
    <Head title="Home"/>
    <Auth>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">This is Home page</div>
                </div>
            </div>
        </div>
    </Auth>
</template>
