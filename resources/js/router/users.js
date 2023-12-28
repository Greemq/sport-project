import requireAuth from "@/router/router-guards.js";

const users = [
    {
        path: '/users',
        name: 'users',
        beforeEnter: requireAuth,
        component: () => import('../components/Users/UsersList.vue')
    },
    {
        path: '/user',
        name: 'user_create',
        beforeEnter: requireAuth,
        component: () => import('../components/Users/UsersItem.vue')
    },
    {
        path: '/user/:id',
        name: 'user_item',
        beforeEnter: requireAuth,
        component: () => import('../components/Users/UsersItem.vue')
    },
];

export default users;