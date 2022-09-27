<template>
    <div class="p-10" >

        <div class="container h-full mx-auto rounded-lg shadow-lg" >

            <Header></Header>

            <div class="flex flex-row justify-between">

                <!--Left Sidebar (Chats and Chat Search Bar)-->
                <div class="flex flex-col w-2/5 overflow-y-auto border-r-2 bg-white">

                   <SearchChat @search="searchChat"></SearchChat>
<!--                    <div class=" grid place-items-center mt-4">-->
<!--                        <sync-loader :loading="true"></sync-loader>-->
<!--                    </div>-->
                   <ChatContacts :contacts="filteredContacts"></ChatContacts>

                </div>
                <!-- End of Left Sidebar (Chats and Chat Search Bar)-->


                <!--Middle Container  (Chats messages and Message typing  Bar)-->
                <div class="flex flex-col justify-between w-full px-5">

                    <ChatMessages :chats="chats" :user_id="user_id"></ChatMessages>

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
import ChatContacts from "../UI/Chat/ChatContacts.vue";
import SearchChat from "../UI/Chat/SearchChat.vue";
import SyncLoader from 'vue-spinner/src/SyncLoader.vue';

export default {
    components: {
        Header,
        ChatMessages,
        ChatContacts,
        SearchChat,
        SyncLoader
    },
    data() {
        return {
            dropdown_status:false,
            activeTab:"",
            user_id:1,
            filteredContacts:[],
            loading:false,
            contacts:[
                // {
                //     name:'Luis1994',
                //     image:'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                //     last_msg :'Pick me at 9:00 Am'
                // },
                // {
                //     name:'Sam',
                //     image:'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                //     last_msg :'Hi Sam, Welcome'
                // },
                // {
                //     name:'Loccini',
                //     image:'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                //     last_msg :'Hi Loccini, Welcome'
                // },
                // {
                //     name:'Afeez',
                //     image:'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                //     last_msg :'Hi Afeez, Welcome'
                // },
                // {
                //     name:'Seyilaw',
                //     image:'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                //     last_msg :'Hi Seyilaw, Welcome'
                // },
                {
                    name:'Lai',
                    image:'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                    last_msg :'Hi Lai, Welcome'
                },

            ],
            chats:[
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
        this.filteredContacts = this.contacts
    },
    methods: {
        searchChat(search_contact){

            const search = search_contact.toLowerCase().trim();
            if (!search) {
                this.filteredContacts = this.contacts
                return;
            }
            this.filteredContacts  = this.filteredContacts.filter(c => c.name.toLowerCase().indexOf(search) > -1)

        }
    }
}
</script>
<style scoped>

</style>
