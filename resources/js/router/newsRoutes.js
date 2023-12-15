import requireAuth from "@/router/router-guards.js";

const newsRoutes = [
    {
        path: '/',
        name: 'news',
        beforeEnter: requireAuth,
        component: () => import('../components/News/NewsList.vue')
    },
    {
        path: '/news',
        name: 'news_create',
        beforeEnter: requireAuth,
        component:()=>import('../components/News/NewsItem.vue')
    },
    {
        path: '/news/:id',
        name: 'news_item',
        beforeEnter: requireAuth,
        component:()=>import('../components/News/NewsItem.vue')
    },

];

export default newsRoutes;
