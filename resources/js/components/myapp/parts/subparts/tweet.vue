<template>
  <b-container>
    <b-row class="ProfoileImage">
      <b-img thumbnail rounded="circle" src="https://picsum.photos/50/50/?image=25" alt="Image 2"></b-img>

      <span>
        <span>name</span>
        <br>
        <p>my tweet here</p>
      </span>
    </b-row>
    <b-row>
      <b-col>
        <b-button variant="outline-primary">
          <i class="material-icons">comment</i>(5)
        </b-button>
      </b-col>
      <b-col>
        <b-button variant="outline-primary">
          <i class="fas fa-exchange-alt"></i>
        </b-button>
      </b-col>
      <b-col>
        <b-button variant="outline-primary">
          <i class="fas fa-heart"></i>
        </b-button>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
export default {};
</script>
