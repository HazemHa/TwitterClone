<template>
  <b-container v-if="tweets.length > 0">
    <div v-for="(tweet) in tweets" :key="tweet.id">
      <br>
      <br>
      <br>
      <br>
      <b-row class="ProfoileImage">
        <b-img
          thumbnail
          rounded="circle"
          width="45px"
          height="45px"
          :src="tweet.user == undefined?'':$store.getters.url+tweet.user.avatar"
          alt="Image 2"
        ></b-img>

        <span>
          <span>{{tweet.user == undefined?"":tweet.user.name}}</span>
          <br>
          <p>{{tweet.user == undefined?"":tweet.body}}</p>
        </span>
      </b-row>

      <b-row>
        <b-col>
          <b-button variant="outline-primary" size="sm">
            <i class="material-icons">comment</i>(5)
          </b-button>
        </b-col>
        <b-col>
          <b-button
            v-b-modal.modal-replay
            @click="setIDForTweet(tweet.id)"
            variant="outline-primary"
            size="sm"
          >
            <i class="fas fa-exchange-alt"></i>
          </b-button>
        </b-col>
        <b-col>
          <b-button variant="outline-primary" @click="love(tweet.id)" size="sm">
            <i class="fas fa-heart"></i>
          </b-button>
        </b-col>
      </b-row>
    </div>

    <!-- Modal Component -->
    <b-modal
      id="modal-replay"
      ref="modal"
      title="Submit your Comment"
      @ok="handleOk"
      @shown="clearComment"
    >
      <form @submit.stop.prevent="handleSubmit">
        <b-textarea v-model="comment" placeholder="Enter your Comment"></b-textarea>
      </form>
    </b-modal>
  </b-container>
</template>
<script>
export default {
  props: ["tweets"],
  data() {
    return {
      comment: "",
      tweet_id: 0
    };
  },
  methods: {
    setIDForTweet(id) {
      this.tweet_id = id;
    },
    reply(id) {
      this.$store
        .dispatch("reply/StoreReply", { tweet_id: id,body:this.comment})
        .then(res => {
          if(res.data.success){
              this.$toaster.success(res.data.success);
          }
        })
        .catch(err => {
          this.$toaster.error(err.response.data.errors.body[0]);
          ;
        });
    },
    love(id) {
      alert("love " + id);
      this.$store
        .dispatch("tweets/likeOrDisLike", { tweetID: id})
        .then(res => {
          console.log(res);
        })
        .catch(err => {
          console.log(err);
        });
    },
    clearComment() {
      this.comment = "";
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      if (!this.comment) {
        alert("Please enter your comment");
      } else {
        this.handleSubmit();
      }
    },
    handleSubmit() {
      this.reply(this.tweet_id);
      this.clearComment();
      this.$nextTick(() => {
        // Wrapped in $nextTick to ensure DOM is rendered before closing
        this.$refs.modal.hide();
      });
    }
  },

  watch: {
    tweets: function(newVal, oldVal) {
      // watch it
      this.tweets = newVal;
      this.$nextTick();
    }
  }
};
</script>
<style scoped>
.btn {
  border-radius: 80px;
}
</style>
