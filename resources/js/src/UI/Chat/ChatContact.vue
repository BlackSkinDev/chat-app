<template>
    <div class="w-1/4">
        <img
            :src="contact.image"
            class="object-cover w-12 h-12 rounded-full"
            alt=""
        />
    </div>
    <div class="w-full">
        <div class="text-lg font-semibold">{{contact.name}}</div>
        <span class="text-gray-500">{{contact.last_msg}}</span>
    </div>
</template>

<script>
export default {
    name: "ChatContacct.vue",
    props:{
        contact:Object
    }
}
</script>

<style scoped>

</style>
