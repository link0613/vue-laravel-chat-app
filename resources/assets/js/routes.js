import Vue from 'vue';
import VueRouter from 'vue-router';

// Router
Vue.use(VueRouter);

const routes = [
    {
        path: '/home',
        component: require('./components/Home.vue'),
        meta : {
            forAuth : true,
        }
    },
    {
        path: '/login',
        component: require('./components/Login.vue'),
        meta : {
            forPublic : true,
        }
    },
    {
        path: '/register',
        component: require('./components/Register.vue'),
        meta : {
            forPublic : true,
        }
    }
]

const router = new VueRouter({
    routes
})

router.beforeEach(
    (to,from,next) => {
        if(to.matched.some(record => record.meta.forPublic)){
            if(Vue.auth.check()){
                next({
                    path : '/home'
                });
            } else {
                next();
            }
        } else if(to.matched.some(record => record.meta.forAuth)){
            if(!Vue.auth.check()){
                next({
                    path : '/login'
                });
            } else {
                next();
            }
        } else {
            next();
        }
    }
)

export default router;