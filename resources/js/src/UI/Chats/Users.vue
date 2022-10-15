<template>
    <!-- Contacts -->
    <div class="flex-1 overflow-auto">
        <div
             v-for="(user,idx) in users"
             :key="idx"
             :class="activeTab === `${user.id}${user.name}` ? '': 'bg-white'"
             class="px-3 flex items-center  cursor-pointer"
             @click="onTabChange(`${user.id}${user.name}`)"
        >
            <div>
                <img class="h-12 w-12 rounded-full"
                     :src="user.image"/>
            </div>
            <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
                <div class="flex items-bottom justify-between">
                    <p class="text-grey-darkest">
                        {{user.name}}
                    </p>
                    <p class="text-xs text-grey-darkest">
                        {{user.last_msg_time}}
                    </p>
                </div>
                <p class="text-grey-dark mt-1 text-sm">
                    {{user.last_msg}}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Users",
    props:{
        users:Array
    },
    data(){
        return{
            activeTab:'',
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
