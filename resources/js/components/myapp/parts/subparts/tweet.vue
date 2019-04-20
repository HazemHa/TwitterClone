<template>
  <b-container v-if="tweets != undefined">
    <b-alert v-if="tweets.length == 0" show variant="info">no tweets</b-alert>

    <div v-for="(tweet,index) in tweets" :key="index">
      <br>
      <br>
      <br>
      <br>
      <b-row v-if="tweet.tweet != undefined">
        <b-col cols="12">
          <b-img
            :src="tweet.tweet.user == undefined?'':$store.getters.url+tweet.tweet.user.avatar"
            alt="Image 2"
            width="45px"
            height="45px"
            rounded="circle"
          ></b-img>

          <span>
            <span>{{tweet.tweet.user == undefined?"":tweet.tweet.user.name}}</span>
            <br>
            <p
              v-html="tweet.tweet.body"
              style="white-space: pre-line"
            >{{tweet.tweet.user == undefined?"":tweet.tweet.body}}</p>
          </span>
        </b-col>
        <b-col cols="12" style="margin-left:10%;">
          <div>
            <b-img
              :src="tweet.user == undefined?'':$store.getters.url+tweet.user.avatar"
              alt="Image 2"
              width="45px"
              height="45px"
              rounded="circle"
            ></b-img>

            <span>
              <span>{{tweet.user == undefined?"":tweet.user.name}}</span>
              <br>
              <p
                v-html="tweet.body"
                style="white-space: pre-line"
              >{{tweet.user == undefined?"":tweet.body}}</p>
            </span>
          </div>
        </b-col>
      </b-row>
      <b-row v-else class="ProfoileImage">
        <b-img
          :src="tweet.user == undefined?'':$store.getters.url+tweet.user.avatar"
          alt="Image 2"
          width="45px"
          height="45px"
          rounded="circle"
        ></b-img>

        <span>
          <span>{{tweet.user == undefined?"":tweet.user.name}}</span>
          <br>
          <p
            v-html="tweet.body"
            style="white-space: pre-line"
          >{{tweet.user == undefined?"":tweet.body}}</p>
        </span>
      </b-row>

      <b-row>
        <b-col>
          <b-button disabled variant="outline-primary" size="sm">
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

          <b-button
            v-show="show_remove"
            @click="removeTweet(tweet.id,index)"
            variant="outline-primary"
            size="sm"
          >
            <i class="fa fa-times"></i>
          </b-button>
        </b-col>
        <b-col>
          <b-button
            :variant="tweet.isLiked?'danger':'outline-primary'"
            :ref="'like_'+tweet.id"
            @click="love(tweet.id,'like_'+tweet.id)"
            size="sm"
          >
            <i class="fas fa-heart">{{tweet.likesCount}}</i>
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
  props: ["tweets", "type"],
  data() {
    return {
      comment: "",
      tweet_id: 0,
      show_remove: false
    };
  },
  mounted() {
    if (this.$route.name.includes("profile")) {
      this.show_remove = true;
    }
  },
  methods: {
    removeTweet(id, index) {
      this.$emit("removeTweet", id, index, this.type);
    },
    setIDForTweet(id) {
      this.tweet_id = id;
    },
    reply(id) {
      this.$store
        .dispatch("reply/StoreReply", { tweet_id: id, body: this.comment })
        .then(res => {
          if (res.data.success) {
            this.$toaster.success(res.data.success);
          }
        })
        .catch(err => {
          this.$toaster.error(err.response.data.errors.body[0]);
        });
    },
    love(id, refButton) {
      this.$store
        .dispatch("tweets/likeOrDisLike", { tweetID: id })
        .then(res => {
          let positionCount = this.$refs[refButton][0].children[0];
          let numCount = parseInt(
            this.$refs[refButton][0].children[0].innerHTML
          );
          let isLiked =
            this.$refs[refButton][0].getAttribute("class") ==
            "btn btn-danger btn-sm";
          if (isLiked) {
            this.changeColor(
              this.$refs[refButton][0],
              "btn btn-danger btn-sm",
              "btn btn-outline-primary btn-sm"
            );
            positionCount.innerHTML = --numCount;
          } else {
            this.changeColor(
              this.$refs[refButton][0],
              "btn btn-outline-primary btn-sm",
              "btn btn-danger btn-sm"
            );
            positionCount.innerHTML = ++numCount;
          }
        })
        .catch(err => {
          console.log(err);
        });
    },
    changeColor(btn, grey, blue) {
      let newClass = btn.getAttribute("class").replace(grey, blue);
      btn.setAttribute("class", newClass);
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
