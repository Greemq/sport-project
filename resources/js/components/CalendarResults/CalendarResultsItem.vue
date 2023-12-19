<template>
    <div class="p-4 sm:ml-64 ">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700" v-if="item">
            <div class="sm:w-full md:w-full lg:w-1/2">

                <ui-input class="" v-model="item.title" :error="errors.title" :disabled="loading" label="Заголовок"
                          placeholder="Заголовок"/>
                <ui-file-upload />


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
import UiFileUpload from "@/components/Ui/UiImageUpload.vue";

export default {
    name: "CalendarResultsItem",
    components: {UiFileUpload, UiInput},
    data() {
        return {
            item: null,
            loading: false,
            errors: []
        };
    },
    methods: {
        updateItem() {
            this.loading = true;
            this.errors = [];
        },
        saveItem() {
            this.loading = true;
            this.errors = [];
        },
        getItem() {
            requests.getCalendarResultsItem(this.$route.params.id).then(res => {
                this.item = res;
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
