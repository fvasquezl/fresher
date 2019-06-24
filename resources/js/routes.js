import Vue from 'vue'
import Router from 'vue-router';

Vue.use(Router);
import Home from './views/Home';
import Users from './views/Users';
import Posts from './views/Posts';
import Profile from './views/Profile';
import NotFound from './views/404';

export default new Router({
    routes:[
        {
            path:"/",
            name:'home',
            component: Home
        },{
            path:"/users",
            name:'users',
            component:Users
        },{
            path:"/posts",
            name:'posts',
            component:Posts
        },{
            path:"/profile",
            name:'profile',
            component:Profile
        },{
            path:'*',
            component: NotFound
        },
    ],
    mode: 'history'
});