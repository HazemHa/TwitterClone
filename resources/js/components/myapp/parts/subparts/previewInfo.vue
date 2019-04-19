<template>
  <b-container>
    <b-row>
      <b-row>
        <b-col>
          <b-img
            thumbnail
            fluid
            :src="$store.getters.url+$store.getters['users/getCurrentUser'].cover"
            width="160px"
            height="160px"
            alt="Image 1"
          ></b-img>
          <div>
            <span class="ProfoileImage">
              <b-img
                thumbnail
                rounded="circle"
                :src="$store.getters.url+$store.getters['users/getCurrentUser'].avatar"
                width="65px"
                height="65px"
                alt="Image 2"
              ></b-img>
              <span class="infoUser">
                <span>{{$store.getters['users/getCurrentUser'].name}}</span>
                <br>
                <span>{{$store.getters['users/getCurrentUser'].username}}</span>
              </span>
            </span>
          </div>
        </b-col>
        <br>
        <br>
        <br>
      </b-row>

      <b-row id="userstatistics">
          <br>
          <br>
        <b-col>
          <div>tweets</div>
          <div>{{UserStatistic.tweets}}</div>
        </b-col>
        <b-col>
          <div>Followers</div>
          <div>{{UserStatistic.followers}}</div>
        </b-col>
        <b-col>
          <div>following</div>
          <div>{{UserStatistic.following}}</div>
        </b-col>
      </b-row>
      <br>
      <br>

    </b-row>
  </b-container>
</template>
<script>
export default {
    props:['UserStatistic'],
};
</script>
<style>
.ProfoileImage {
  position: relative;
  top: -25px;
}
.infoUser {
  position: absolute;
  top: 0px;
}
#userstatistics{
    padding-top: 15%;
}
</style>

