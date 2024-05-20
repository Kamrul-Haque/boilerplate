<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextField from '@/Components/TextField.vue';
import {Head, useForm} from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password"/>

        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form @submit.prevent="submit">
            <TextField type="password"
                       v-model="form.password"
                       label="Password"
                       :error="form.errors.password"
                       required/>

            <div class="flex justify-end mt-4">
                <PrimaryButton class="ml-4"
                               :class="{ 'opacity-25': form.processing }"
                               :disabled="form.processing">
                    Confirm
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
