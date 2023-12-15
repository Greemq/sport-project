<template>
    <div class="mt-3">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
               :class="{'text-red-800 dark:text-red-400':error}">Фото</label>
        <img v-if="modelValue" class="h-auto rounded-lg" :src="modelValue" alt="image description">
        <img v-else class="h-auto rounded-lg" src="../../assets/img/image_thumb.jpg" alt="image description" :class="{'text-red-800 border border-red-300 dark:text-red-400 dark:border-red-400':error}">
        <input ref="fileInput" id="file_upload" type="file" class="hidden" @change="handleChange">
        <div class="w-full">
            <button type="button" @click="$refs.fileInput.click()" :disabled="disabled"
                    class="w-full mt-3 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Загрузить
            </button>
        </div>
    </div>

</template>

<script>
export default {
    name: "UiFileUpload",

    props: {
        key: {
            default: 'file_upload'
        },
        modelValue: {
            default: null
        },
        error: {
            default: false
        },
        disabled: {
            default: false
        }
    },
    methods: {
        handleChange(e) {
            this.$emit('fileUpload', e.target.files[0]);
        }
    }

};
</script>

<style scoped>

</style>
