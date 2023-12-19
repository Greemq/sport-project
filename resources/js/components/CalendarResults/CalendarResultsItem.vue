<template>
    <div class="p-4 sm:ml-64 ">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700" v-if="item">
            <div class="sm:w-full md:w-full lg:w-1/2">

                <ui-input class="" v-model="item.title" :error="errors.title" :disabled="loading" label="Заголовок"
                          placeholder="Заголовок"/>
                <!--                <ui-file-upload />-->
                <ui-date-picker v-model="item.date_time" label="Дата" :error="errors.date_time"/>
                <ui-file-upload type="file" :file="item.state" :error="errors.state" :disabled="loading"
                                @fileUpload="setFile($event,'state')" key="state" label="Положение"/>
                <ui-file-upload type="file" :file="item.protocol" :error="errors.protocol" key="protocol"
                                abel="Протокол"
                                :disabled="loading"
                                @fileUpload="setFile($event,'protocol')"/>
                <ui-select v-model="item.status" :options="statusOptions" label="Статус" :error="errors.status"/>
                <ui-select v-model="item.type" :options="typeOptions" label="Тип" :error="errors.status"/>
                <ui-input v-model="item.link" label="Ссылка на трансляцию" placegolder="Ссылка"/>

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

import requests from "@/api/requests.js";
import UiFileUpload from "@/components/Ui/UiFileUpload.vue";
import UiDatePicker from "@/components/Ui/UiDatePicker.vue";
import UiSelect from "@/components/Ui/UiSelect.vue";
import dayjs from "dayjs";

export default {
    name: "CalendarResultsItem",
    components: {UiSelect, UiDatePicker, UiFileUpload, UiInput},
    data() {
        return {
            item: null,
            loading: false,
            errors: [],
            statusOptions: [
                {
                    value: 1,
                    label: 'Ожидается'
                },
                {
                    value: 2,
                    label: 'Проходит'
                },
                {
                    value: 3,
                    label: 'Отменен'
                },
                {
                    value: 4,
                    label: 'Завершен'
                },

            ],
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
        updateItem() {
            this.loading = true;
            this.errors = [];
            let form = {
                ...this.item,
                date_time: dayjs(this.item.publish_date).format('YYYY-MM-DD HH:MM:ss')
            };
            requests.updateCalendarResultsItem(this.$route.params.id, form).then(res => {
                this.loading = false;
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.errors;
            });
        },
        saveItem() {
            this.loading = true;
            this.errors = [];
            let form = {
                ...this.item,
                date_time: dayjs(this.item.publish_date).format('YYYY-MM-DD HH:MM:ss')
            };
            requests.createCalendarResultsItem(form).then(res => {
                this.$router.push({name: 'calendar_results_item', params: {id: res.id}});
                this.loading = false;
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.errors;
            });

        },
        getItem() {
            requests.getCalendarResultsItem(this.$route.params.id).then(res => {
                this.item = res;
            });
        },
        setFile(file, key) {
            this.loading = true;
            let formData = new FormData();
            formData.append('file', file);
            formData.append('type', 'calendar-results');

            requests.fileUpload(formData).then(res => {
                this.item[key] = res;
                this.loading = false;
            }).catch(err => {
                this.loading = false;
            });

        }
    },
    computed: {
        newForm() {
            return {
                date_time: null,
                title: null,
                state: null,
                protocol: null,
                status: null,
                link: null,
                type: null
            };
        }
    },
    mounted() {
        if (this.$route.params.id)
            this.getItem();
        else
            this.item = JSON.parse(JSON.stringify(this.newForm));
    }
};
</script>

<style scoped>

</style>
