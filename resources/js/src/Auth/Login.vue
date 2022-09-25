<template>
<div>
    <section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          {{app_name}}
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Sign in to your account
              </h1>
              <form class="space-y-4 md:space-y-6" action="#">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input v-model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@gmail.com" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input v-model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">

                  </div>
                  <div class="flex items-center justify-between">
                      <div class="flex items-start">
                          <div class="flex items-center h-5">
                            <input v-model="remember_me" id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                          </div>
                      </div>
                      <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                  </div>
                  <Button :text="'Sign up'" :disabled="loading" @clickButton="login"></Button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Don’t have an account yet? <router-link :to="{name:'Register'}">Sign up</router-link>
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
            email:    "",
            password: "",
            loading:false,
            remember_me:false,
            app_name:import.meta.env.VITE_APP_NAME,
        }
    },
    methods: {

         login() {
            this.loading = true;
            let payload = {email: this.email, password: this.password}
            httpPost('/login',payload).then((res) => {
                const {data:{token}} = res;
                helpers.setToken(token)
            }).catch((err) => {
                if (err.status === 401) helpers.destroyToken(true)
                helpers.errorResponse(err.data.message)
            })
            .finally(() => {
                this.loading = false
            });
        },
    },
    created() {
        if(this.$route.query.access && this.$route.query.access === 'denied' ){
            this.$toast.show('Your session has expired! Please log in to continue', {
                type: 'error',
            });
        }
    }

}
</script>
<style scoped>

</style>
