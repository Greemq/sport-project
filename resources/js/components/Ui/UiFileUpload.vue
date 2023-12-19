<template>
    <div class="mt-3">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="file_input" type="file" @change="handleChange">
    </div>

</template>

<script>
export default {
    name: "UiFileUpload",
    methods: {
        handleChange(e) {
            this.$emit('fileUpload', e.target.files[0]);
        }
    }

};
</script>

<style scoped>

</style>
