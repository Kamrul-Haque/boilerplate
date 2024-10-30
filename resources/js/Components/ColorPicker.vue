<script setup>
const props = defineProps({
    modelValue: {
        type: [String, Number, Object],
        required: false,
    },
    required: Boolean,
    label: String,
    error: String,
    rounded: Boolean,
    height: {
        type: [String, Number],
    },
    preset: Boolean,
});

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="my-4">
        <label v-if="label"
               class="label capitalize">
            {{ label }}
            <span v-if="required"
                  class="text-error text-sm">*</span>
        </label>
        <div class="flex items-center">
            <input type="text"
                   :value="modelValue"
                   @input="$emit('update:modelValue', $event.target.value)"
                   class="input rounded-r-none"
                   :class="[error ? 'border-error' : 'border-gray-200', rounded ? 'rounded-full' : 'rounded-md', height ? `h-${height}` : '']"
                   placeholder="#000000"
                   :required="required"/>

            <input type="color"
                   :value="modelValue"
                   @input="$emit('update:modelValue', $event.target.value)"
                   class="cursor-pointer h-[42px] w-24 border-gray-200 rounded-md rounded-l-none"
                   colorpick-eyedropper-active="false"
                   :list="preset ? 'presetColors' : null"/>

            <datalist v-if="preset"
                      id="presetColors">
                <option>#FFFFFF</option>
                <option>#C0C0C0</option>
                <option>#808080</option>
                <option>#000000</option>
                <option>#FF0000</option>
                <option>#DC143C</option>
                <option>#800000</option>
                <option>#FFFF00</option>
                <option>#808000</option>
                <option>#00FF00</option>
                <option>#008000</option>
                <option>#00FFFF</option>
                <option>#008080</option>
                <option>#0000FF</option>
                <option>#000080</option>
                <option>#FF00FF</option>
                <option>#800080</option>
            </datalist>
        </div>
        <span v-if="error"
              class="validation-error">
            {{ error }}
        </span>
    </div>
</template>

<style scoped>
input[type="color"] {
    border-width: 1px;
    border-style: solid;
    border-color: #E5E7EB;
}

::-webkit-color-swatch {
    border-color: #E5E7EB;
}

::-moz-color-swatch {
    border-color: #E5E7EB;
}
</style>
