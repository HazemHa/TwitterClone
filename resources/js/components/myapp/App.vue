<template>
  <b-container class="bv-example-row">
    <TobAppBar v-if="$store.getters['users/isAuth']"></TobAppBar>
    <b-row>
      <b-col cols="4" v-if="$store.getters['users/isAuth']">
        <previewInfo></previewInfo>
        <suggestions></suggestions>
        <listOfTag></listOfTag>
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
    return {};
  },
  created() {
    this.$store
      .dispatch("users/setTokenForRequest")
      .then(res => {
          this.$router.push({name:'home'})
      })
      .catch(err => {});
  }
};
</script>
