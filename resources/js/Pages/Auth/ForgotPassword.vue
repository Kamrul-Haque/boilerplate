<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextField from '@/Components/TextField.vue';
import {Head} from '@inertiajs/vue3';
import {useForm} from "laravel-precognition-vue-inertia";
import Auth from "@/Layouts/Auth.vue";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm('post', route('password.email'), {
    email: '',
});

const submit = () => {
    form.submit();
};
</script>

<template>
    <Auth>
        <Head title="Forgot Password"/>

        <div class="card mx-auto w-full md:w-1/3">
            <h1 class="card-header">Forgot Password</h1>
            <div class="card-body">
                <div class="mb-4 text-sm text-gray-600">
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password reset
                    link that will allow you to choose a new one.
                </div>

                <div v-if="status"
                     class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <TextField type="email"
                               label="Email"
                               v-model="form.email"
                               :error="form.errors.email"
                               @change="form.validate('email')"
                               required/>

                    <div class="mt-4">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing"
                                       block>
                            Email Password Reset Link
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </Auth>
</template>
