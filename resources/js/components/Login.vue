<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account

                    </h1>
                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <ui-input placeholder="Email" label="Email" v-model="form.email" :disabled="loading"
                                      :error="errors.length>0"/>
                        </div>
                        <div>
                            <ui-input placeholder="•••••••" label="Password" type="password" v-model="form.password"
                                      :error="errors.length>0"
                                      :disabled="loading"/>
                        </div>
                        <button type="button" @click="login"
                                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Sign in
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

import requests from "@/api/requests.js";
import UiInput from "@/components/Ui/UiInput.vue";

export default {
    name: "Login",
    components: {UiInput},
    data() {
        return {
            form: {
                email: null,
                password: null
            },
            loading: false,
            errors: []
        };
    },
    methods: {
        login() {
            this.errors = [];
            this.loading = true;
            requests.login(this.form).then(res => {
                this.loading = false;
                this.$router.push({name: 'main_page'});
            }).catch(err => {
                this.loading = false;
                this.errors = err.response.data.data.errors;

            });
        }
    },

};
</script>

<style scoped>

</style>
