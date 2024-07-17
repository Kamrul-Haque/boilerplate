<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextField from '@/Components/TextField.vue';
import {Head} from '@inertiajs/vue3';
import {useForm} from 'laravel-precognition-vue-inertia'
import Auth from "@/Layouts/Auth.vue";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm('post', route('password.store'), {
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.submit({
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Auth>
        <Head title="Reset Password"/>

        <div class="card mx-auto w-full md:w-1/3">
            <h1 class="card-header">Reset Password</h1>
            <div class="card-body">
                <form @submit.prevent="submit">
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

                    <div class="mt-4">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing"
                                       block>
                            Reset Password
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </Auth>
</template>
