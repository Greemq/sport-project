<template>
    <div class="p-4 sm:ml-64 ">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700" v-if="item">
            <div class="sm:w-full md:w-full lg:w-1/2">
                <ui-input class="" v-model="item.title" :error="errors.title" :disabled="loading" label="Заголовок"
                          placeholder="Заголовок"/>
                <ui-date-picker year_picker v-model="item.year" label="Год" :disabled="loading"/>
                <ui-select :options="options" label="Тип документа" :disabled="loading" v-model="item.type"/>
                <ui-file-upload :file="item.file" @fileUpload="setFile" :disabled="loading"/>

            </div>
            <div class="mt-3 w-full flex justify-center">
                <button type="button" @click="$route.params.id?updateItem():saveItem()" :disabled="loading"
                        :class="{'cursor-not-allowed':loading}"
                        class="mt-3 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Сохранить
                </button>
            </div>

        </div>
    </div>
</template>

<script>
import UiInput from "@/components/Ui/UiInput.vue";
import UiFileUpload from "@/components/Ui/UiFileUpload.vue";
import requests from "@/api/requests.js";
import UiDatePicker from "@/components/Ui/UiDatePicker.vue";
import UiSelect from "@/components/Ui/UiSelect.vue";

export default {
    name: "FileItem",
    components: {UiSelect, UiDatePicker, UiFileUpload, UiInput},
    data() {
        return {
            item: null,
            errors: [],
            loading: false,
            options: [
                {
                    value: 1,
                    label: 'Нормативные документы'
                },
                {
                    value: 2,
                    label: 'Аналитические отчеты и доклады о проделынной работе'
                },

            ]
        };
    },
    methods: {
        getItem() {
            requests.getFilesItem(this.$route.params.id).then(res => {
                this.item = res;
            });
        },
        updateItem() {
            this.loading = true;
            requests.updateFilesItem(this.$route.params.id, this.item).then(res => {
                this.loading = false;
            }).catch(err => {
                this.errors = err.response.data.errors;
            });
        },
        saveItem() {
            this.loading = true;
            requests.createFilesItem(this.item).then(res => {
                this.loading = false;
                this.$rotuer.push({name: 'files_item', params: {id: res.id}});
            }).catch(err => {
                this.errors = err.response.data.errors;
                this.loading = false;
            });
        },
        setFile(file) {
            this.loading = true;
            let formData = new FormData();
            formData.append('file', file);
            formData.append('type', 'file');

            requests.fileUpload(formData).then(res => {
                this.item.file = res;
                this.loading = false;
            }).catch(err => {
                this.loading = false;
            });
        },
    },
    mounted() {
        if (this.$route.params.id)
            this.getItem();
        else
            this.item = JSON.parse(JSON.stringify({
                title: null,
                file: null,
                type: null,
                year: null
            }));
    }
};
</script>

<style scoped>

</style>
