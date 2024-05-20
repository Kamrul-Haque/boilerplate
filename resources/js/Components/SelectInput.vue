<script>
export default {
    props: {
        modelValue: {type: [String, Number, Object]},
        items: {type: Array, required: true},
        itemLabel: String,
        itemValue: String,
        required: Boolean,
        label: String,
        placeholder: String,
        error: String,
        prependIcon: String,
        height: {
            type: [String, Number],
        },
    },
    mounted() {
        if (this.$refs.input.hasAttribute('autofocus')) {
            this.$refs.input.focus();
        }
    },
    emits: ['update:modelValue']
}
</script>

<template>
    <div class="my-4">
        <label v-if="label"
               class="label">
            {{ label }}
            <span v-if="required"
                  class="text-error text-sm">*</span>
        </label>
        <select class="input capitalize"
                :class="[error ? 'border-error' : 'border-gray-300', prependIcon ? 'pl-9' : '', height ? `h-${height}` : '']"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                :required="required"
                ref="input">
            <option v-if="placeholder"
                    :value="''">{{ placeholder }}
            </option>
            <option v-for="(item,index) in items"
                    :key="index"
                    :selected="item[itemValue]===modelValue"
                    :value="typeof item === 'object' ? item[itemValue] : item"
                    class="capitalize">
                {{ typeof item === 'object' ? item[itemLabel] : item }}
            </option>
        </select>
        <span v-if="error"
              class="validation-error">
            {{ error }}
        </span>
    </div>
</template>
