import axios from "axios"
export default {
    namespaced: true,
    state: {
        currentUser: {
            access_token: undefined,
            id: -1,
        },
        auth:false,
    },
    getters: {
        getCurrentUser(state) {
            return state.currentUser;
        },
        isAuth(state) {
            return state.auth;
        },
    },
    mutations: {
        setCurrentUser(state, payload) {
            $cookies.set("user", payload);
            state.currentUser = payload;
        },

        setAuth(state, payload) {
            state.auth = payload;
        }
    },
    actions: {

        IndexUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/Users`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        Login({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.post(this.getters.url + `api/login`, data)
                    .then((res) => {
                        console.log(res);
                        if (res.data.auth) {
                            axios.defaults.headers.common['Authorization'] = "Bearer " + res.data.user.access_token;
                            commit('setCurrentUser', res.data.user);
                            commit('setAuth', true);
                        }
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        setTokenForRequest({
            commit
        }, data) {
            return new Promise((resolve, reject) => {

                let accessToken = $cookies.get("user").access_token;
                let user = $cookies.get('user');
                if (accessToken && user) {
                    commit("setCurrentUser", user);
                    axios.defaults.headers.common['Authorization'] = "Bearer " + accessToken;
                    commit('setAuth', true);
                    resolve(this.getters['users/isAuth']);
                } else resolve(this.getters['users/isAuth']);
            });
        },
        Logout({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.post(this.getters.url + `api/logout`)
                    .then((res) => {
                        commit('setCurrentUser', res.data.user);
                        $cookies.remove("access_token");
                        commit('setAuth', false);
                        resolve(false);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        singup({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post(this.getters.url + `api/users`, data, {
                        header: {
                            Accept: "application/json",
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        commit('setCurrentUser', res.data.user);
                        commit('setAuth', res.data.auth);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        updateProfile({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post(this.getters.url + `api/profile`, data, {
                        header: {
                            Accept: "application/json",
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        commit('setCurrentUser', res.data.user);
                        commit('setAuth', res.data.success);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },

        StoreUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.post(this.getters.url + `api/Users`, data)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        DestroyUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.delete(this.getters.url + `api/Users/${data.id}`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        UpdateUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.put(this.getters.url + `api/Users/${data.id}`, data)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        }
    }
}
