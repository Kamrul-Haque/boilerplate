<script setup>
import {computed, onMounted, ref} from "vue";

const props = defineProps({
    modelValue: {
        type: [String, Number, Object],
        required: false,
    },
    items: Array,
    itemLabel: String,
    itemValue: String,
    required: Boolean,
    label: String,
    placeholder: String,
    error: String,
    autofocus: Boolean,
    prependIcon: String,
    appendIcon: String,
    rounded: Boolean,
    regex: String,
    height: {
        type: [String, Number],
    }
});

const query = ref('');
const focused = ref(false);
const highlightedIndex = ref(-1);
const preventBlur = ref(false);

const filteredSuggestions = computed(() =>
    props.items.filter(item =>
        typeof item === 'object'
            ? item[props.itemLabel].toLowerCase().includes(query.value.toLowerCase())
            : item.toLowerCase().includes(query.value.toLowerCase())
    )
);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

const emit = defineEmits(['update:modelValue']);

function selectItem(suggestion) {
    preventBlur.value = true;

    if (typeof suggestion === 'object')
        query.value = suggestion[props.itemLabel];
    else
        query.value = suggestion;

    focused.value = false;

    emit('update:modelValue', suggestion[props.itemValue]);
}
</script>

<template>
    <div class="my-4">
        <label v-if="label"
               class="label capitalize">
            {{ label }}
            <span v-if="required"
                  class="text-error text-sm">*</span>
        </label>
        <div class="relative">
            <div v-if="prependIcon"
                 class="absolute flex items-center text-xl text-gray-800 left-0 ml-3 inset-y-0">
                <i :class="prependIcon"></i>
            </div>
            <div class="relative w-full"
                 @focus="focused">
                <input class="input"
                       :class="[error ? 'border-error' : 'border-gray-200', prependIcon ? 'pl-9' : '', rounded ? 'rounded-full' : 'rounded-md', height ? `h-${height}` : '']"
                       v-model="query"
                       type="text"
                       :placeholder="placeholder"
                       :required="required"
                       :autofocus="autofocus"
                       :pattern="regex"
                       autocomplete="off"
                       @focus="focused = true"
                       @blur="() => { if (!preventBlur) focused = false; }"
                       ref="input"/>
                <ul v-show="filteredSuggestions.length && focused"
                    class="absolute w-full bg-white border rounded mt-1 max-h-48 overflow-y-auto">
                    <li v-for="(suggestion, index) in filteredSuggestions"
                        :key="index"
                        @mousedown="selectItem(suggestion)"
                        :class="['p-2 cursor-pointer', highlightedIndex === index ? 'bg-gray-200' : 'hover:bg-gray-200']">
                        {{ typeof suggestion === 'object' ? suggestion[itemLabel] : suggestion }}
                    </li>
                </ul>
            </div>
            <div v-if="appendIcon"
                 class="absolute flex items-center text-xl text-gray-800 right-0 mr-3 inset-y-0">
                <i :class="appendIcon"></i>
            </div>
        </div>
        <span v-if="error"
              class="validation-error">
            {{ error }}
        </span>
    </div>
</template>
