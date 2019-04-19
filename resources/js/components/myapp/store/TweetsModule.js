import axios from "axios"
export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: { //

        tweetsTag({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/tweetsTag/${data.text}`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },

        TagsData({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/TagsData`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        myTweets({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/myTweets`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },

        likeOrDisLike({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.post(this.getters.url + `api/likeOrDisLike/${data.tweetID}`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },

        allTweets({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/tweets`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },

        tweetsFromFollowing({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `api/tweetsFromFollowing`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        StoreTweets({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.post(this.getters.url + `api/tweets`, data)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        DestroyTweets({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.delete(this.getters.url + `api/tweets/${data.id}`)
                    .then((res) => {
                        resolve(res);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        }

    }
}

