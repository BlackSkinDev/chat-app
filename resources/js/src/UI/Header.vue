<template>
    <!-- header -->
    <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
        <div class="font-semibold text-2xl">{{app_name}}</div>
        <div class="w-1/2">
            <input
                type="text"
                name=""
                id=""
                placeholder="search IRL"
                class="rounded-2xl bg-gray-100 py-3 px-5 w-full"
            />
        </div>
        <div class="ml-52 text-xl flex cursor-pointer" @click="toggleDropdown">
            <p class="text-base">{{user.username}}</p>
            <svg class="h-5 w-8 mr-10 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="relative inline-block text-left">
            <div>
                <img
                    :src="user.avatar"
                    class="object-cover h-12 w-12 rounded-full cursor-pointer"
                    :alt="user.username"
                />
            </div>
            <div v-show="status" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" >
                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm" @click="logout" >Logout</a>
                </div>
            </div>
        </div>

    </div>
    <!-- end header -->
</template>

<script>
import {httpGet} from "../utils/request";
import {helpers} from "../utils/helpers"
export default {
    name: "Header",
    props: {
        dropdown_status: Boolean,
    },
    data(){
        return{
            app_name:import.meta.env.VITE_APP_NAME,
            user:{},
            status:false,
            token:localStorage.getItem('access_token')
        }
    },
    methods:{

        async fetchAuthUserDetails() {
            httpGet('/user').then((res) => {
                this.user = res.data;
            }).catch((err) => {
                if (err.status === 401){
                    helpers.destroyToken()
                }
            })
        },
        toggleDropdown(){
            this.status = !this.status
        },
        async logout(){
            const options = {
                url: `/logout`,
                method: "POST",
                headers:{
                    Authorization: `Bearer ${this.token}`
                }
            };
            try {
                 await axios(options);
                localStorage.removeItem('access_token')
                this.$router.push('/');
            } catch ({response}) {}

        }
    },
    created() {
        this.fetchAuthUserDetails()
    }
}
</script>

<style scoped>

</style>
