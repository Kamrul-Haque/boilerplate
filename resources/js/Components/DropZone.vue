<script setup>
// Import FilePond
import vueFilePond from 'vue-filepond';

// Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Import styles
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import {reactive, ref} from "vue";

// Create FilePond component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginImageCrop
);

const props = defineProps({
    label: String,
    required: Boolean,
    allowPreview: {
        type: Boolean,
        default: true
    },
    allowMultiple: Boolean,
    maximumFiles: Number,
    error: String,
    fileTypes: {
        type: String,
        default: 'image/jpg, image/jpeg, image/png'
    },
    previousFiles: {
        type: Array,
        default: null
    },
    mandatoryFieldSign: Boolean
})

let files = reactive([]);
const emit = defineEmits(["files"]);

const pond = ref(null);

function handleFilePondInit() {
    // console.log('FilePond has initialized');

    // example of instance method call on pond reference
    // pond.value.getFiles();
}

function update(pondFiles) {
    files = pondFiles.map(file => file.file)

    props.allowMultiple === false
        ? emit("files", files[0])
        : emit("files", files);
}
</script>

<template>
    <div class="my-4"
         id="app">
        <label v-if="label"
               class="label capitalize">
            {{ label }}
            <span v-if="required"
                  class="text-error text-sm">*</span>
        </label>
        <file-pond
            name="test"
            ref="pond"
            class="mb-0 pb-0"
            class-name="my-pond"
            label-idle='Drag & Drop your files or <span class="filepond--label-action"> Browse </span>'
            :allow-multiple="allowMultiple"
            :maxFiles="maximumFiles"
            :accepted-file-types="fileTypes"
            :files="files"
            :allowImagePreview="allowPreview"
            imagePreviewHeight="150"
            imagePreviewWidth="150"
            instant-upload="false"
            :credits="''"
            @init="handleFilePondInit"
            @updatefiles="update"
        />
    </div>
</template>

<style>
.filepond--root .filepond--drop-label {
    border: 2px dashed rgb(229 231 235) !important;
    border-radius: 0.375rem !important;
    background-color: rgb(249 250 251) !important;
    font-weight: bold !important;
    color: rgb(107 114 128) !important;
}

.filepond--root .filepond--drop-label:hover {
    background-color: rgb(244, 244, 244) !important;
}
</style>
