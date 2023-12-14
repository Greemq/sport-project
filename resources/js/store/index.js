import {createApp} from 'vue';
import {createStore} from 'vuex';
import auth from "../store/auth.js";


const store = createStore({
    state() {
    },
    mutations: {},
    modules: {
        auth
    }
});
export default store;
