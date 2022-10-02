<template xmlns="http://www.w3.org/1999/html">
    <div class="p-5 bg-blue-100 flex -mt-16">

        <textarea
            class="w-full px-3 py-5 rounded-xl h-14 text-sm"
            placeholder="type your message here..."
            v-model="text"
            v-on:keyup.enter="send"
        />
        <div @click="send" class="ml-2 mt-1">
            <img :src="logo" class="logo cursor-pointer">
        </div>

    </div>
</template>

<script>
import {helpers} from "../../utils/helpers";
import logo from "../../Assests/send.svg"


export default {
    name: "ChatTextarea",
    components:{

    },
    data(){
        return{
            text:"",
            logo:logo
        }
    },
    methods:{
        send(){
            let text = this.text.split('')
            length = helpers.getTextAreaValueLength(text)
            if (length < 1){
                helpers.errorResponse('Message cannot be empty')
            }
            else{
                this.$emit('sendMessage',this.text)
            }
            this.text = ""
        }
    }
}
</script>

<style scoped>

</style>
