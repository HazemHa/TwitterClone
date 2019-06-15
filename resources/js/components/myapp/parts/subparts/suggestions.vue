<template>
  <b-container class="suggestions">
    <b-row>
      <div class="w-100"></div>
      <h5>Who to follow</h5>
    </b-row>
            <b-alert v-if="suggestUser.length == 0" show variant="info">no suggested Users</b-alert>

    <b-row v-for="(user,index) in suggestUser" :key="user.id">
      <div class="w-100"></div>
      <b-img :src="$store.getters.url+'storage/'+user.avatar" width="38px" height="38px" rounded="circle" alt="Circle image"></b-img>
      <span>
        <span id="nameUser">{{user.name}}</span>
        <br>
        <b-button size="sm" id="followBtn" variant="outline-primary" @click="follow(user.id,index)">Follow</b-button>
      </span>
    </b-row>
    <div class="w-100"></div>
  </b-container>
</template>

<script>
export default {
    props:['suggestUser'],
    methods: {
        follow(id,index){
           this.$store.dispatch('followers/StoreFollowers',{follow_id:id})
           .then(res=>{
                if(res.data.success){
                    this.suggestUser.splice(index,1);
                    this.$toaster.success("following done");
                }
                if(res.data.message){
                   this.$toaster.info(res.data.message);

                }
           }).catch(err=>{

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
