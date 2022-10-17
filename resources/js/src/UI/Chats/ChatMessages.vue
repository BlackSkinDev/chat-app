<template>
    <div class="py-2 px-3 ">


        <!--        Messages-->
        <div class="mt-1" v-if="Object.keys(messages).length > 0">


            <div
                v-for="(message, date,idx) in messages"
                :key="idx"
            >

                <!--        Messages date-->
                <div class="flex justify-center mb-2 mt-8">
                    <div class="rounded py-2 px-4" style="background-color: #DDECF2">
                        <p class="text-sm uppercase">
                            {{date}}
                        </p>
                    </div>
                </div>

                <div
                    v-for="(msg,index) in message"
                    :key="index"
                    class="flex mb-2 mt-2"
                    :class="this.user.id !== msg.sender_id ? 'justify-end' :  '' "
                >
                    <ChatMessage :msg="msg" :user="user"/>
                </div>


            </div>

        </div>

        <div ref="lastMessage" class="bg-red-500 p-36">Ababakkwnfkenfefk</div>

    </div>
</template>

<script>
import ChatMessage from "./ChatMessage.vue";
export default {
    name: "ChatMessages.vue",
    components:{
        ChatMessage
    },
    props:{
        user:Object,
        scroll_top: Boolean,
        scroll:Boolean,
        messages:Object
    },
    data(){
        return{
            MessagesObject:this.messages
        }
    },
    mounted() {
        this.scrollToLastChat()
    },
    methods:{
        scrollToLastChat() {
            this.$refs.lastMessage.scrollIntoView({ behavior: "smooth" });
        },
    },
    watch:{
        MessagesObject:{
            handler: function (){
                this.scrollToLastChat()
            },
            deep: true
        }
    }

}
</script>

<style scoped>

</style>
