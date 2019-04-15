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
                <span>name</span>
                <br>
                <span>name</span>
              </span>
            </span>
          </div>
        </b-col>
      </b-row>

      <b-row>
        <b-col>
          <div>tweets</div>
          <div>5</div>
        </b-col>
        <b-col>
          <div>Followers</div>
          <div>1</div>
        </b-col>
        <b-col>
          <div>following</div>
          <div>2</div>
        </b-col>
      </b-row>
    </b-row>
  </b-container>
</template>
<script>
export default {};
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
</style>

