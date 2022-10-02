<template>
    <div>
    <div class="p-2 bg-blue-100 flex justify-center">
        <img
            :src="user.avatar"
            class="object-cover h-10 w-10 rounded-full cursor-pointer"
            :alt="user.username"
        />
        <p class="p-2 text-smfont-bold">{{this.user.username}}</p>
    </div>
    <p class="mt-5 text-center">Wale is typing ....</p>
    </div>

</template>

<script>
export default {
    name: "ChatHeader",
    props:{
        user:Object
    }
}
</script>

<style scoped>

</style>
