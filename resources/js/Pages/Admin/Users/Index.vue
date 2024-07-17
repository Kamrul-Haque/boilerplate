<script setup>
import DataTable from "@/Components/DataTable.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import {ref} from "vue";
import Admin from "@/Layouts/Admin.vue";
import ModalConfirm from "@/Components/ModalConfirm.vue";

const props = defineProps(['users', 'filters']);

const headers = [
    {text: 'image', value: 'image'},
    {text: 'name', value: 'name', sortable: true},
    {text: 'email', value: 'email', sortable: true},
    {text: 'role', value: 'role', sortable: true},
];

let itemId = ref(null);

function deleteItem() {
    router.delete(route('admin.users.destroy', itemId.value), {preserveState: false});
    itemId = null;
}
</script>

<template>
    <Head title="Users"/>

    <Admin>
        <DataTable :headers="headers"
                   :items="users"
                   :filters="filters"
                   caption="Users"
                   :index-route="route('admin.users.index')"
                   :create-route="route('admin.users.create')">

            <template v-slot:image="slotProp">
                <img v-if="slotProp.item.image"
                     :src="slotProp.item.image"
                     class="h-[35px] w-auto"
                     :alt="slotProp.item.name">
                <span v-else
                      class="text-gray-500">Blank</span>
            </template>

            <template v-slot:role="slotProp">
                <span class="border border-accent text-accent text-sm rounded-full px-2 py-1 capitalize font-semibold">
                    {{ slotProp.item.role_name }}
                </span>
            </template>

            <template v-slot:default="slotProp">
                <div v-if="!slotProp.item.deleted_at"
                     class="flex items-center space-x-2">
                    <Link :href="route('admin.users.show', slotProp.item)"
                          class="text-accent">
                        <i class="mdi mdi-eye"></i>
                    </Link>
                    <Link :href="route('admin.users.edit', slotProp.item)"
                          class="text-primary">
                        <i class="mdi mdi-pencil"></i>
                    </Link>
                    <Link :href="route('admin.users.deactivate', slotProp.item)"
                          method="delete"
                          as="button"
                          preserve-state
                          replace
                          class="text-error">
                        <i class="mdi mdi-circle-off-outline"></i>
                    </Link>
                </div>
                <div v-else
                     class="flex items-center space-x-2">
                    <Link :href="route('admin.users.restore', slotProp.item)"
                          method="put"
                          as="button"
                          preserve-state
                          replace
                          class="text-success">
                        <i class="mdi mdi-recycle"></i>
                    </Link>
                    <button @click.prevent="itemId=slotProp.item.id"
                            class="text-error">
                        <i class="mdi mdi-delete"></i>
                    </button>
                </div>
            </template>
        </DataTable>

        <ModalConfirm :show="!!itemId"
                      @cancel="itemId=null"
                      @confirm="deleteItem"/>
    </Admin>
</template>
