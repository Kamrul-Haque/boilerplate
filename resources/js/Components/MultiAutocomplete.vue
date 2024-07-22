<script setup>
import {computed, nextTick, onMounted, onUnmounted, ref, watch} from "vue";

const props = defineProps({
    modelValue: {
        type: Array,
        required: false,
        default: () => []
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
    rounded: Boolean,
    height: {
        type: [String, Number],
    },
    clearable: {
        type: Boolean,
        default: false
    }
});

const query = ref('');
const focused = ref(false);
const highlightedIndex = ref(-1);
const preventBlur = ref(false);
const selectedItems = ref([]);
const selectedItemValues = ref([]);

const filteredSuggestions = computed(() => {
    const items = Array.isArray(props.items) ? props.items : [];
    const queryString = typeof query.value === 'string' ? query.value.toLowerCase() : '';

    if (typeof items[0] === 'object') {
        return items.filter(item => {
            if (item !== null && item.hasOwnProperty(props.itemLabel)) {
                return item[props.itemLabel].toLowerCase().includes(queryString);
            }
        });
    } else {
        return items.filter(item => {
            return item.toLowerCase().includes(queryString);
        });
    }
});

function updateQuery() {
    query.value = '';
}

const emit = defineEmits(['update:modelValue']);

function toggleItem(suggestion) {
    const index = selectedItems.value.indexOf(suggestion);

    if (index === -1) {
        selectedItems.value.push(suggestion);
    } else {
        selectedItems.value.splice(index, 1);
    }

    selectedItemValues.value = selectedItems.value.map(item => typeof item === 'object' ? item[props.itemValue] : item);

    emit('update:modelValue', selectedItemValues.value);

    updateQuery();
}

function clearSelection() {
    query.value = '';
    selectedItems.value = [];
    emit('update:modelValue', selectedItems.value);
}

watch(query, () => {
    if (query.value === '') {
        input.value.focus();
    }
});

function handleKeyDown(event) {
    if (event.key === 'ArrowDown') {
        event.preventDefault();
        if (highlightedIndex.value < filteredSuggestions.value.length - 1) {
            highlightedIndex.value++;
        } else {
            highlightedIndex.value = 0;
        }
        nextTick(() => {
            scrollToHighlightedItem();
        });
    } else if (event.key === 'ArrowUp') {
        event.preventDefault();
        if (highlightedIndex.value > 0) {
            highlightedIndex.value--;
        } else {
            highlightedIndex.value = filteredSuggestions.value.length - 1;
        }
        nextTick(() => {
            scrollToHighlightedItem();
        });
    } else if (event.key === 'Enter' && highlightedIndex.value !== -1) {
        event.preventDefault();
        toggleItem(filteredSuggestions.value[highlightedIndex.value]);
    } else if (event.key === 'Escape') {
        focused.value = false;
        highlightedIndex.value = -1;
    }
}

function scrollToHighlightedItem() {
    const list = suggestionList.value;
    const item = list.children[highlightedIndex.value];
    if (item) {
        const itemTop = item.offsetTop;
        const itemBottom = itemTop + item.offsetHeight;
        const listTop = list.scrollTop;
        const listBottom = listTop + list.clientHeight;

        if (itemTop < listTop) {
            list.scrollTop = itemTop;
        } else if (itemBottom > listBottom) {
            list.scrollTop = itemBottom - list.clientHeight;
        }
    }
}

function handleBlur(event) {
    if (!preventBlur.value && !input.value.contains(event.target) && !(suggestionList.value && suggestionList.value.contains(event.target))) {
        focused.value = false;
    }
}

const input = ref(null);
const suggestionList = ref(null);

onMounted(() => {
    document.addEventListener('click', handleGlobalClick);

    if (props.modelValue.length) {
        if (typeof props.items[0] === 'object') {
            props.items.map(item => {
                if (props.modelValue.includes(item[props.itemValue])) {
                    selectedItems.value.push(item);
                    selectedItemValues.value.push(item[props.itemValue]);
                }
            });
        } else {
            props.items.map(item => {
                if (props.modelValue.includes(item)) {
                    selectedItems.value.push(item);
                    selectedItemValues.value.push(item);
                }
            });
        }
    }

    console.log(selectedItems.value)

    updateQuery();
});

function handleGlobalClick(event) {
    if (!input.value.contains(event.target) && !(suggestionList.value && suggestionList.value.contains(event.target))) {
        focused.value = false;
    }
}

const dropdownPosition = ref('bottom-0');
const autocompleteContainer = ref(null);

const checkDropdownPosition = () => {
    const inputRect = autocompleteContainer.value.getBoundingClientRect();
    const windowHeight = window.innerHeight;
    const spaceBelow = windowHeight - inputRect.bottom;
    const dropdownHeight = 200;

    focused.value = true;
    dropdownPosition.value = spaceBelow >= dropdownHeight ? 'top-full mt-1' : 'bottom-full mb-1';
};

onUnmounted(() => {
    document.removeEventListener('click', handleGlobalClick);
    window.removeEventListener('resize', checkDropdownPosition);
});
</script>

<template>
    <div class="my-4">
        <label v-if="label"
               class="label capitalize">
            {{ label }}
            <span v-if="required"
                  class="text-error text-sm">*</span>
        </label>
        <div class="py-1 border-2 border-dashed border-gray-200 rounded-t">
            <template v-if="selectedItems.length">
                <div class="flex flex-wrap gap-1">
                    <p v-for="(item, index) in selectedItems"
                       :key="index"
                       class="text-sm px-2 py-1 rounded-full bg-gray-200 text-gray-700">
                        {{ typeof item === 'object' ? item[itemLabel] : item }}
                    </p>
                </div>
            </template>
            <template v-else>
                <div class="flex justify-center items-center my-1">
                    <p class="text-gray-700 text-sm">No Item Selected.</p>
                </div>
            </template>
        </div>
        <div class="relative">
            <div v-if="prependIcon"
                 class="absolute flex items-center text-xl text-gray-800 left-0 ml-3 inset-y-0">
                <i :class="prependIcon"></i>
            </div>
            <div class="relative w-full"
                 ref="autocompleteContainer"
                 @focus="focused">
                <input class="input"
                       :class="[error ? 'border-error' : 'border-gray-200', prependIcon ? 'pl-9' : '', rounded ? 'rounded-full' : 'rounded-md', height ? `h-${height}` : '']"
                       v-model="query"
                       type="text"
                       :placeholder="[placeholder || 'Please Select...']"
                       :required="required ? !selectedItems.length : false"
                       :autofocus="autofocus"
                       autocomplete="off"
                       @keydown="handleKeyDown"
                       @focus="checkDropdownPosition"
                       @blur="handleBlur"
                       ref="input"/>
                <transition name="fade">
                    <ul v-show="filteredSuggestions.length && focused"
                        class="absolute w-full bg-white border rounded mt-1 p-1 max-h-48 overflow-y-auto z-10"
                        :class="dropdownPosition"
                        ref="suggestionList">
                        <li v-for="(suggestion, index) in filteredSuggestions"
                            :key="index"
                            @click="toggleItem(suggestion)"
                            class="p-2 cursor-pointer rounded flex items-center">
                            <input type="checkbox"
                                   :checked="selectedItemValues.includes(typeof suggestion === 'object' ? suggestion[itemValue] : suggestion)"
                                   class="mr-2">
                            {{ typeof suggestion === 'object' ? suggestion[itemLabel] : suggestion }}
                        </li>
                    </ul>
                </transition>
            </div>
            <div v-if="query && clearable"
                 class="absolute flex items-center text-xl text-primary right-0 mr-8 inset-y-0"
                 @click="clearSelection">
                <i class="mdi mdi-close"></i>
            </div>
            <div class="absolute flex items-center text-xl text-gray-500 right-0 mr-3 inset-y-0">
                <i :class="[filteredSuggestions.length && focused ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down']"></i>
            </div>
        </div>
        <span v-if="error"
              class="validation-error">
            {{ error }}
        </span>
    </div>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}

.fade-enter-to, .fade-leave-from {
    opacity: 1;
}
</style>
