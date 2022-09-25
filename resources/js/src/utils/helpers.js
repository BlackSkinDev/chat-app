export const helpers = {

    destroyToken : ()=>{
        localStorage.removeItem('access_token')
        this.$router.push({ path: '/', query: { access: 'denied' }});
    }

}


