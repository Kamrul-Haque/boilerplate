<script setup>
// Import FilePond
import vueFilePond from 'vue-filepond';

// Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Import styles
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import {reactive} from "vue";

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);


const files = reactive([]);

function handleFilePondInit() {
    console.log('FilePond has initialized');

    // example of instance method call on pond reference
    this.$refs.pond.getFiles();
}
</script>

<template>
    <div class="mt-8 mb-4"
         id="app">
        <file-pond
            name="test"
            ref="pond"
            class-name="my-pond"
            label-idle="Click to Upload or Drag & Drop"
            allow-multiple="true"
            accepted-file-types="image/jpeg, image/png"
            v-bind:files="files"
            v-on:init="handleFilePondInit"
            :credits="''"
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
    background-color: white !important;
}
</style>
