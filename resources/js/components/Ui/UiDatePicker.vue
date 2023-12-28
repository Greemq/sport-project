<template>
    <div class="mt-3">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white "
               v-if="label" :class="{'text-red-800 dark:text-red-400':error}">{{ label }}</label>
        <vue-date-picker :modelValue="modelValue" class="date_time rounded-lg border-2"
                         :class="{'text-red-800 border-2 border-red-300 dark:text-red-400 dark:border-red-400 dark:placeholder-red-500':error}"
                         :year-picker="year_picker"
                         @update:model-value="handleChange" cancel-text="Закрыть" select-text="Выбрать" locale="ru-Ru"
                         :enableTimePicker="timePicker"/>
    </div>

</template>

<script>
import VueDatePicker from "@vuepic/vue-datepicker";

export default {
    name: "UiDatePicker",
    components: {VueDatePicker},
    props: {
        date: {},
        label: {},
        year_picker: {
            default: false
        },
        min_year: {},
        modelValue: null,
        error: {
            default: false
        },
        timePicker: {
            default: true
        }
    },
    methods: {
        handleChange(e) {
            this.$emit('update:modelValue', e);
        }
    }
};
</script>

<style>
.date_time input {
    background-color: #374151;
    color: #7b9eac
}
</style>
