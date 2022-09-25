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
        <div class="-mr-32 text-xl">Hi {{user.username}}</div>
        <img class="h-16 w-18 p-2  rounded-full text-white font-semibold flex items-center justify-center" :src="user.avatar">
    </div>
    <!-- end header -->
</template>

<script>
export default {
    name: "Header",
    data(){
        return{
            app_name:import.meta.env.VITE_APP_NAME,
            user:{}
        }
    },
    methods:{

        async fetchAuthUserDetails() {
            const options = {
                url: `${import.meta.env.VITE_API_URL}/user`,
                method: "GET",
            };
            try {
               const {data:{data}} = await axios(options);
               this.user = data
            } catch ({response}) {
                if (response.status === 401){
                    //localStorage.removeItem('access_token')
                    //this.$router.push({ path: '/', query: { access: 'denied' }});
                }
                console.log(response.status)
            }
        },
    },
    created() {
        this.fetchAuthUserDetails()
    }
}
</script>

<style scoped>

</style>
