import client from "../api/index.js";
import {LS_USERS, LS_TOKEN} from "../_types/index.js";
import {setTokenToClient} from "../api/index.js";

const requests = {
    async login(data) {
        return await client.post('/api/auth/login', data).then(res => {
            this.setAuthorization(data.email, data.password, res.data.data.token);
        });

    },
    setAuthorization(email, password, token) {
        const authdata = window.btoa(email + ':' + encodeURIComponent(password));

        localStorage.setItem(LS_USERS, JSON.stringify(authdata));
        localStorage.setItem(LS_TOKEN, token);

        setTokenToClient(token);
        store.commit(AUTH + RESET);

    },
};

export default requests;
