<template>
    <!-- Contacts -->
    <div class="flex-1 overflow-auto">
        <div
             v-for="(user,idx) in users"
             :key="idx"
             :class="activeTab === `${user.id}${user.username}` ? 'bg-yellow-100': 'bg-white'"
             class="px-3 flex items-center  cursor-pointer"
             @click="onTabChange(`${user.id}${user.username}`)"
        >
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
