<template>
    <div class="flex flex-col mt-5">

        <ul class="flex  mb-4"  :ref="idx === (chats.length-1) ? 'last_chat' : undefined "  v-for="(message,idx) in chats" :key="idx" :class="user_id === message.user_id ? 'justify-end' : 'justify-start' ">
            <ChatMessage :message="message" :user_id="user_id" ></ChatMessage>
        </ul>

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
        user_id:Number
    },
    mounted() {
        this.scrollToLastChat()
    },
    methods:{
        scrollToLastChat() {
            const [el] = this.$refs.last_chat;
            if (el) {
                el.scrollIntoView({ behavior: "smooth" });
            }
        },
    }
}
</script>

<style scoped>

</style>
