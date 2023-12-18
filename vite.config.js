import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                ],
                views: [
                    // Update the paths to match your folder structure
                    'resources/views/**/*.blade.php',
                ],
            }
        ),
    ],
    // build: {
    //     outDir: 'dist'
    // },
    // publicDir: 'assets',
    // root:'./'
    // root: 'src',
    // build: {
    //     outDir: 'dist'
    // }
    // root: "src",
    // publicDir: "./public",
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
        }
    },
    build: {
        // outDir: "./public",
        // rollupOptions: {
        //     output: {
        //         chunkFileNames: 'assets/js/[name]-[hash].js',
        //         entryFileNames: 'assets/js/[name]-[hash].js',
        //
        //         assetFileNames: ({name}) => {
        //             if (/\.(gif|jpe?g|png|svg)$/.test(name ?? '')) {
        //                 return 'assets/images/[name]-[hash][extname]';
        //             }
        //
        //             if (/\.css$/.test(name ?? '')) {
        //                 return 'assets/css/[name]-[hash][extname]';
        //             }
        //
        //             // default value
        //             // ref: https://rollupjs.org/guide/en/#outputassetfilenames
        //             return 'assets/[name]-[hash][extname]';
        //         },
        //     },
        // }
    },
    base: './',

});
