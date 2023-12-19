import requireAuth from "@/router/router-guards.js";

const calendarResultsRoutes = [
    {
        path: '/calendar-results',
        name: 'calendar_results',
        component: () => import('../components/CalendarResults/CalendarResultsList.vue'),
        beforeEnter: requireAuth
    },
    {
        path: '/calendar-result',
        name: 'calendar_results_create',
        component: () => import('../components/CalendarResults/CalendarResultsItem.vue'),
        beforeEnter: requireAuth
    },
    {
        path: '/calendar-result/:id',
        name: 'calendar_results_item',
        component: () => import('../components/CalendarResults/CalendarResultsItem.vue'),
        beforeEnter: requireAuth
    },

];

export default calendarResultsRoutes;
