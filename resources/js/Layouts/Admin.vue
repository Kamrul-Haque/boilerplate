<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import SideBarLinks from "@/Components/SideBarLinks.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import {computed, onMounted, onUnmounted, ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Avatar from "@/Components/Avatar.vue";

const page = usePage();
let showSideBar = ref(screen.width >= 640)
let hasScrolled = ref(false);
const cssProps = computed(() => {
    return {
        '--primary': page.props.settings.primaryColor,
        '--secondary': page.props.settings.secondaryColor,
        '--accent': page.props.settings.accentColor,
        '--background': page.props.settings.backgroundColor,
        '--table-stripe-color': page.props.settings.tableStripeColor,
    }
})

function handleScroll() {
    hasScrolled.value = window.scrollY > 70;

    console.log(hasScrolled.value)
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
})
</script>

<template>
    <div class="app"
         :style="cssProps">
        <nav :class="[showSideBar ? 'w-64' : 'w-0 md:w-[75px]']"
             class="side-nav">
            <div class="brand">
                <img v-if="page.props.settings.portal_logo"
                     :src="page.props.settings.portal_logo"
                     class="avatar"
                     alt="logo"
                     width="50"
                     height="50"/>

                <ApplicationLogo class="text-2xl text-center"
                                 v-else/>

                <h1 v-if="showSideBar"
                    class="brand-title">
                    {{ page.props.settings.name }}
                </h1>
            </div>
            <div class="overflow-y-auto overflow-x-hidden">
                <SideBarLinks :show-side-bar="showSideBar"/>
            </div>
        </nav>
        <div class="content"
             :class="[showSideBar ? 'md:pl-[256px]' : 'md:pl-[74px]']">
            <header class="header"
                    :class="[showSideBar ? 'md:w-[calc(100%-292px)]' : 'md:w-[calc(100%-110px)]', hasScrolled ? 'shadow-xl' : 'shadow-sm']">
                <div class="nav">
                    <button @click="showSideBar = !showSideBar"
                            class="mx-4 text-lg hover:text-gray-600 active:text-gray-600 transition ease-in-out duration-150">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <img v-if="page.props.settings.portal_logo"
                         :src="page.props.settings.portal_logo"
                         class="avatar md:hidden"
                         alt="logo"
                         width="50"
                         height="50"/>

                    <Dropdown>
                        <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button type="button"
                                    class="header-link">
                                <Avatar :path="page.props.auth.user.image || page.props.app.url + '/images/no-avatar.png'"
                                        class="mr-2"
                                        size="30px"/>
                                {{ page.props.auth.user.name }}
                                <span class="mdi mdi-chevron-down ml-1"></span>
                            </button>
                        </span>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('profile.edit')">
                                <span class="mdi mdi-account"></span>
                                Profile
                            </DropdownLink>

                            <DropdownLink as="Link"
                                          method="post"
                                          :href="route('logout')">
                                <span class="mdi mdi-power"></span>
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </header>

            <main class="main">
                <div class="container">
                    <slot/>
                </div>
            </main>

            <footer class="footer"
                    :class="[showSideBar ? 'md:w-[calc(100%-292px)]' : 'md:w-[calc(100%-110px)]']">
                {{ page.props.settings.copyright_text }}
                Developed by
                <a href="https://www.linkedin.com/in/utchas/"
                   target="_blank"
                   class="text-accent hover:text-blue-900">
                    Kamrul Haque
                </a>
            </footer>

            <FlashMessage/>
        </div>
    </div>
</template>

<style>
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

td {
    min-width: 50px;
    max-width: 150px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
