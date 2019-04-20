<template>
  <b-container>
    <b-row>
      <b-col>
        <span>
          <b-button variant="outline-primary" @click="tweets()">Tweets({{usrInfo.tweets}})</b-button>
          <b-button variant="outline-primary" @click="replies()">replies({{usrInfo.replies}})</b-button>
          <b-button variant="outline-primary" @click="following()">Following({{usrInfo.following}})</b-button>
          <b-button variant="outline-primary" @click="followers()">Followers({{usrInfo.followers}})</b-button>
        </span>
        <b-button id="editPro" size="sm" variant="outline-dark" @click="profile()">Edit profile</b-button>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <users
          @removeUser="receiveEvent"
          :type="type"
          :users="users"
          v-show="followingOrFollwersTab"
        ></users>
        <tweet @removeTweet="handlerResult" :type="type" :tweets="myTweets" v-show="TweetsTab"></tweet>
        <edit-profile v-show="prfileTab"></edit-profile>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import users from "./subparts/listOfFollowOrFollowers.vue";
import tweet from "./subparts/tweet.vue";
import editProfile from "./subparts/editProfile.vue";
export default {
  components: {
    users,
    tweet,
    editProfile
  },
  data() {
    return {
      myTweets: [],
      users: [],
      type: null,
      profileData: null,
      followingOrFollwersTab: false,
      TweetsTab: true,
      prfileTab: false,
      usrInfo: null
    };
  },
  created() {
    this.fetchMyTweets();
    this.usrInfo = this.$parent.UserStatistic;
    // console.log(this.$parent.UserStatistic);
  },
  methods: {
    handlerResult(id, index, type) {
      this.receiveEvent(id, index);
    },
    receiveEvent(id, index) {
      //  this.users = array;
      if (this.type == "followers") {
        --this.usrInfo.Followers;
      } else if (this.type == "following") {
        --this.usrInfo.following;
      } else if (this.type == "tweets") {
        this.$store
          .dispatch("tweets/DestroyTweets", { id: id })
          .then(res => {
            if (res.data.success) {
              this.$toaster.success(res.data.success);
            }
            --this.usrInfo.tweets;
            this.myTweets.splice(index, 1);
          })
          .catch(err => {
            console.log(err);
          });
      } else if (this.type == "replies") {
        this.$store
          .dispatch("reply/DestroyReply", { id: id })
          .then(res => {
            if (res.data.success) {
              this.$toaster.success(res.data.success);
            }
            --this.usrInfo.replies;
            this.myTweets.splice(index, 1);
          })
          .catch(err => {
            console.log(err);
          });
      }
    },
    tweets() {
      this.TweetsTab = true;
      this.prfileTab = false;
      this.followingOrFollwersTab = false;
      this.fetchMyTweets();
    },
    followers() {
      this.followingOrFollwersTab = true;
      this.TweetsTab = false;
      this.prfileTab = false;
      this.fetchMyFollower();
    },
    following() {
      this.followingOrFollwersTab = true;
      this.TweetsTab = false;
      this.prfileTab = false;
      this.fetchMyFollowing();
    },
    replies() {
      this.followingOrFollwersTab = false;
      this.TweetsTab = true;
      this.prfileTab = false;
      this.fetchReplies();
    },
    profile() {
      this.followingOrFollwersTab = false;
      this.TweetsTab = false;
      this.prfileTab = true;
    },
    fetchMyTweets() {
      this.$store
        .dispatch("tweets/myTweets")
        .then(res => {
          this.myTweets = res.data.tweets;
          this.type = "tweets";
        })
        .catch(err => {
          console.log(err);
        });
    },
    fetchReplies() {
      this.$store
        .dispatch("reply/myReply")
        .then(res => {
          this.myTweets = res.data.tweets;
          this.type = "replies";
        })
        .catch(err => {});
    },
    fetchMyFollowing() {
      this.$store
        .dispatch("followers/myFollowing")
        .then(res => {
          this.users = res.data.users;
          this.type = "following";
        })
        .catch(err => {});
    },
    fetchMyFollower() {
      this.$store
        .dispatch("followers/myFollowers")
        .then(res => {
          this.users = res.data.users;
          this.type = "followers";
        })
        .catch(err => {});
    },
    fetchMyProfileData() {},
    updateProfile() {}
  }
};
</script>
<style>
#editPro {
  margin-left: 7%;
}
</style>
