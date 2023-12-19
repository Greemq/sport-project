<template>
    <div class="mt-3">
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
               v-if="label">{{ label }}</label>
        <select id="countries" :disabled="disabled" @change="handleChange" :value="modelValue"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected disabled :value="null">Выберите</option>
            <option :value="option.value" v-for="option in options" :key="'option_'+option.value">{{ option.label }}
            </option>

        </select>
    </div>
</template>

<script>
export default {
    name: "UiSelect",
    props: {
        options: {
            default: []
        },
        label: {},
        disabled: {
            default: false
        },
        modelValue: {}
    },
    data() {
        return {};
    },
    methods: {
        handleChange(e) {
            this.$emit('update:modelValue', e.target.value);
        }
    }


};
</script>

<style scoped>

</style>
