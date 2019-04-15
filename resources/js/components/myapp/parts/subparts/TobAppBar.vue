<template>
  <b-container class="bv-example-row">
    <b-row>
      <b-col>
        <b-button href="#" variant="outline-primary">Home</b-button>
      </b-col>
      <b-col>
        <b-button href="#" variant="outline-primary">Notifications</b-button>
      </b-col>
      <b-col>Spinner</b-col>
      <b-col>
        <b-form-input placeholder="Search Twiiter"></b-form-input>
      </b-col>
      <b-col>
        <b-img thumbnail rounded="circle" :src="$store.getters.url+$store.getters['users/getCurrentUser'].avatar" alt="Image 2"></b-img>
      </b-col>
      <b-col cols="1">
        <b-button variant="info">Tweet</b-button>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {};
</script>
