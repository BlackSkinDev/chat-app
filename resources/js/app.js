import './bootstrap';

import {createApp} from 'vue'

import router from './src/router/index.js'

import App from './App.vue'

import Toaster from '@meforma/vue-toaster';

import VueChatScroll from 'vue-chat-scroll'


createApp(App)
    .use(router)
    .use(Toaster, {
        position: 'top-right',
        duration:3000
    })
    .use(VueChatScroll)
    .mount("#app")
