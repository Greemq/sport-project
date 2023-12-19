import {createRouter, createWebHistory} from "vue-router";
import newsRoutes from "@/router/newsRoutes.js";
import calendarResultsRoutes from "@/router/calendarResultsRoutes.js";
import athletesRoutes from "@/router/athlete.js";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...newsRoutes,
        ...calendarResultsRoutes,
        ...athletesRoutes,
        {
            path: '/login',
            name: 'login',
            component: () => import('../components/Login.vue'),
        },
        {
            path: '/files',
            name: 'files',
            component: () => import('../components/Files/FilesList.vue')
        },
        {
            path: '/file',
            name: 'files_create',
            component: () => import('../components/Files/FileItem.vue')
        },
        {
            path: '/file/:id',
            name: 'files_item',
            component: () => import('../components/Files/FileItem.vue')
        },


    ]
});


export default router;
