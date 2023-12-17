<template>
    <div class="p-4 sm:ml-64 ">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700" v-if="item">
            <div class="sm:w-full md:w-full lg:w-1/2">
                <ui-input class="" v-model="item.title" :error="errors.title" :disabled="loading" label="Заголовок"
                          placeholder="Заголовок"/>
                <ui-file-upload @fileUpload="setFile" v-model="item.img" :error="errors.img" :disabled="loading"/>
                <div class="mt-3">
                    <label class="relative inline-flex items-center cursor-pointer mb-5">
                        <input type="checkbox" v-model="item.is_published" class="sr-only peer" :disabled="loading">
                        <div
                            class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ toggleText }}</span>
                    </label>
                </div>
                <!--            <ui-date-picker/>-->
                <ui-text-area v-model="item.description" placeholder="Описание" label="Описание"
                              :error="errors.description"/>

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
import UiTextArea from "@/components/Ui/UiTextArea.vue";

export default {
    name: "NewsItem",
    components: {UiTextArea, UiDatePicker, UiFileUpload, UiInput},
    data() {
        return {
            item: null,
            errors: [],
            loading: false
        };
    },
    methods: {
        setFile(file) {
            this.loading = true;
            let formData = new FormData();
            formData.append('file', file);
            formData.append('type', 'news');

            requests.fileUpload(formData).then(res => {
                this.item.img = res;
                this.loading = false;
            }).catch(err => {
                this.loading = false;
            });
        },
        saveItem() {
            this.errors = [];
            this.loading = true;
            requests.createNewsItem(this.item).then(res => {
                this.loading = false;
                this.$router.push({name: 'news_item', params: {id: res.id}});
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.errors;
            });
        },
        updateItem() {
            this.errors = [];
            this.loading = true;
            requests.updateNewsItem(this.$route.params.id, this.item).then(res => {
                this.loading = false;
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.errors;
            });
        },
        getItem() {
            requests.getNewsItem(this.$route.params.id).then(res => {
                this.item = res;
            });
        }

    },
    computed: {
        newItem() {
            return {
                title: null,
                description: null,
                img: null,
                is_published: false,
                publish_date: null
            };
        },
        toggleText() {
            return this.item.is_published ? 'Опубликован' : 'Не опубликован';
        }
    },
    mounted() {
        if (this.$route.params.id)
            this.getItem();
        else
            this.item = JSON.parse(JSON.stringify(this.newItem));
    }


};
</script>

<style scoped>

</style>
