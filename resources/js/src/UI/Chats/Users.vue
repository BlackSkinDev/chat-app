<template>
    <!-- Contacts -->
    <div class="flex-1 overflow-auto">
        <div
             v-for="(user,idx) in users"
             :key="idx"
             :class="activeTab === `${user.id}${user.username}` ? 'bg-yellow-100': 'bg-white'"
             class="px-3 flex items-center  cursor-pointer"
             @click="onTabChange(`${user.id}${user.username}`,user.id)"
        >
            <User :user="user"/>
        </div>
    </div>
</template>

<script>
import User from './User.vue'
export default {
    name: "Users",
    components:{
        User
    },
    props:{
        users:Array
    },
    data(){
        return{
            activeTab:'',
        }
    },
    methods:{
        onTabChange(tab,user_id){
            this.activeTab = tab
            this.$emit('userClicked',user_id)
        }
    }
}
</script>

<style scoped>

</style>
