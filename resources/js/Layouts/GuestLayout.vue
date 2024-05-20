<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {Link} from '@inertiajs/vue3';

export default {
    components: {
        ApplicationLogo,
        Link
    },
    computed: {
        cssProps() {
            return {
                '--primary': this.$page.props.settings.primaryColor,
                '--secondary': this.$page.props.settings.secondaryColor,
                '--accent': this.$page.props.settings.accentColor,
            }
        }
    }
}
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
         :style="cssProps">
        <div>
            <Link href="/">
                <ApplicationLogo class="text-8xl fill-current text-gray-500"/>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot/>
        </div>
    </div>
</template>

<style>
:root {
    --primary: var(--primary);
    --secondary: var(--secondary);
    --accent: var(--accent);
}
</style>
