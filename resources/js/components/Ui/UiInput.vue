<template>
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
               v-if="label" :class="{'text-red-700 dark:text-red-500':error}">{{ label }}</label>
        <input :type="type" :name="password" :placeholder="placeholder"
               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               :class="{'text-red-900 placeholder-red-700':error}"
               @input="handleInput"
               @blur="handleBlur"
               :disabled="disabled"
               required="">
    </div>
</template>

<script>
export default {
    name: "UiInput",
    props: {
        type: {
            default: 'text',
        },
        label: {},
        placeholder: {
            required: true
        },
        error: {
            default: false,
            type: [Boolean]
        },
        value: {
            default: null
        },
        disabled: {
            default: false
        }
    },
    methods: {
        handleInput($event) {
            this.$emit('input', $event.target.value);
        },
        handleBlur($event) {
            this.$emit('blur', $event);
        },
    }
};
</script>

<style scoped>

</style>
