<template>
  <b-container>
    <b-row>
      <b-row class="backgroundUser">
        <div>
          <b-img :src="$store.getters.url+$store.getters['users/getCurrentUser'].cover" fluid-grow alt="Fluid-grow image"></b-img>
        </div>
      </b-row>
      <div class="w-100"></div>

      <b-row class="ProfoileImage" cols="3">
        <span>
          <b-img
            thumbnail
            rounded="circle"
            :src="$store.getters.url+$store.getters['users/getCurrentUser'].avatar"
            alt="Image 2"
          ></b-img>
          <span>name</span>
          <br>
          <span>unuqieName</span>
        </span>
      </b-row>

      <b-row class="ProfoileImage" cols="9">
        <b-col>
          <div>
            <h6>Tweet</h6>
            <p>5</p>
          </div>
        </b-col>
        <b-col>
          <div>
            <h6>Following</h6>
            <p>5</p>
          </div>
        </b-col>
        <b-col>
          <div>
            <h6>Followers</h6>
            <p>5</p>
          </div>
        </b-col>
        <b-col>
          <div>
            <h6>Likes</h6>
            <p>5</p>
          </div>
        </b-col>
        <b-col>
          <div>
            <h6>Lists</h6>
            <p>5</p>
          </div>
        </b-col>
        <b-col>
          <div>
            <h6>Moments</h6>
            <p>5</p>
          </div>
        </b-col>

        <b-col>
          <div>
            <b-button>Edit profile</b-button>
          </div>
        </b-col>
      </b-row>
    </b-row>
  </b-container>
</template>
<script>
export default {};
</script>
