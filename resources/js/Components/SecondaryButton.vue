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
        class="inline-flex bg-secondary items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-secondary hover:opacity-75 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot/>
    </button>
</template>
