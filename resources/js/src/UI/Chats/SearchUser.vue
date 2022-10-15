<template>
    <!-- Search -->
    <div class="py-2 px-2 bg-grey-lightest -mt-2">
        <input type="text" class="w-full px-2 py-2 text-sm focus:outline-0" placeholder="Search or start new chat"  v-model="search_user"/>
    </div>
</template>

<script>
export default {
    name: "SearchChat.vue",
    data(){
        return{
            search_user:""
        }
    },
    watch:{
        search_user(){
            this.$emit('search',this.search_user)
        }
    }
}
</script>

<style scoped>

</style>
