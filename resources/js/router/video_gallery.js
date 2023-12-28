import requireAuth from "@/router/router-guards.js";

const videoGalleryRoutes = [
    {
        path: '/video_gallery',
        name: 'video_gallery',
        beforeEnter: requireAuth,
        component: () => import('../components/Video/VideoGalleryList.vue')
    },
    {
        path: '/video_gallery_item',
        name: 'video_gallery_item_create',
        beforeEnter: requireAuth,
        component: () => import('../components/Video/VideoGalleryItem.vue')
    },
    {
        path: '/video_gallery/:id',
        name: 'video_gallery_item',
        beforeEnter: requireAuth,
        component: () => import('../components/Video/VideoGalleryItem.vue')
    },

];

export default videoGalleryRoutes;
