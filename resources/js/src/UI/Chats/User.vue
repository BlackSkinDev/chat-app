<template>
    <div>
        <img class="h-12 w-12 rounded-full"
             :src="user.avatar"/>
    </div>
    <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
        <div class="flex items-bottom justify-between">
            <p class="text-grey-darkest">
                {{user.username}}
            </p>
            <p class="text-xs text-grey-darkest">
                {{user.last_message_time}}
            </p>
        </div>
        <p class="text-gray-400 mt-1 " style="font-size: 11px">
            {{user.last_text_message}}
        </p>
    </div>
</template>

<script>
export default {
    name: "User",
    props:{
        user:Object
    }
}
</script>

<style scoped>

</style>
