<template>
  <b-container>
    <b-row>
      <b-img
        :src="$store.getters.url+$store.getters['users/getCurrentUser'].avatar"
        rounded="circle"
        width="45px"
        height="45px"
        alt="Circle image"
      ></b-img>

      <b-form-textarea
        id="textarea"
        v-model="body"
        placeholder="Enter something..."
        rows="3"
        max-rows="6"
      ></b-form-textarea>
    </b-row>

    <b-row>
      <b-button size="sm" variant="info" id="tweetBtn" @click="tweet()">Tweet</b-button>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      body: ""
    };
  },
  methods: {
    tweet() {
      this.$store
        .dispatch("tweets/StoreTweets", { body: this.body })
        .then(res => {
          if (res.data.success) {
              this.$emit('newTweet',res.data.tweet);
              this.body = "";
            this.$toaster.success("Done :D");
          }
        })
        .catch(err => {});
    }
  }
};
</script>
<style scoped>
.btn {
  border-radius: 80px;
}
#tweetBtn {
   position: absolute;
  right: 0px;
 margin-top: 2%;
}
</style>
