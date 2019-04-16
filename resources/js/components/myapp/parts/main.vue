<template>
  <div>
    <div v-if="$store.getters['users/isAuth']">
      <writeTweet @newTweet="addNewTweet"></writeTweet>
    </div>
    <br>
    <br>
    <tweet :tweets="reOrderTweets"></tweet>
  </div>
</template>

<script>
import writeTweet from "./subparts/writeTweet.vue";
import tweet from "./subparts/tweet.vue";

export default {
  components: {
    writeTweet: writeTweet,
    tweet: tweet
  },
  data() {
    return {
      tweets: []
    };
  },
  computed:{
       reOrderTweets(){
           return this.tweets.reverse();
       }
  },
  created() {
    this.$store
      .dispatch("tweets/allTweets")
      .then(res => {
        this.$nextTick(() => {
          this.tweets = res.data.tweets;
        });
      })
      .catch(err => {
        console.log(err);
      });
  },
  methods: {
    addNewTweet(Tweet) {
      this.tweets.push(Tweet);
    }
  }
};
</script>
