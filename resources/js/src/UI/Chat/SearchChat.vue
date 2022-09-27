<template>
    <div class="px-2 py-4 border-b-2">
        <input
            type="text"
            placeholder="search contact"
            class="w-full px-2 py-2 border-2 border-gray-200 rounded-2xl"
            v-model="search_contact"
        />
    </div>
</template>

<script>
export default {
    name: "SearchChat",
    data(){
        return{
            search_contact:""
        }
    },
    watch:{
        search_contact(){
            this.$emit('search',this.search_contact)
        }
    }
}
</script>

<style scoped>

</style>
