import {createRouter, createWebHistory} from "vue-router";
import store from "../store/index.js";

const requireAuth = (to, from, next) => {
    if (store.state.auth.authorized) {
        next();
    } else {
        next({name: 'login', query: {from: to.name}});
    }
};

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/login',
            name: 'login',
            component: () => import('../components/Login.vue'),
        },
        {
            path: '/',
            name: 'main_page',
            beforeEnter: requireAuth,
            component: () => import('../components/Main.vue')
        },


    ]
});

// router.beforeEach((to, from, next) => {
//     console.log(to.name);
//     console.log(!store.state.auth.authorized);
//     if (!store.state.auth.authorized && to.name == 'login') {
//         console.log('not auth ');
//         next('/login');
//     } else {
//         next();
//     }
//
// });


export default router;
