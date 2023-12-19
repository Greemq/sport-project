<template>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class=" flex justify-end">
                <button type="button" @click="$router.push({name:'calendar_results_create'})" v-if="false"
                        class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Добавить
                </button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-30">
                            Дата
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Название
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Статус
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Спортсменов
                        </th>
                        <th scope="col" class="px-6 py-3" v-if="false">
                            Действия
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        v-for="item in list" :key="'list_item_'+item.id">
                        <td class="px-6 py-4">
                            {{ $dayjs(item.date_time).format('DD:M:YYYY HH:MM:ss') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ item.title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ getStatus(item.status) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ item.athlete_count }}
                        </td>
                        <td class="px-6 py-4 w-10" v-if="false">
                            <div class="flex items-center justify-end">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white cursor-pointer h-full"
                                     aria-hidden="true"
                                     @click="$router.push({name:'calendar_results_item',params:{id:item.id}})"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path
                                        d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                    <path
                                        d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                </svg>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <div class="flex justify-center w-full h-15 mt-3 mb-3" style="width:100%">
                    <infinite-loading @infinite="handleLoad" v-if="page!==last_page">
                        <template #spinner>
                            <div class="text-center">
                                <div role="status">
                                    <svg aria-hidden="true"
                                         class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                         viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor"/>
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </template>
                    </infinite-loading>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import requests from "@/api/requests.js";

export default {
    name: "CalendarResultsList",
    data() {
        return {
            list: [],
            page: 0,
            last_page: null,
            loading: false
        };
    },
    methods: {
        handleLoad() {
            if (!this.loading && this.page !== this.last_page)
                this.getList();
        },
        getList() {
            this.loading = true;
            this.page += 1;
            requests.getCalendarResultsList({page: this.page}).then(res => {
                this.list = this.list.concat(res.data);
                this.last_page = res.last_page;
                this.loading = false;
            });
        },
        getStatus(status) {
            let res = '';
            console.log(status)
            switch (status) {
                case 1:
                    res = 'Ожидается';
                    break;
                case 2:
                    res = 'Проходит';
                    break;
                case 3:
                    res = 'Отменен';
                    break;
                case 4:
                    res = 'Завершен';
                    break;
            }
            return res;
        }
    },

};
</script>

<style scoped>

</style>
