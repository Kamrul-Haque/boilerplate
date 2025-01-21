<script setup>
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import {usePage} from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
</script>

<template>
    <div class="block fixed bg-white w-full right-0 shadow-sm h-full z-50 transition-transform duration-300 ease-in-out">
        <!--Responsive Settings Options-->
        <div class="pb-1 border-t border-gray-200 px-4 max-h-[calc(100%-100px)] overflow-y-auto overflow-x-hidden">
            <template v-if="usePage().props.auth.user">
                <div class="bottom-24 absolute w-full pr-8">
                    <div class="font-medium text-base text-gray-800">
                        {{ usePage().props.auth.user.name }}
                    </div>

                    <ResponsiveNavLink :href="route('profile.edit')">
                        <i class="mdi mdi-account"></i>
                        Profile
                    </ResponsiveNavLink>
                    <DangerButton :href="route('logout')"
                                  method="post"
                                  as="button"
                                  class="mt-4"
                                  block>
                        <i class="mdi mdi-power"></i>
                        Log Out
                    </DangerButton>
                </div>
            </template>
            <template v-else>
                <ResponsiveNavLink :href="route('login')"
                                   :active="route().current('login')">Login
                </ResponsiveNavLink>
                <ResponsiveNavLink :href="route('register')"
                                   :active="route().current('register')">
                    Register
                </ResponsiveNavLink>
            </template>
        </div>
    </div>
</template>
