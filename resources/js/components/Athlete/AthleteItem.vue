<template>
    <div class="p-4 sm:ml-64 ">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700" v-if="item">
            <div class="sm:w-full md:w-full lg:w-1/2">

                <ui-input class="" v-model="item.fio" :error="errors.fio" :disabled="loading" label="ФИО"
                          placeholder="ФИО"/>
                <ui-input class="" v-model="item.location" :error="errors.location" :disabled="loading" label="Регион"
                          placeholder="Регион"/>
                <ui-input class="" type="number" v-model="item.personal_id" :error="errors.personal_id"
                          :disabled="loading" label="ID"
                          placeholder="ID"/>
                <ui-input class="" v-model="item.category" :error="errors.category" :disabled="loading"
                          label="Категория"
                          placeholder="Категория"/>
                <ui-select :options="typeOptions" :error="errors.type" label="Тип" v-model="item.type"/>
                <ui-file-upload :file="item.file" :error="errors.file" @fileUpload="setFile" :disabled="loading"/>
                <ui-input class="" v-model="item.class" :error="errors.class" :disabled="loading"
                          label="Класс"
                          placeholder="Класс"/>

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
import UiSelect from "@/components/Ui/UiSelect.vue";
import requests from "@/api/requests.js";
import UiFileUpload from "@/components/Ui/UiFileUpload.vue";

export default {
    name: "AthleteItem",
    components: {UiFileUpload, UiSelect, UiInput},
    data() {
        return {
            item: null,
            loading: false,
            errors: [],
            typeOptions: [
                {
                    value: 1,
                    label: 'Международный'
                },
                {
                    value: 2,
                    label: 'Республиканский'
                },

            ]
        };
    },
    methods: {
        setFile(file) {
            this.loading = true;
            let formData = new FormData();
            formData.append('file', file);
            formData.append('type', 'athlete');

            requests.fileUpload(formData).then(res => {
                this.item.file = res;
                this.loading = false;
            }).catch(err => {
                this.loading = false;
            });
        },
        getItem() {
            this.loading = true;
            requests.getAthleteItem(this.$route.params.id).then(res => {
                this.item = res;
                this.loading = false;
            });
        },
        saveItem() {
            this.loading = true;
            this.errors = [];
            requests.createAthleteItem(this.item).then(res => {
                this.loading = false;
                this.$router.push({name: 'athlete_item', params: {id: res.id}});
            }).catch(err => {
                this.errors = err.response.data.errors;
                this.loading = false;
            });
        },
        updateItem() {
            this.loading = true;
            this.errors = [];
            requests.updateAthleteItem(this.$route.params.id, this.item).then(res => {
                this.loading = false;
            }).catch(err => {
                this.errors = err.response.data.errors;
                this.loading = false;
            });
        }
    },
    mounted() {
        if (this.$route.params.id)
            this.getItem();
        else
            this.item = JSON.parse(JSON.stringify({
                fio: null,
                location: null,
                personal_id: null,
                category: null,
                file: null,
                type: null,
                class: null
            }));
    }
};
</script>

<style scoped>

</style>
