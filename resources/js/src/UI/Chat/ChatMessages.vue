<template>=
    <div class="flex flex-col mt-5" >
        <div v-if="chats.length > 0">
            <div
                class="flex  mb-4"
                v-for="(message,idx) in chats"
                :key="idx" :class="user_id === message.user_id ? 'justify-end' : 'justify-start' "
            >
                <ChatMessage :message="message" :user_id="user_id" ></ChatMessage>
            </div>
        </div>
        <div v-else class="-mt-8 flex justify-center">
            <p>No messages in this chat...</p>
        </div>
        <div ref="lastMessage" class="p-7"></div>
    </div>
</template>

<script>
import ChatMessage from "./ChatMessage.vue";
export default {
    name: "ChatMessages.vue",
    components:{
        ChatMessage
    },
    props:{
        chats:Array,
        user_id:Number,
        scroll_top: Boolean,
        scroll:Boolean,
    },
    data(){
        return{
            chatArray:this.chats
        }
    },
    mounted() {
        this.scrollToLastChat()
    },
    methods:{
        scrollToLastChat() {
                this.$refs.lastMessage.scrollIntoView({ behavior: "smooth" });
       },
    },
    watch:{
        chatArray:{
            handler: function (){
                this.scrollToLastChat()
            },
            deep: true
        }
    }

}
</script>

<style scoped>

</style>
