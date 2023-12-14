import './bootstrap';
import '../css/app.css';

import {createApp} from 'vue';
import App from './App.vue';
import router from "./router/index.js";
import store from "./store/index.js";


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


app.mount('#app');



