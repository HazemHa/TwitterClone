<template>
  <b-container class="bv-example-row">
    <b-row>
      <b-col>
        <b-button href="#" size="sm" variant="outline-primary" @click="home">Home</b-button>
      </b-col>
      <b-col>
        <b-button href="#" size="sm" variant="outline-primary" @click="profile">Profile</b-button>
      </b-col>
      <b-col>
        <img src="https://img.icons8.com/office/40/000000/twitter.png">
      </b-col>
      <b-col>
        <b-form-input
          @keyup.enter="searchTwitter()"
          v-model="textSearch"
          placeholder="Search Twitter"
        ></b-form-input>
      </b-col>
      <b-col>
        <b-img
          thumbnail
          rounded="circle"
          :src="$store.getters.url+'storage/'+$store.getters['users/getCurrentUser'].avatar"
          alt="Image 2"
          width="55"
          height="55"
        ></b-img>
      </b-col>
      <b-col cols="1">
        <b-button href="#" size="sm" variant="outline-primary" @click="Logout">Logout</b-button>
        <b-button variant="info" v-b-modal.modal-prevent size="sm">Tweet</b-button>
      </b-col>
    </b-row>

    <!-- Modal Component -->
    <b-modal id="modal-prevent" ref="modal" title="tweet" @ok="handleOk" @shown="clearTweet">
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
      tweet: "",
      textSearch: ""
    };
  },
  created() {
    console.log(this.$store.getters["users/getCurrentUser"]);
  },
  methods: {
    clearTweet() {
      this.tweet = "";
    },
    home() {
      this.$router.push({ name: "home" });
    },
    searchTwitter() {
      if (this.textSearch == "") return;
      let modifyText = this.textSearch.replace(" ", "-");
      this.$store.dispatch("tweets/searchTweet", { text: modifyText });
    },
    profile() {
      this.$router.push({ name: "profile" });
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
    Logout() {
      this.$store.dispatch("users/Logout");
      this.$router.push({ name: "login" });
      location.reload();

    },
    handleSubmit() {
      this.clearTweet();
      this.$nextTick(() => {
        // Wrapped in $nextTick to ensure DOM is rendered before closing
        this.$refs.modal.hide();
      });
    }
  },
  watch: {
    deep: true,
    textSearch(oldValue, newValue) {
      if (oldValue == "") {
        this.$store.dispatch("tweets/setSearchFinished", false);
      }
    }
  }
};
</script>

<style scoped>
.btn {
  border-radius: 80px;
}
</style>
