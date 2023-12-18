import {createRouter, createWebHistory} from "vue-router";
import newsRoutes from "@/router/newsRoutes.js";
import calendarResultsRoutes from "@/router/calendarResultsRoutes.js";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/login',
            name: 'login',
            component: () => import('../components/Login.vue'),
        },
        ...newsRoutes,
        ...calendarResultsRoutes

    ]
});


export default router;