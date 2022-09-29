<template>
    <div class="flex flex-col mt-5">
        <div v-if="chats.length > 0">
            <ul
                class="flex  mb-4"
                :ref="(idx === 0 ) ? 'first_message' : (idx === (chats.length-1)) ? 'last_message' : undefined"
                v-for="(message,idx) in chats"
                :key="idx" :class="user_id === message.user_id ? 'justify-end' : 'justify-start' "
            >
                <ChatMessage :message="message" :user_id="user_id" ></ChatMessage>
            </ul>
        </div>
        <div v-else class="-mt-8 flex justify-center">
            <p>No messages in this chat...</p>
        </div>
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
        scroll:Boolean
    },
    mounted() {
        this.scrollToLastChat()
    },
    methods:{
        scrollToLastChat() {
            if(this.chats.length > 0){
                const [el] = this.$refs ? this.$refs.last_message : null
                if (el) {
                    el.scrollIntoView({ behavior: "smooth" });
                }
            }
       },
    },

}
</script>

<style scoped>

</style>
