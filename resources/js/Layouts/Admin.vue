<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import SideBarLinks from "@/Components/SideBarLinks.vue";
import FlashMessage from "@/Components/FlashMessage.vue";
import {computed, ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const page = usePage();
let showSideBar = ref(screen.width >= 640)
const cssProps = computed(() => {
    return {
        '--primary': page.props.settings.primaryColor,
        '--secondary': page.props.settings.secondaryColor,
        '--accent': page.props.settings.accentColor,
        '--background': page.props.settings.backgroundColor,
        '--table-stripe-color': page.props.settings.tableStripeColor,
    }
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
        <header class="header"
                :class="[showSideBar ? 'md:ml-[264px] md:w-[calc(100%-264px)]' : 'md:ml-[82px] md:w-[calc(100%-82px)]']">
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
        <div class="content"
             :class="[showSideBar ? 'md:pl-[256px]' : 'md:pl-[74px]']">
            <main class="main">
                <div class="container">
                    <FlashMessage/>

                    <slot/>
                </div>
            </main>
        </div>
        <footer class="footer"
                :class="[showSideBar ? 'pl-64' : 'pl-0 md:pl-[74px]']">
            {{ page.props.settings.copyright_text }}
            Developed by
            <a href="https://www.linkedin.com/in/utchas/"
               target="_blank"
               class="text-accent hover:text-blue-900">
                Kamrul Haque
            </a>
        </footer>
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
    max-width: 150px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
