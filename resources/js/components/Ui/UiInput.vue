<template>
    <div class="mt-3">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white "
               v-if="label" :class="{'text-red-800 dark:text-red-400':error}">{{ label }}</label>
        <input :type="type" :name="label" :placeholder="placeholder"
               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               :class="{'text-red-800 border border-red-300 dark:text-red-400 dark:border-red-400 dark:placeholder-red-500':error}"
               :disabled="disabled"
               :value="modelValue"
               @input="$emit('update:modelValue',$event.target.value)"
               required="">
    </div>
</template>
<script setup>

defineProps({
    type: {
        default: 'text'
    },
    error: {
        default: false,

    },
    placeholder: {},
    disabled: {
        default: false
    },
    label: {},
    modelValue: [String,Number],

});
defineEmits(['update:modelValue']);
</script>
<style scoped>

</style>
