<template>
    <div class="p-10" >

        <div class="container h-full mx-auto rounded-lg shadow-lg" >

            <Header :user="user"></Header>

            <div class="flex flex-row justify-between">

                <!--Left Sidebar (Chats and Chat Search Bar)-->
                <div class="flex flex-col w-2/5 overflow-y-auto border-r-2 bg-white overflow-y-scroll chats-div">

                   <SearchChat @search="searchChat"></SearchChat>
<!--                    <div class=" grid place-items-center mt-4">-->
<!--                        <sync-loader :loading="true"></sync-loader>-->
<!--                    </div>-->
                    <div v-if="!emptyChat">
                        <Chats :contacts="filteredChats"></Chats>
                   </div>
                   <p v-else class="p-3 font-bold text-sm">No chats</p>


                </div>
                <!-- End of Left Sidebar (Chats and Chat Search Bar)-->


                <!--Middle Container  (Chats messages and Message typing  Bar)-->
                <div class="flex flex-col justify-between w-full px-5">

                    <div class=" overflow-y-scroll message-div" >

                        <ChatMessages :chats="chat_messages" :user_id="user.id"></ChatMessages>

                    </div>

                    <div class="py-5">
                        <input
                            class="w-full px-3 py-5 rounded-xl"
                            type="text"
                            placeholder="type your message here..."
                        />
                    </div>

                </div>
                <!--End of Middle Container  (Chats messages and Message typing  Bar)-->


                <!--Right Sidebar  (Groups)-->
                <div class="w-2/5 px-5 border-l-2">
                    <div class="flex flex-col">
                        <div class="py-4 text-xl font-semibold">Mern Stack Group</div>
                        <img
                            src="https://source.unsplash.com/L2cxSuKWbpo/600x600"
                            class="object-cover h-64 rounded-xl"
                            alt=""
                        />
                        <div class="py-4 font-semibold">Created 22 Sep 2021</div>
                        <div class="font-light">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt,
                            perspiciatis!
                        </div>
                    </div>
                </div>
                <!-- End of Right Sidebar  (Groups)-->

            </div>


        </div>
    </div>

</template>
<script>
import Header from '../UI/Header.vue'
import ChatMessages from '../UI/Chat/ChatMessages.vue'
import Chats from "../UI/Chat/Chats.vue";
import SearchChat from "../UI/Chat/SearchChat.vue";
import SyncLoader from 'vue-spinner/src/SyncLoader.vue';
import {httpGet} from "../utils/request";
import {helpers} from "../utils/helpers";

export default {
    components: {
        Header,
        ChatMessages,
        Chats,
        SearchChat,
        SyncLoader
    },
    data() {
        return {
            dropdown_status:false,
            activeTab:"",
            user:{},
            filteredChats:[],
            loading:false,
            chats:[],
            chat_messages:[
                {
                    message:'I am coming',
                    user_id:1,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'I am not coming',
                    user_id:2,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'Where are you',
                    user_id:1,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow',
                    user_id:1,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'Wale don come',
                    user_id:2,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'I am coming',
                    user_id:1,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'I am not coming',
                    user_id:2,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'Where are you',
                    user_id:1,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow We are going tomorrow',
                    user_id:1,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
                {
                    message:'Wale don come',
                    user_id:2,
                    avatar:'https://source.unsplash.com/vpOeXr5wmR4/600x600'
                },
            ]
        }
    },
    mounted() {
        this.fetchAuthUserDetails()
        this.fetchChats()

    },
    methods: {
        fetchAuthUserDetails() {
            httpGet('/user').then((res) => {
                this.user = res.data;
                console.log(this.user)
            }).catch((err) => {
                if (err.status === 401) helpers.destroyToken()
                helpers.errorResponse(err.data.message)

            })
        },
        searchChat(search_chat){
            const search = search_chat.toLowerCase().trim();
            if (!search) {
                this.filteredChats = this.chats
                return;
            }
            this.filteredChats  = this.filteredChats.filter(c => c.name.toLowerCase().indexOf(search) > -1)
        },
        fetchChats(){
            httpGet('/user/chats').then((res) => {
               this.chats = res.data
               this.filteredChats = res.data
            }).catch(() => {
            })
        },
    },
    computed:{
        emptyChat(){
            return this.filteredChats.length === 0;
        }
    }

}
</script>
<style scoped>
.chats-div{
    height: 594px;
}
.message-div{
    height: 500px;
    padding: 10px;
}
</style>
