import {RESET, SET} from '../_types/store-types';
import {LS_TOKEN, LS_USERS} from '../_types';

const auth = {
    state: () => ({
        authorized: !!localStorage.getItem(LS_USERS),
        token: localStorage.getItem(LS_TOKEN),
    }),
    mutations: {
        [SET](state, {authorised = false, token = null}) {
            state.authorized = authorised;
            state.token = token;
        },
    },
    actions: {},
    getters: {}
};

export default auth;


