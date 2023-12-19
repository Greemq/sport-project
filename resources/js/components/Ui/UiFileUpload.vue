<template>
    <div class="mt-3">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input" >Выбрать
            файл</label>
        <button type="button" @click="$refs.file_input.click()" :disabled="disabled"
                :class="{'cursor-not-allowed':disabled,'dark:border-red-500 dark:text-red-500':error,'dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800':!error}"
                class="mt-3 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
            Загрузить файл
        </button>
        <button type="button" :disabled="disabled||!file"
                class="ml-2 mt-3 px-3 py-2 text-sm font-medium text-center rounded-lg "
                @click="showFile"
                :class="{'cursor-not-allowed':disabled||!file,' text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800':file,'border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center':!file}"
        >
            Открыть файл
        </button>

        <input type="file" class="hidden" ref="file_input" @change="handleChange">
    </div>

</template>

<script>
export default {
    name: "UiFileUpload",
    props: {
        disabled: {
            default: false
        },
        file: {
            default: ''
        },
        error: {
            default: false
        }

    },
    methods: {
        handleChange(e) {
            this.$emit('fileUpload', e.target.files[0]);
        },
        showFile() {

            window.open(window.location.origin + this.file, '_blank');
        }
    },

};
</script>

<style scoped>

</style>
