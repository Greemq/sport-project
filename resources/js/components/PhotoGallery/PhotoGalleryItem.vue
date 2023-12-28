<template>
    <div class="p-4 sm:ml-64 ">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700" v-if="item">
            <div class="sm:w-full md:w-full lg:w-1/2">

                <ui-image-upload @fileUpload="setFile" v-model="item.path" :error="errors.path" :disabled="loading"/>


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
import requests from "@/api/requests.js";
import UiImageUpload from "@/components/Ui/UiImageUpload.vue";

export default {
    name: "NewsItem",
    components: {UiImageUpload},
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
            formData.append('type', 'gallery');

            requests.fileUpload(formData).then(res => {
                this.item.path = res;
                this.loading = false;
            }).catch(err => {
                this.loading = false;
            });
        },
        saveItem() {
            this.errors = [];
            this.loading = true;
            requests.createGalleryItem(this.item).then(res => {
                this.loading = false;
                this.$router.push({name: 'photo_gallery_item', params: {id: res.id}});
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.errors;
            });
        },
        updateItem() {
            this.errors = [];
            this.loading = true;
            requests.updateGalleryItem(this.$route.params.id, this.item).then(res => {
                this.loading = false;
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.errors;
            });
        },
        getItem() {
            requests.getGalleryItem(this.$route.params.id).then(res => {
                this.item = res;
            });
        }

    },
    computed: {
        newItem() {
            return {
                path: null,
            };
        },
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
