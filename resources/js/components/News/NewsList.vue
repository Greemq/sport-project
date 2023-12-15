<template>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class=" flex justify-end">
                <button type="button" @click="$router.push({name:'news_create'})"
                        class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Добавить
                </button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Фото
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Заголовок
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Дата публикации
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Действия
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        v-for="item in list" :key="'list_item_'+item.id">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-12 h-12 rounded" :src="item.img">
                        </th>
                        <td class="px-6 py-4">
                            {{ item.title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $dayjs(item.created_at).format('DD-M-YYYY') }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a @click.prevent="$router.push({name:'news_item',params:{id:item.id}})" style="cursor: pointer"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <div class="flex justify-center w-full h-15 mt-3" style="width:100%">
                    <infinite-loading @infinite="handleLoad" v-if="page!==last_page"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import requests from "@/api/requests.js";
import InfiniteLoading from "v3-infinite-loading";

export default {
    name: "NewsList",
    components: {InfiniteLoading},
    data() {
        return {
            list: [],
            loading: false,
            page: 0,
            last_page: null
        };
    },
    methods: {
        handleLoad() {
            console.log('handleLoad');
            if (!this.loading && this.page !== this.last_page)
                this.getList();
        },
        getList() {
            this.loading = true;
            this.page += 1;
            requests.getNewsList({page: this.page}).then(res => {
                this.list = this.list.concat(res.data);
                this.last_page = res.last_page;
                this.loading = false;
            });
        }
    }
};
</script>

<style scoped>

</style>
