<template>
  <b-container>
    <b-alert v-if="users.length == 0" show variant="info">no users here</b-alert>

    <b-row v-for="(user,index) in users" :key="user.id">
      <div>
        <b-card
          :title="user.name"
          :img-src="$store.getters.url+'storage/'+user.cover"
          img-alt="Image"
          img-top
          tag="article"
          width="600"
          height="300"
          style="max-width: 20rem;"
          class="mb-2"
        >
          <b-img
            :src="$store.getters.url+'storage/'+user.avatar"
            rounded="circle"
            width="75"
            heigth="75"
            alt="Circle image"
          ></b-img>
          <b-button href="#" variant="outline-danger" @click="unfollow(user.id,index)">unfollow</b-button>
        </b-card>
      </div>
    </b-row>
  </b-container>
</template>
<script>
export default {
  props: ["users", "type"],
  created() {},
  methods: {
    unfollow(id, index) {
      this.$store
        .dispatch("followers/unFollow", { id: id })
        .then(res => {
          this.users.splice(index, 1);
          this.$emit("removeUser", this.type);
          this.$toaster.success(res.data.success);
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>
