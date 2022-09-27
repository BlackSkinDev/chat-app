import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-right',
    duration:3000
});
import router from "../router";
export const helpers = {

    destroyToken : ()=>{
        localStorage.removeItem('access_token')
        router.push({ path: '/'});
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


