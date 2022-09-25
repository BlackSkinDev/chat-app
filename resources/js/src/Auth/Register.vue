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
                            <div class="w-full relative">
                                <div>
                                    <label for="password"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input v-model="password" :type="password_type" name="password" id="password"
                                           placeholder="••••••••"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="absolute right-2 top-9 cursor-pointer" @click="togglePassword" v-show="password_type === 'text'"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></div>
                                <div class="absolute right-2 top-9 cursor-pointer" @click="togglePassword" v-show="password_type === 'password' "><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg></div>
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
            password_type:'password'
        }
    },
    methods: {
         register() {
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
         togglePassword(){
            if (this.password_type === 'password') {
                this.password_type = 'text'
            }
            else{
                this.password_type = 'password'
            }
        }
    },
}
</script>
<style scoped>

</style>
