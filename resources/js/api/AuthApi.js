import client, {setTokenToClient, removeTokenFromClient} from "../api/index.js";
import {LS_USERS, LS_TOKEN} from "../_types/index.js";
import {AUTH, RESET} from "@/_types/store-types.js";
import store from "@/store/index.js";

const authApi = {
    async login(data) {
        return await client.post('/api/auth/login', data).then(res => {
            this.setAuthorization(data.email, data.password, res.data.data.token);
            store.commit('setUser', res.data.data.user);
        });

    },
    setAuthorization(email, password, token) {
        const authdata = window.btoa(email + ':' + encodeURIComponent(password));

        localStorage.setItem(LS_USERS, JSON.stringify(authdata));
        localStorage.setItem(LS_TOKEN, token);

        setTokenToClient(token);

        store.commit('setAuth', token);
    },
    getToken() {
        return localStorage.getItem(LS_TOKEN);
    },
    getMyUser() {
        return client.get('/api/user-info').then(res => {

            store.commit('setUser', res.data);
            return res.data;
        });
    },
    async logout(bool = true) {
        return await client.post('/api/logout').then(() => {
            removeTokenFromClient();
            localStorage.removeItem(LS_USERS);
            localStorage.removeItem(LS_TOKEN);
            store.commit('removeAuth');
            store.commit('deleteUser');
            if (bool)
                window.location.reload();
        });
    },
};

export default authApi;
