<template>
        <div class="relative max-w-xl px-4 py-2 py-3 mr-2 rounded shadow bg-blue-50 text-sm mt-3" :class="user_id === message.user_id ? 'bg-white' : 'bg-amber-50' ">
            {{message.message}}
        </div>
        <img
            :src="message.avatar"
            class="object-cover h-6 w-6 rounded-full"
            alt=""
        />

</template>

<script>
export default {
    name: "ChatMessage.vue",
    props:{
        message:Object,
        user_id:Number
    }
}
</script>

<style scoped>

</style>
