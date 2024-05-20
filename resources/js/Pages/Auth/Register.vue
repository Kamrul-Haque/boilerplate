<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextField from '@/Components/TextField.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register"/>

        <form @submit.prevent="submit">
            <TextField v-model="form.name"
                       :error="form.errors.name"
                       required
                       label="Name"/>

            <TextField type="email"
                       label="Email"
                       v-model="form.email"
                       :error="form.errors.email"
                       required/>

            <TextField type="password"
                       label="Password"
                       v-model="form.password"
                       :error="form.errors.password"
                       required/>

            <TextField type="password"
                       label="Confirm Password"
                       v-model="form.password_confirmation"
                       :error="form.errors.password_confirmation"
                       required/>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4"
                               :class="{ 'opacity-25': form.processing }"
                               :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
