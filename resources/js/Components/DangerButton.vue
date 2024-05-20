<script>
export default {
    props: {
        rounded: {
            type: Boolean,
            required: false,
            default: false
        }
    }
}
</script>
<template>
    <button
        :class="[rounded ? 'rounded-full' : 'rounded-md']"
        class="inline-flex items-center px-4 py-2 bg-error border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-error hover:opacity-75 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot/>
    </button>
</template>
