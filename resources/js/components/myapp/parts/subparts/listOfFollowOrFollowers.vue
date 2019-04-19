<template>
  <b-container>
    <b-row v-for="user in users" :key="user.id">
      <div>
        <b-card
          :title="user.name"
          :img-src="$store.getters.url+user.cover"
          img-alt="Image"
          img-top
          tag="article"
          width="600"
          height="300"
          style="max-width: 20rem;"
          class="mb-2"
        >
         <b-img
        :src="$store.getters.url+user.avatar"
        rounded="circle"
        width="75"
        heigth="75"
        alt="Circle image"
      ></b-img>
          <b-button href="#"  variant="outline-primary">follow</b-button>
        </b-card>
      </div>
    </b-row>
  </b-container>
</template>
<script>
export default {
    props:['users'],
};
</script>
