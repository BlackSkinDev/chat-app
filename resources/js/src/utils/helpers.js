import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-right',
    duration:3000
});
import router from "../router";
export const helpers = {

    destroyToken : (expired = null)=>{
        const query = {}
        if (expired) query.access = 'denied'
        localStorage.removeItem('access_token')
        router.push({ path: '/', query});
    },
    setToken : (token)=>{
        localStorage.setItem('access_token',token)
        router.push({ path: '/home'});
    },
    errorResponse : (message)=>{
        toaster.error(message);
    },
    successResponse : (message)=>{
        toaster.success(message)
    }
}


