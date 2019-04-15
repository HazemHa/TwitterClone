<template>
  <b-container>
    <b-row>
      <b-img
        :src="$store.getters.url+$store.getters['users/getCurrentUser'].avatar"
        rounded="circle"
        alt="Circle image"
      ></b-img>

      <b-form-textarea
        id="textarea"
        placeholder="Enter something..."
        rows="3"
        max-rows="6"
      ></b-form-textarea>
    </b-row>

    <b-row>
      <b-button variant="info">Tweet</b-button>
    </b-row>
  </b-container>
</template>

<script>
export default {};
</script>
