import store from "@/store/index.js";

const requireAuth = (to, from, next) => {
    if (store.state.auth.authorized) {
        next();
    } else {
        next({name: 'login', query: {from: to.name}});
    }
};

export default requireAuth;
