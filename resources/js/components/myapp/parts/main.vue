<template>
  <div>
    <div v-if="this.$authLaravel.isAuth()">
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
  mounted() {
     // console.log(this.isSearch);
  },

  watch: {
    $route(to, from) {
      if (to.params.text) {
        this.$store
          .dispatch("tweets/tweetsTag", { text: to.params.text })
          .then(res => {
            this.tweets = res.data.data;
          })
          .catch(err => {});
      }
      if (to.name == "home") {
        this.fetchAllTweets();
      }
    },
    isSearch(oldValue, newValue) {
        if(oldValue){
           this.tweets = this.$store.getters['tweets/searchData'];
        }
        if(oldValue == false){
             this.fetchAllTweets();
        }
    //  console.log("isSearch old",oldValue,"new isSearch",newValue);
    }
  },
  computed: {
    reOrderTweets() {
      return this.tweets.reverse();
    },
    isSearch() {
      return this.$store.getters["tweets/isSearch"];
    }
  },
  created() {
    this.fetchAllTweets();
  },
  methods: {
    fetchAllTweets() {
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
