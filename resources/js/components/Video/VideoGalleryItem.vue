<template>
    <div class="p-4 sm:ml-64 ">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700" v-if="item">
            <div class="sm:w-full md:w-full lg:w-1/2">

                <ui-input class="" v-model="item.title" :error="errors.title" :disabled="loading" label="Заголовок"
                          placeholder="Заголовок"/>
                <ui-date-picker label="Дата" v-model="item.date" :disabled="loading" :time-picker="false"/>
                <ui-image-upload @fileUpload="setFile" v-model="item.img" :error="errors.img" :disabled="loading"/>
                <ui-text-area v-model="item.description" placeholder="Описание" label="Описание"
                              :error="errors.description"/>
                <ui-input class="" v-model="item.link" :error="errors.link" :disabled="loading"
                          label="Ссылка на youtube"
                          placeholder="https://www.youtube.com/embed/B5unCXpegAw?si=NDamjyCbhd2nglyO"/>


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
import UiInput from "@/components/Ui/UiInput.vue";
import UiDatePicker from "@/components/Ui/UiDatePicker.vue";
import UiTextArea from "@/components/Ui/UiTextArea.vue";
import UiImageUpload from "@/components/Ui/UiImageUpload.vue";
import dayjs from "dayjs";

export default {
    name: "VideoGalleryItem",
    components: {UiImageUpload, UiTextArea, UiDatePicker, UiInput},
    data() {
        return {
            item: null,
            loading: false,
            errors: []
        };
    },
    methods: {
        getItem() {
            this.loading = true;
            requests.getVideoGalleryItem(this.$route.params.id).then(res => {
                this.item = res;
                this.loading = false;
            });
        },
        saveItem() {
            this.loading = true;
            this.errors = [];
            let form = {
                ...this.item,
                date: this.item.date ? dayjs(this.item.date).format('YYYY-MM-DD') : null
            };
            requests.createVideoGalleryItem(form).then(res => {
                this.loading = false;
                this.$router.push({name: 'video_gallery_item', params: {id: res.id}});
            }).catch(err => {
                this.errors = err.response.data.errors;
                this.loading = false;
            });
        },
        updateItem() {
            this.loading = true;
            this.errors = [];
            let form = {
                ...this.item,
                date: this.item.date ? dayjs(this.item.date).format('YYYY-MM-DD') : null
            };
            requests.updateVideoGalleryItem(this.$route.params.id, form).then(res => {
                this.loading = false;
            }).catch(err => {
                this.errors = err.response.data.errors;
                this.loading = false;
            });
        },
        setFile(file) {
            this.loading = true;
            let formData = new FormData();
            formData.append('file', file);
            formData.append('type', 'video_gallery');

            requests.fileUpload(formData).then(res => {
                this.item.img = res;
                this.loading = false;
            }).catch(err => {
                this.loading = false;
            });
        },
    },
    computed: {
        newForm() {
            return {
                img: null,
                title: null,
                description: null,
                link: null,
                date: null
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
