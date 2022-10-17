<template>
    <div>
        <div class="w-full h-32 " style="background-color: #449388"></div>

        <div class="container mx-auto" style="margin-top: -128px;">
            <div class="py-6 h-screen">
                <div class="flex border border-grey rounded shadow-lg h-full">

                    <!-- Left -->
                    <div class="w-1/3 border flex flex-col">

                       <ChatHeader :auth_user="user"/>

                       <SearchUser @search="searchUser"/>

                        <div v-if="!usersAreEmpty" class="overflow-y-scroll">
                            <Users :users="filteredUsers" @userClicked="loadUserMessages"/>
                        </div>

                        <div v-if="usersAreEmpty" class="flex items-center justify-center h-screen">
                            <p  class="p-3 font-bold text-xl mt-5">No users available</p>
                        </div>

                    </div>


                    <!-- Right -->
                    <div class="w-2/3 border flex flex-col">

                        <!-- Header -->
                        <ChatScreenHeader :auth_user="user" v-if="loadMessage"/>

                        <!-- Messages -->
                        <div class="flex-1 overflow-auto" style="background-color: #DAD3CC">
                            <div v-if="!loadMessage" class="flex items-center justify-center h-screen -mt-20">
                                <p  class="p-3 font-bold text-sm mt-5">Click on a user to start chat</p>
                            </div>
                            <ChatMessages v-if="loadMessage" :messages="chat_messages_with_user" :user="user"/>
                        </div>

                        <!-- Input -->
                        <div class="bg-grey-lighter px-4 py-4 flex items-center" v-if="loadMessage">
                            <div class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path opacity=".45" fill="#263238" d="M9.153 11.603c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962zm-3.204 1.362c-.026-.307-.131 5.218 6.063 5.551 6.066-.25 6.066-5.551 6.066-5.551-6.078 1.416-12.129 0-12.129 0zm11.363 1.108s-.669 1.959-5.051 1.959c-3.505 0-5.388-1.164-5.607-1.959 0 0 5.912 1.055 10.658 0zM11.804 1.011C5.609 1.011.978 6.033.978 12.228s4.826 10.761 11.021 10.761S23.02 18.423 23.02 12.228c.001-6.195-5.021-11.217-11.216-11.217zM12 21.354c-5.273 0-9.381-3.886-9.381-9.159s3.942-9.548 9.215-9.548 9.548 4.275 9.548 9.548c-.001 5.272-4.109 9.159-9.382 9.159zm3.108-9.751c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962z"></path></svg>
                            </div>
                            <div class="flex-1 mx-4">
                                <input class="w-full border rounded px-2 py-2" type="text"/>
                            </div>
                            <div class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="#263238" fill-opacity=".5" d="M1.816 15.556v.002c0 1.502.584 2.912 1.646 3.972s2.472 1.647 3.974 1.647a5.58 5.58 0 0 0 3.972-1.645l9.547-9.548c.769-.768 1.147-1.767 1.058-2.817-.079-.968-.548-1.927-1.319-2.698-1.594-1.592-4.068-1.711-5.517-.262l-7.916 7.915c-.881.881-.792 2.25.214 3.261.959.958 2.423 1.053 3.263.215l5.511-5.512c.28-.28.267-.722.053-.936l-.244-.244c-.191-.191-.567-.349-.957.04l-5.506 5.506c-.18.18-.635.127-.976-.214-.098-.097-.576-.613-.213-.973l7.915-7.917c.818-.817 2.267-.699 3.23.262.5.501.802 1.1.849 1.685.051.573-.156 1.111-.589 1.543l-9.547 9.549a3.97 3.97 0 0 1-2.829 1.171 3.975 3.975 0 0 1-2.83-1.173 3.973 3.973 0 0 1-1.172-2.828c0-1.071.415-2.076 1.172-2.83l7.209-7.211c.157-.157.264-.579.028-.814L11.5 4.36a.572.572 0 0 0-.834.018l-7.205 7.207a5.577 5.577 0 0 0-1.645 3.971z"></path></svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChatHeader from "../UI/ChatHeader.vue";
import SearchUser from "../UI/Chats/SearchUser.vue";
import Users from "../UI/Chats/Users.vue";
import ChatScreenHeader from "../UI/Chats/ChatScreenHeader.vue";
import ChatMessages from "../UI/Chats/ChatMessages.vue";
import {httpGet, httpPost} from "../utils/request";
import {helpers} from "../utils/helpers";
export default {
    name: "Chat",
    components:{
        ChatScreenHeader,
        ChatHeader,
        SearchUser,
        Users,
        ChatMessages
    },
    data(){
        return{
            filteredUsers:[],
            user:{},
            users:[],
            loadMessage:false,
            chat_messages_with_user:{}
        }
    },
    mounted() {
        this.fetchAuthUserDetails()
        this.fetchUsers()

        Echo.private('chat')
            .listen('NewPrivateMessageSent',(e)=>{
                this.chat_messages.push(e.message)
            })
    },
    methods: {
        fetchAuthUserDetails() {
            httpGet('/profile').then((res) => {
                this.user = res.data;
            }).catch((err) => {
                if (err.status === 401) helpers.destroyToken()
                helpers.errorResponse(err.data.message)
            })
        },
        fetchUsers(){
            httpGet('/all?has_conversation=true').then((res) => {
                this.users = res.data
                this.filteredUsers = res.data
            })

        },
        searchUser(search_user){
            const search = search_user.toLowerCase().trim();
            if (!search) {
                this.filteredUsers = this.users
                return;
            }
            httpGet(`/all?username=${search_user}`).then((res) => {
                this.filteredUsers = res.data
            })
        },
        sendMessage(text){
            this.chat_messages.push({
                message:text,
                user_id:this.user.id
            })
            httpPost('/send-message',{message:text}).then(() => {})
        },
        loadUserProfile(user_id){
            httpGet(`/profile?user=${user_id}`).then((res) => {
                this.user = res.data;
            })
        },
        loadUserMessages(user_id){
            this.loadMessage = true

            //load user profile
            this.loadUserProfile(user_id)

            //load conversations between user and  logged_in user
            httpGet(`/chat-messages?user=${user_id}`).then((res) => {
                this.chat_messages_with_user = res.data;
            })

        }
    },
    computed:{
        usersAreEmpty(){
            return this.filteredUsers.length === 0;
        }
    }
}
</script>

<style scoped>

</style>
