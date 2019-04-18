<template>
  <b-container class="bv-example-row">
    <b-row>
      <b-col>
        <b-button href="#" size="sm" variant="outline-primary" @click="home">Home</b-button>
      </b-col>
      <b-col>
        <b-button href="#" size="sm" variant="outline-primary">Notifications</b-button>
      </b-col>
      <b-col>
        <img src="https://img.icons8.com/office/40/000000/twitter.png">
      </b-col>
      <b-col>
        <b-form-input placeholder="Search Twiiter"></b-form-input>
      </b-col>
      <b-col>
        <b-img
          thumbnail
          rounded="circle"
          :src="$store.getters.url+$store.getters['users/getCurrentUser'].avatar"
          alt="Image 2"
          width="55"
          height="55"
        ></b-img>
      </b-col>
      <b-col cols="1">
        <b-button variant="info" v-b-modal.modal-prevent size="sm">Tweet</b-button>
      </b-col>
    </b-row>

    <!-- Modal Component -->
    <b-modal
      id="modal-prevent"
      ref="modal"
      title="tweet"
      @ok="handleOk"
      @shown="clearTweet"
    >
      <form @submit.stop.prevent="handleSubmit">
        <b-form-textarea v-model="tweet" placeholder="Enter your tweet"></b-form-textarea>
      </form>
    </b-modal>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      tweet: ""
    };
  },
  methods: {
    clearTweet() {
      this.tweet = "";
    },
    home(){
      this.$router.push({name:'home'});
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      if (!this.tweet) {
        alert("Please enter your tweet");
      } else {
        this.handleSubmit();
      }
    },
    handleSubmit() {
        alert("your tweet sned to server to store there");
      this.clearTweet();
      this.$nextTick(() => {
        // Wrapped in $nextTick to ensure DOM is rendered before closing
        this.$refs.modal.hide();
      });
    }
  }
};
</script>

<style scoped>
.btn {
  border-radius: 80px;
}
</style>
