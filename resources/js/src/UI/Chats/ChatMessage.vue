<template>
    <div
        class="rounded py-2 px-3 max-w-lg mt-2"
        :style="{backgroundColor: this.user.id === msg.sender_id ? '#F2F2F2' : '#E2F7CB',fontSize:'4px'}"
    >
        <p class="text-sm text-teal text-justify" :style="{fontSize:'13px'}">
            {{msg.text_message || 'I am a Picture messageI am a Picture messageI am a Picture messageI am a Picture message'}}
        </p>
        <p class="text-right text-xs text-grey-dark mt-1">
            {{msg.time}}
        </p>
    </div>
</template>

<script>
export default {
    name: "ChatMessage.vue",
    props:{
        msg:Object,
        user:Object
    }
}
</script>

<style scoped>

</style>
