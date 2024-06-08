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
    <div id="app">
        <file-pond
            name="test"
            ref="pond"
            class-name="my-pond"
            label-idle="Drop files here..."
            allow-multiple="true"
            accepted-file-types="image/jpeg, image/png"
            v-bind:files="files"
            v-on:init="handleFilePondInit"
            :credits="false"
        />
    </div>
</template>
