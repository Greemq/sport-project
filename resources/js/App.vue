<template>
    <div class="bg-gray-900">
        <sidebar v-if="$route.name!=='login'"/>
        <router-view />
    </div>

</template>

<script>
import Sidebar from "./components/Sidebar.vue";
import {initFlowbite} from 'flowbite';

export default {
    name: "App.vue",
    components: {Sidebar},
    mounted() {
        initFlowbite();
        console.log('mounted')
    }
};
</script>

<style scoped>

</style>
