import ProfilesModule from './ProfilesModule';

import ReplyModule from './ReplyModule';

import TweetsModule from './TweetsModule';

import UsersModule from './UsersModule';

import FollowersModule from './FollowersModule';
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    plugins: [],
    state:{

    },
    mutations: {

    },
    modules: {
        //  likes: LikesModule,
        profiles: ProfilesModule,
        reply: ReplyModule,
        tweets: TweetsModule,
        users: UsersModule,
        //   passwordresets: PasswordResetsModule,
        followers: FollowersModule,
    },
    getters: {

        url(state){
            return 'http://127.0.0.1:8000/'
        }
    }
});
export default store;
