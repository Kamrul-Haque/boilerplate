<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const page = usePage();
</script>

<template>
    <footer class="bottom-0 w-full bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-8">
                <!-- Logo and Description -->
                <div class="col-span-2">
                    <ApplicationLogo class="text-6xl"/>
                    <p class="mt-4">
                        {{ usePage().props.settings.description }}
                    </p>
                    <div class="flex space-x-3 mt-4">
                        <a href="#"
                           class="text-gray-700"><i class="mdi mdi-facebook"></i></a>
                        <a href="#"
                           class="text-gray-700"><i class="mdi mdi-twitter"></i></a>
                        <a href="#"
                           class="text-gray-700"><i class="mdi mdi-linkedin"></i></a>
                        <a href="#"
                           class="text-gray-700"><i class="mdi mdi-instagram"></i></a>
                        <a href="#"
                           class="text-gray-700"><i class="mdi mdi-youtube"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold">Quick Links</h4>
                    <div class="space-y-2 mt-2">
                        <Link :href="route('login')"
                              class="text-gray-700 block hover:text-primary">Portal Login
                        </Link>
                        <Link href="#"
                              class="text-gray-700 block hover:text-primary">Privacy Policy
                        </Link>
                        <Link href="#"
                              class="text-gray-700 block hover:text-primary">Refund Policy
                        </Link>
                        <Link href="#"
                              class="text-gray-700 block hover:text-primary">Terms & Conditions
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-gray-200"/>
        <div class="text-center bg-white py-4 text-gray-700 font-bold">
            <p>Copyright © 2024 {{ page.props.app.name }}. All Rights Reserved.</p>
        </div>
    </footer>
</template>
