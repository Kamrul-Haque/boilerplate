<script setup>
const props = defineProps(['icon'])
</script>

<template>
    <div class="card w-full">
        <div class="card-body">
            <div class="flex gap-2">
                <div class="mt-1">
                    <div class="bg-accent rounded-full shadow flex items-center justify-center h-[50px] w-[50px]">
                        <i class="mdi text-background text-4xl mt-0.5"
                           :class="`mdi-${icon}`"></i>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl">
                        <slot name="title"/>
                    </h4>
                    <p class="text-sm text-gray-500">
                        <slot/>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
