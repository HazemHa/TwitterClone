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
  watch: {
    $route(to, from) {
      if (to.params.text) {
        this.$store
          .dispatch("tweets/tweetsTag", {text:to.params.text})
          .then(res => {
              this.tweets = res.data.data;
          })
          .catch(err => {
          });
      }
      if(to.name == "home"){
       this.fetchAllTweets();
      }
    }
  },
  computed: {
    reOrderTweets() {
      return this.tweets.reverse();
    }
  },
  created() {
   this.fetchAllTweets();
  },
  methods: {
      fetchAllTweets(){
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
    addNewTweet(Tweet) {
      this.tweets.push(Tweet);
    }
  }
};
</script>
