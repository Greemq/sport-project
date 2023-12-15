<template>
    <div class="bg-gray-900" v-if="ready&&$store.state.user.user">
        <sidebar v-if="$route.name!=='login'"/>
        <router-view class="min-h-screen"/>
    </div>

</template>

<script>
import Sidebar from "./components/Sidebar.vue";
import {initFlowbite} from 'flowbite';
import authApi from "@/api/AuthApi.js";
import {setTokenToClient} from "@/api/index.js";


export default {
    name: "App.vue",
    components: {Sidebar},
    data() {
        return {
            ready: false
        };
    },
    computed: {
        authorized() {
            return this.$store.state.auth.authorized;
        }
    },
    methods: {
        getToken() {
            setTokenToClient(authApi.getToken());
            authApi.getMyUser();
            this.$nextTick(() => {
                this.ready = true;
            });

        }
    },
    mounted() {
        initFlowbite();
        if (this.authorized)
            this.getToken();
        else
            this.ready = true;
    }
};
</script>

<style scoped>

</style>
