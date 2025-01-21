<script setup>
import {ref, watch} from 'vue';
import {usePage} from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import DarkButton from "@/Components/DarkButton.vue";
import NavigationDrawer from "@/Components/ui/NavigationDrawer.vue";
import SearchDrawer from "@/Components/ui/SearchDrawer.vue";

const page = usePage();

const showNavigationDrawer = ref(false);
const showSearchDrawer = ref(false);

watch(showNavigationDrawer, (value) => {
    if (value)
        document.body.classList.add("no-scroll");
    else
        document.body.classList.remove("no-scroll");
});
</script>

<template>
    <header class="bg-white fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <ApplicationLogo class="text-4xl"
                                 clickable/>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-4">
                <!---->
            </div>

            <!-- Search Input -->
            <!--            <div class="hidden md:flex flex-grow mx-4">
                            <SearchBox/>
                        </div>-->

            <!-- Menu button for small screens -->
            <div class="py-3 md:hidden space-x-2">
                <button @click="showSearchDrawer = !showSearchDrawer"
                        class="inline-flex items-center justify-center text-gray-700 focus:outline-none transition duration-150 ease-in-out text-base">
                    <i v-if="showSearchDrawer"
                       class="mdi mdi-close text-xl"></i>
                    <i v-else
                       class="mdi mdi-magnify text-xl"></i>
                </button>
                <button @click="showNavigationDrawer = !showNavigationDrawer"
                        class="inline-flex items-center justify-center p-2 rounded bg-gray-100 text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                    <i v-if="showNavigationDrawer"
                       class="mdi mdi-close"></i>
                    <i v-else
                       class="mdi mdi-menu"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav id="menu"
                 class="hidden md:flex items-center">
                <template v-if="page.props.auth.user">
                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <Dropdown align="right"
                                  width="48">
                            <template #trigger>
                                <button type="button"
                                        class="inline-flex text-nowrap items-center font-semibold text-gray-700 hover:text-primary focus:outline-none focus:text-primary transition ease-in-out duration-150">
                                    {{ page.props.auth.user.name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4"
                                         xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    <i class="mdi mdi-account"></i>
                                    Profile
                                </DropdownLink>
                                <DropdownLink :href="route('logout')"
                                              method="post"
                                              as="button">
                                    <i class="mdi mdi-power"></i>
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </template>
                <template v-else>
                    <NavLink :href="route('login')"
                             :active="route().current('login')"
                             class="border-transparent">
                        Login
                    </NavLink>
                    <DarkButton :href="route('register')"
                                :active="route().current('register')"
                                class="bg-transparent capitalize hover:text-primary hover:bg-transparent hover:border-primary focus:ring-0"
                                :class="[route().current('register') ? 'text-primary border-primary' : 'text-gray-700 border-gray-700']">
                        Register
                    </DarkButton>
                </template>
            </nav>
        </div>

        <!-- Mobile Navigation -->
        <NavigationDrawer :class="[showNavigationDrawer ? 'translate-x-0' : 'translate-x-full']"/>
        <!-- Mobile Search Drawer -->
        <SearchDrawer :class="[showSearchDrawer ? 'translate-y-0' : 'translate-y-full']"/>
    </header>
</template>

<style>
body.no-scroll {
    overflow-y: hidden !important;
}
</style>
