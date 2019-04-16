<template>
  <b-container class="suggestions">
    <b-row>
      <div class="w-100"></div>
      <h5>Who to follow</h5>
    </b-row>
    <b-row v-for="user in suggestUser" :key="user.id">
      <div class="w-100"></div>
      <b-img :src="$store.getters.url+user.avatar" width="38px" height="38px" rounded="circle" alt="Circle image"></b-img>
      <span>
        <span id="nameUser">{{user.name}}</span>
        <br>
        <b-button size="sm" id="followBtn" variant="outline-primary" @click="follow(user.id)">Follow</b-button>
      </span>
    </b-row>
    <div class="w-100"></div>
  </b-container>
</template>

<script>
export default {
    props:['suggestUser'],
    methods: {
        follow(id){
           this.$store.dispatch('followers/StoreFollowers',{follow_id:id})
           .then(res=>{
                if(res.data.success){
                    this.$toaster.success("following done");
                }
           }).catch(err=>{
               if(err.response.data.message.includes("23000")){
                   this.$toaster.info("You already following this person")
               }
           });
        }
    },
};
</script>

<style scoped>
.btn{
     border-radius: 80px;
}
#followBtn,#nameUser{
    margin-left: 25%;
    height: 30%;
    font-size: 10px;
}
</style>
