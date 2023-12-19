import './bootstrap';
import '../css/app.css';

import {createApp} from 'vue';
import App from './App.vue';
import router from "./router/index.js";
import store from "./store/index.js";
import InfiniteLoading from "v3-infinite-loading";
import "v3-infinite-loading/lib/style.css";
import dayjs from "dayjs";

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

// app.use(router)
// app.use(store)
// app.config.devtools = true;
// app.config.productionTip = true;
// app.mount("#app")

// createApp(App).use([router, store]).mount("#app");

const app = createApp(App);

if (process.env.NODE_ENV === 'development') {
    app.config.devtools = true;
}
app.use(store);
app.use(router);
app.component("infinite-loading", InfiniteLoading);
app.component('VueDatePicker', VueDatePicker);
app.config.globalProperties.$dayjs = dayjs

app.mount('#app');



