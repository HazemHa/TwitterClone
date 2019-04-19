import axios from "axios"
export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {

        IndexFollowers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/followers`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        myFollowers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/myFollowers`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        myFollowing({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/myFollowing`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },

        StoreFollowers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.post(this.getters.url + `api/followers`, data)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        DestroyFollowers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.delete(this.getters.url + `api/followers/${data.id}`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        UpdateFollowers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.put(this.getters.url + `api/followers/${data.id}`, data)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        }
    }
}
