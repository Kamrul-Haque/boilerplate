<template>
    <Head title="Settings"/>

    <Admin>
        <div class="card w-full md:w-3/4 mx-auto">
            <h1 class="card-header">Create User</h1>
            <div class="card-body">
                <form @submit.prevent="submit()">
                    <TextField v-model="form.name"
                               label="Name"
                               @change="form.validate('name')"
                               :error="form.errors.name"
                               autofocus
                               required/>

                    <TextField v-model="form.email"
                               type="email"
                               label="Email"
                               @change="form.validate('email')"
                               :error="form.errors.email"
                               required/>

                    <TextField v-model="form.phone"
                               label="Phone"
                               @change="form.validate('phone')"
                               :error="form.errors.phone"/>

                    <TextArea v-model="form.address"
                              label="Address"
                              @change="form.validate('address')"
                              :error="form.errors.address"/>

                    <SelectInput v-model="form.role"
                                 :items="roles"
                                 item-label="name"
                                 item-value="value"
                                 @change="form.validate('role')"
                                 label="Roles"
                                 required/>

                    <FileInput v-model="form.image"
                               label="Profile Image"
                               class="col-span-2"
                               @change="form.validate('image')"
                               :error="form.errors.image"/>

                    <div class="text-right mt-8">
                        <PrimaryButton type="submit">Save</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </Admin>
</template>

<script>
import Admin from "@/Layouts/Admin.vue";
import {Head} from "@inertiajs/vue3";
import TextField from "@/Components/TextField.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextArea from "@/Components/TextArea.vue";
import FileInput from "@/Components/FileInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import {useForm} from 'laravel-precognition-vue-inertia';

export default {
    props: ['user'],
    components: {
        SelectInput,
        FileInput,
        TextArea,
        PrimaryButton,
        TextField,
        Head,
        Admin,
    },
    data() {
        return {
            form: useForm('post',
                this.user ? route('users.update', this.user.id) : route('users.store'), {
                    _method: this.user ? 'put' : 'post',
                    name: this.user ? this.user.name : null,
                    email: this.user ? this.user.email : null,
                    phone: this.user ? this.user.phone : null,
                    address: this.user ? this.user.address : null,
                    role: this.user ? this.user.role : null,
                    image: null,
                }),
            roles: this.$page.props.auth.roles,
        }
    },
    methods: {
        submit() {
            this.form.submit({preserveScroll: true})
        },
    }
};
</script>
