<template>
    <div v-for="(contact,idx) in contacts"
         :key="idx"
         @click="onTabChange(`${contact.name}`)"
         class="flex flex-row items-center px-2 py-4 border-b-2 cursor-pointer chats-div"
         :class="activeTab === contact.name ? 'border-l-4 border-blue-400': ''"
    >
        <Chat :contact="contact"></Chat>
    </div>
</template>

<script>
import Chat from "./Chat.vue";
export default {
    name: "Chats.vue",
    components:{
        Chat
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
.chats-div{

}
</style>
