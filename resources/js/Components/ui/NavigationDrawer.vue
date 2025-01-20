<script setup>
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import {Link, usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import DangerButton from "@/Components/DangerButton.vue";

const showCategories = ref(false);
</script>

<template>
    <div class="block fixed bg-white w-full right-0 shadow-sm h-full z-50 transition-transform duration-300 ease-in-out">
        <!--Responsive Settings Options-->
        <div class="pb-1 border-t border-gray-200 px-4 max-h-[calc(100%-100px)] overflow-y-auto overflow-x-hidden">
            <template v-if="showCategories">
                <button type="button"
                        @click="showCategories=false"
                        class="block w-full bg-gray-100 rounded-md my-2 p-2 text-left text-base text-gray-700 font-semibold hover:text-primary focus:outline-none focus:text-primary transition ease-in-out duration-300">
                    <i class="mdi mdi-chevron-left mr-1"></i>
                    Categories
                </button>
                <div class="space-y-2">
                    <Link v-for="category in usePage().props.data.categories"
                          :key="category.id"
                          class="text-gray-700 block hover:text-primary"
                          :href="route('courses.index', {categories: category.slug})">
                        {{ category.name }}
                    </Link>
                </div>
            </template>
            <template v-else>
                <button type="button"
                        @click="showCategories=true"
                        class="block w-full pt-2 text-left text-base font-medium text-gray-800 hover:text-primary focus:outline-none focus:text-primary transition ease-in-out duration-300">
                    Categories
                    <i class="mdi mdi-chevron-right"></i>
                </button>
                <ResponsiveNavLink :href="route('courses.index')">
                    All Courses
                </ResponsiveNavLink>

                <template v-if="usePage().props.auth.user">
                    <ResponsiveNavLink href="#"
                                       v-if="usePage().props.auth.user.role.value === 3">
                        Create Course
                    </ResponsiveNavLink>

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
                    <ResponsiveNavLink href="#">
                        Become Instructor
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('login')"
                                       :active="route().current('login')">Login
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('register')"
                                       :active="route().current('register')">
                        Register
                    </ResponsiveNavLink>
                </template>
            </template>
        </div>
    </div>
</template>
