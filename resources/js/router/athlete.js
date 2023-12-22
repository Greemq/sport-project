import requireAuth from "@/router/router-guards.js";

const athletesRoutes = [
    {
        path: '/athletes',
        name: 'athlete',
        beforeEnter: requireAuth,
        component: () => import('../components/Athlete/AthleteList.vue')
    },
    {
        path: '/athlete/:id',
        name: 'athlete_item',
        beforeEnter: requireAuth,
        component: () => import('../components/Athlete/AthleteItem.vue')
    },
    {
        path: '/athlete',
        name: 'athlete_create',
        beforeEnter: requireAuth,
        component: () => import('../components/Athlete/AthleteItem.vue')
    },
    {
        path: '/applications',
        name: 'applications',
        beforeEnter: requireAuth,
        component: () => import('../components/Applications/ApplicationsList.vue')
    }

];

export default athletesRoutes;
