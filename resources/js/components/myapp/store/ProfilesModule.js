import axios from "axios"
export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {

        IndexProfiles({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/profiles`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },

        StoreProfiles({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.post(this.getters.url + `api/profiles`, data)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        DestroyProfiles({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.delete(this.getters.url + `api/profiles/${data.id}`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        UpdateProfiles({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.put(this.getters.url + `api/profiles/${data.id}`, data)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        }
    }
}
