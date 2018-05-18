export default function (Vue) {
    Vue.auth = {
        setToken (token, expiration_time){
            localStorage.setItem('token',token);
            localStorage.setItem('expiration',expiration_time);
        },
        getToken (){
            let token = localStorage.getItem('token');
            let expiration = localStorage.getItem('expiration');
            if(!token || !expiration) return false;
            if(Date.now() > parseInt(expiration)){
                this.destroyToken();
                return null;
            }
            return token;
        },
        destroyToken (){
            localStorage.removeItem('token');
            localStorage.removeItem('expiration');
        },
        check() {
            return this.getToken() ? true : false;
        }
    }
    Object.defineProperties(Vue.prototype,{
        $auth : {
            get(){
                return Vue.auth;
            }
        }
    })
}