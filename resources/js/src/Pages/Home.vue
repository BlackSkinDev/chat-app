<template>
    <div class="p-10" >

        <div class="container h-full mx-auto rounded-lg shadow-lg" >

            <Header :user="user"></Header>

            <div class="flex  justify-between">

                <!--Left Sidebar (Chats and Chat Search Bar)-->
                <div class="flex flex-col w-2/5 border-r-2 bg-white chats-div">

                   <SearchChat @search="searchChat"></SearchChat>

                    <div class="overflow-y-scroll">
                        <div v-if="!emptyChat">
                            <Chats :contacts="filteredChats"></Chats>
                       </div>
                       <p v-else class="p-3 font-bold text-sm">No chats</p>
                   </div>

                </div>
                <!-- End of Left Sidebar (Chats and Chat Search Bar)-->


                <!--Middle Container  (Chats messages and Message typing  Bar)-->
                <div class="flex flex-col justify-between w-full  ">

                    <ChatHeader :user="user"></ChatHeader>

                    <div class=" overflow-y-scroll message-div">

                        <ChatMessages v-if="messageLoaded" :chats="chat_messages" :user_id="user.id" ></ChatMessages>

                    </div>

                    <ChatTextarea @sendMessage="sendMessage" ></ChatTextarea>

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
import {httpGet, httpPost} from "../utils/request";
import {helpers} from "../utils/helpers";
import ChatTextarea from "../UI/Chat/ChatTextarea.vue";
import ChatHeader from "../UI/Chat/ChatHeader.vue";

export default {
    components: {
        ChatHeader,
        ChatTextarea,
        Header,
        ChatMessages,
        Chats,
        SearchChat,
    },
    data() {
        return {
            activeTab:"",
            user:{},
            filteredChats:[],
            chats:[],
            chat_messages:[],
            messageLoaded:false,
        }
    },
    mounted() {
        this.fetchAuthUserDetails()
        this.fetchChats()
        this.fetchChatMessages()
    },
    methods: {
        fetchAuthUserDetails() {
            httpGet('/user').then((res) => {
                this.user = res.data;
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
            })
        },

        scrollToLastChat(ref) {
            if(this.chat_messages.length > 0){
                const [el] = ref ? ref.last_message : null
                if (el) {
                    el.scrollIntoView({ behavior: "smooth" });
                }
            }
        },

        sendMessage(text){
            httpPost('/user/send-message',{message:text}).then(() => {
                this.chat_messages.push({
                    message:text,
                    user_id:1
                })
            })
        },

        fetchChatMessages(){
            httpGet('/user/chat-messages')
            .then((res) => {
                this.chat_messages = res.data
                this.messageLoaded = true
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
    height: 720px;
}
.message-div{
    height: 500px;
    padding: 10px;
}
</style>
