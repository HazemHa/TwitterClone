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
          <b-button variant="outline-primary" @click="reply(tweet.id)" size="sm">
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
  </b-container>
</template>
<script>
export default {
  props: ["tweets"],

  methods:{
      reply(id){
       alert("reply "+id);
      },
      love(id){
       alert("love "+id);
      },
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
