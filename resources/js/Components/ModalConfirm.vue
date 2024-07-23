<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import DarkButton from "@/Components/DarkButton.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    show: {
        type: Boolean,
        required: true,
        default: false
    }
})

defineEmits(['cancel', 'confirm'])
</script>

<template>
    <Modal max-width="md"
           :show="show">
        <div class="card">
            <div class="card-body">
                <div class="flex justify-center">
                    <div class="block">
                        <div class="mb-4">
                            <h4 v-if="!$slots.default"
                                class="text-lg text-gray-700 font-semibold">
                                Do you really want to delete this record?
                            </h4>
                            <h4 v-else>
                                <slot/>
                            </h4>
                        </div>
                        <div>
                            <p class="text-gray-700">
                                <slot name="body"/>
                            </p>
                        </div>
                        <div class="text-right mt-8">
                            <DarkButton @click="$emit('cancel')"
                                        class="mr-1">
                                <i class="mdi mdi-close-circle mr-2"></i>
                                Cancel
                            </DarkButton>
                            <DangerButton type="button"
                                          @click="$emit('confirm')">
                                <i class="mdi mdi-check-circle mr-2"></i>
                                Confirm
                            </DangerButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
