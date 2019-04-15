<template>
  <div>
    <authorized-clients>
      <writeTweet></writeTweet>
    </authorized-clients>
    <br>
    <br>
    <tweet></tweet>
  </div>
</template>

<script>
import writeTweet from "./subparts/writeTweet.vue";
import tweet from "./subparts/tweet.vue";

export default {
  components: {
    writeTweet: writeTweet,
    tweet: tweet,
  }
};
</script>
