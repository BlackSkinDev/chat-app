<template>
    <div class="flex flex-col mt-5">

        <div class="flex  mb-4" v-for="(message,idx) in chats" :key="idx" :class="user_id === message.user_id ? 'justify-end' : 'justify-start' ">
            <ChatMessage :message="message" :user_id="user_id"></ChatMessage>
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
        user_id:Number
    }
}
</script>

<style scoped>

</style>
