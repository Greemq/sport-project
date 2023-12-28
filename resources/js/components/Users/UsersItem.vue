<template>
    <div class="p-4 sm:ml-64 ">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700" v-if="item">
            <div class="sm:w-full md:w-full lg:w-1/2">
                <ui-input class="" v-model="item.name" :error="errors.name" :disabled="loading" label="Имя" placeholder="Имя"/>
                <ui-input class="" v-model="item.email" :error="errors.email" :disabled="loading" label="Email" placeholder="Email"/>
                <ui-input class="" v-model="item.region" :error="errors.region" :disabled="loading" label="Локация" placeholder="Локация"/>
                <!-- TODO: Role -->
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

export default {
    name: "UsersItem",
    data() {
        return {
            item: null,
            errors: [],
            loading: false
        };
    },
    components: { UiInput },
    methods: {
        saveItem() {
            this.errors = [];
            this.loading = true;
            let form = {
                ...this.item
            };
            requests.createUsersItem(form).then(res => {
                this.loading = false;
                this.$router.push({name: 'users_item', params: {id: res.id}});
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.errors;
            });
        },
        updateItem() {
            this.errors = [];
            this.loading = true;
            let form = {
                ...this.item
            };
            requests.updateUsersItem(this.$route.params.id, form).then(res => {
                this.loading = false;
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.errors;
            });
        },
        getItem() {
            requests.getUsersItem(this.$route.params.id).then(res => {
                this.item = res;
            });
        }
    },
    computed: {
        newItem() {
            return {
                name: null,
                email: null,
                region: null,
                role_id: 1
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
}
</script>