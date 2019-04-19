<template>
  <b-container>
    <b-row>
      <b-col>
        <span>
          <b-button variant="outline-primary" @click="tweets()">Tweets</b-button>
          <b-button variant="outline-primary" @click="following()">Following</b-button>
          <b-button variant="outline-primary" @click="followers()">Followers</b-button>
        </span>
        <b-button id="editPro" size="sm" variant="outline-dark" @click="profile()">Edit profile</b-button>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <users  :users="users" v-show="followingOrFollwersTab"></users>
        <tweet :tweets="myTweets" v-show="TweetsTab"></tweet>
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
        myTweets:[],
        users:[],
        profileData:null,
      followingOrFollwersTab: false,
      TweetsTab: true,
      prfileTab: false
    };
  },
  methods: {
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
    profile() {
      this.followingOrFollwersTab = false;
      this.TweetsTab = false;
      this.prfileTab = true;
    },
    fetchMyTweets(){
       this.$store.dispatch('tweets/myTweets')
       .then(res=>{
           this.myTweets = res.data.tweets;
       }).catch(err=>{
           console.log(err);
       })
    },
    fetchMyFollowing(){
        this.$store.dispatch('followers/myFollowers')
        .then(res=>{
 this.users = res.data.users;
        }).catch(err=>{

        });

    },
    fetchMyFollower(){
          this.$store.dispatch('followers/myFollowing')
        .then(res=>{
 this.users = res.data.users;

        }).catch(err=>{

        });


    },
    fetchMyProfileData(){

    },
    updateProfile(){

    }
  }
};
</script>
<style>
#editPro {
  margin-left: 7%;
}
</style>
