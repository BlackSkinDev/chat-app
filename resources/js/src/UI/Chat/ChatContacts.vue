<template>
    <div v-for="(contact,idx) in contacts"
         :key="idx"
         @click="onTabChange(`${contact.name}`)"
         class="flex flex-row items-center px-2 py-4 border-b-2 cursor-pointer"
         :class="activeTab === contact.name ? 'border-l-4 border-blue-400': ''"
    >
        <ChatContact :contact="contact"></ChatContact>
    </div>
</template>

<script>
import ChatContact from "./ChatContact.vue";
export default {
    name: "ChatContacts.vue",
    components:{
        ChatContact
    },
    props:{
        contacts:Array
    },
    data(){
        return{
            activeTab:"",
        }
    },
    methods:{
        onTabChange(tab){
            this.activeTab = tab
        }
    }
}
</script>

<style scoped>

</style>
