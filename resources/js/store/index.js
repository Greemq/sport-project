import {createApp} from 'vue';
import {createStore} from 'vuex';
import auth from "../store/auth.js";
import user from "@/store/user.js";


const store = createStore({
    state() {
    },
    mutations: {},
    modules: {
        auth,
        user
    }
});
export default store;
