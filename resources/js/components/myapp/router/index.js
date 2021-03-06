import main from '../parts/main.vue';
import login from '../User/singin.vue';
import register from '../User/singup.vue';
import profile from '../parts/profile.vue';
import VueRouter from 'vue-router'
import authUser from './Auth';
import Vue from 'vue';

Vue.use(VueRouter);
const router = new VueRouter({
    routes: [{
            name: 'home',
            path: '/',
            component: main,
           beforeEnter:authUser,
        },
        {
            path: "/login",
            name: "login",
            component: login,
        },
        {
            path: "/register",
            name: "register",
            component: register,
        },
        {
            path: "/profile",
            name: "profile",
            component: profile,
        //    beforeEnter:authUser,
        }
        ,
        {
            path: "/tag/:text",
            name: "tag",
            component: main,
            beforeEnter:authUser,
        }

    ],
    mode: 'history'
});

export default router;
