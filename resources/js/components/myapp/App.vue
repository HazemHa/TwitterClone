<template>
  <b-container class="bv-example-row">
    <TobAppBar  v-if="$store.getters['users/isAuth']"></TobAppBar>
    <b-row>
      <b-col cols="4" v-if="$store.getters['users/isAuth']">
        <previewInfo :UserStatistic="UserStatistic" v-if="$store.getters['users/isAuth']"></previewInfo>
        <br>
        <br>
        <suggestions :suggestUser="suggestUser" v-if="$store.getters['users/isAuth']"></suggestions>
        <br>
        <br>
        <listOfTag :tags="tags" v-if="$store.getters['users/isAuth']"></listOfTag>
      </b-col>
      <b-col cols="8">
        <router-view></router-view>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import suggestions from "./parts/subparts/suggestions.vue";
import listOfTag from "./parts/subparts/lastTag.vue";
import previewInfo from "./parts/subparts/previewInfo.vue";
import TobAppBar from "./parts/subparts/TobAppBar.vue";

export default {
  components: {
    suggestions,
    listOfTag,
    previewInfo,
    TobAppBar
  },
  data() {
    return {
      tags: [],
      suggestUser: [],
      UserStatistic: { tweets: 0, followers: 0, following: 0, replies: 0 }
    };
  },
  methods: {
    fetchTags() {
      this.$store
        .dispatch("tweets/TagsData")
        .then(res => {
          this.tags = res.data.data;
          this.$router.push({ name: "home" });
        })
        .catch(err => {});
    },
    fetchUserInfo() {
      this.$store
        .dispatch("users/UserStatistic")
        .then(res => {
          this.UserStatistic = res.data;
        })
        .catch(err => {
          if (err.response.data.message.includes("Unauthenticated")) {
            this.$router.push({ name: "login" });
          }
        });
    },
    fetchSuggestionsUser() {
      this.$store
        .dispatch("users/UserFoRSuggestions")
        .then(res => {
          this.suggestUser = res.data.data;
        })
        .catch(err => {});
    }
  },
  created() {
    this.$store
      .dispatch("users/setTokenForRequest")
      .then(res => {
        console.log(res);
        this.$router.push({ name: "home" });
        this.fetchUserInfo();
        this.fetchSuggestionsUser();
        this.fetchTags();
      })
      .catch(err => {});
  }
};
</script>
