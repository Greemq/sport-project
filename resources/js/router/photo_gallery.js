import requireAuth from "@/router/router-guards.js";

const PhotoGalleryRoutes = [
    {
        path: '/photo_gallery_list',
        name: 'photo_gallery',
        beforeEnter: requireAuth,
        component: () => import('../components/PhotoGallery/PhotoGalleryList.vue')
    },
    {
        path: '/photo_gallery',
        name: 'photo_gallery_item_create',
        beforeEnter: requireAuth,
        component: () => import('../components/PhotoGallery/PhotoGalleryItem.vue')
    },
    {
        path: '/photo_gallery/:id',
        name: 'photo_gallery_item',
        beforeEnter: requireAuth,
        component: () => import('../components/PhotoGallery/PhotoGalleryItem.vue')
    },

];

export default PhotoGalleryRoutes;
