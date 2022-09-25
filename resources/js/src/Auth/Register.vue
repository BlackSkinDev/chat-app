<template>
    <div>
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                   {{app_name}}
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Create an account
                        </h1>
                        <form class="space-y-4 md:space-y-6">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                <input v-model="username" type="text" name="text" id="username"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Chilling">
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                    email</label>
                                <input v-model="email" type="email" name="email" id="email"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="name@gmail.com">
                            </div>
                            <div>
                                <label for="password"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input v-model="password" type="password" name="password" id="password"
                                       placeholder="••••••••"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <Button :text="'Sign up'" :disabled="loading" @clickButton="register"></Button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Already have an account ?
                                <router-link :to="{name:'Login'}">Sign in</router-link>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>

import Button from "../UI/Button.vue";
import {httpPost} from "../utils/request";
import {helpers} from "../utils/helpers";


export default {

    components: {
        Button
    },
    data() {
        return {
            username: "",
            email: "",
            password: "",
            loading: false,
            app_name:import.meta.env.VITE_APP_NAME,
        }
    },
    methods: {
        async register() {
            this.loading = true;
            let payload = {email: this.email, password: this.password, username: this.username,}
            httpPost('/register',payload).then((res) => {
                const {message} = res;
                this.$toast.show(`${message}. Redirecting to Login...`, {
                    type: 'success',
                    duration: 4000
                });
                this.username = ''
                this.email    = ''
                this.password = ''
                setTimeout(() => {
                    this.$router.push({ name: "Login" });
                }, 4000);

            }).catch((err) => {
                helpers.errorResponse(err.data.message)
            })
            .finally(() => {
                this.loading = false
            });

        },

    },
}
</script>
<style scoped>

</style>
