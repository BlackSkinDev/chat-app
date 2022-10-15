<template>
    <div class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center">
        <div class="flex items-center">
            <div>
                <div @click="browse" v-tooltip="'Click to update avatar'">
                    <img
                        :src="uploadedAvatar ? uploadedAvatar :auth_user.avatar"
                        class="object-cover h-12 w-12 rounded-full cursor-pointer"
                        :class="loading ? 'opacity-20' : '' "
                        :alt="auth_user.username"
                    />
                    <moon-loader :loading="loading" class="absolute -mt-14 -ml-2"></moon-loader>
                </div>
                <div class="hidden">
                    <input type="file" ref="file" @change="handleFileUpload">
                </div>
            </div>
            <div class="ml-4">
                <p class="text-grey-darkest">
                  {{auth_user.status || 'Hey there I am using whatsapp'}}
                </p>
                <p class="text-grey-darker text-xs mt-1">
                    Online
                </p>
            </div>
        </div>

        <div class="flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".5" d="M15.9 14.3H15l-.3-.3c1-1.1 1.6-2.7 1.6-4.3 0-3.7-3-6.7-6.7-6.7S3 6 3 9.7s3 6.7 6.7 6.7c1.6 0 3.2-.6 4.3-1.6l.3.3v.8l5.1 5.1 1.5-1.5-5-5.2zm-6.2 0c-2.6 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6 4.6 2.1 4.6 4.6-2 4.6-4.6 4.6z"></path></svg>
            </div>

            <div class="ml-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".6" d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"></path></svg>
            </div>
        </div>
    </div>

</template>

<script>
import {httpPost} from "../../utils/request";
import {helpers} from "../../utils/helpers"
import MoonLoader from 'vue-spinner/src/MoonLoader.vue';

export default {
    name: "ChatScreenHeader",
    props: {
        auth_user: Object,
    },
    components:{
        MoonLoader
    },
    data(){
        return{
            app_name:import.meta.env.VITE_APP_NAME,
            status:false,
            uploadedAvatar:"",
            loading:false
        }
    },
    methods:{

        logout(){
            httpPost('/logout').then(() => {
                helpers.destroyToken()
            }).catch((err) => {
                helpers.errorResponse(err.data.message)
            })
        },
        handleFileUpload(){
            let formData = new FormData();
            formData.append('file', this.$refs.file.files[0]);
            this.loading = true;
            httpPost('/upload',formData).then((res) => {
                this.uploadedAvatar = res.data;
                helpers.successResponse(res.message)
            }).catch((err) => {
                helpers.errorResponse(err.data.message)
            })
                .finally(() => {
                    this.loading = false
                });
        },
        toggleDropdown(){
            this.status = !this.status
        },
        browse(){
            this.$refs.file.click()
        },


    },
}
</script>

<style scoped>

</style>
