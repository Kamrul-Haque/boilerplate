<script setup>
import {computed, onMounted, onUnmounted, ref} from 'vue';
import {usePage} from '@inertiajs/vue3';
import FlashMessage from "@/Components/FlashMessage.vue";
import Header from "@/Components/ui/Header.vue";
import Footer from "@/Components/ui/Footer.vue";

const page = usePage();

const cssProps = computed(() => {
    return {
        '--primary': page.props.settings.primaryColor,
        '--secondary': page.props.settings.secondaryColor,
        '--accent': page.props.settings.accentColor,
        '--background': page.props.settings.backgroundColor,
        '--table-stripe-color': page.props.settings.tableStripeColor,
    }
});

const hasScrolled = ref(false);

function handleScroll() {
    hasScrolled.value = window.scrollY > 70;
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <div :style="cssProps">
        <div class="min-h-screen bg-background">
            <Header :class="hasScrolled ? 'shadow-xl' : 'shadow-sm'"/>
            <main class="max-w-7xl my-16 mx-auto py-6 px-4 sm:px-6 lg:px-8"
                  id="main">
                <FlashMessage/>

                <slot/>
            </main>
        </div>
        <Footer/>
    </div>
</template>

<style scoped>
:root {
    --primary: var(--primary);
    --secondary: var(--secondary);
    --accent: var(--accent);
    --background: var(--background);
    --table-stripe-color: var(--table-stripe-color);
}

select option {
    text-transform: capitalize;
}
</style>

