import requireAuth from "@/router/router-guards.js";

const PhotoGalleryRoutes = [
    {
        path: '/photo_gallery',
        name: 'photo_gallery',
        beforeEnter: requireAuth,
        component: () => import('../components/PhotoGallery/PhotoGalleryList.vue')
    },
    {

    }
];

export default PhotoGalleryRoutes;