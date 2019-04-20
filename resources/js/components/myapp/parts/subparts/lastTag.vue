<template>
  <b-container class="listTags">
    <b-row>
      <div class="w-100"></div>
      <h5>Trends for you</h5>
    </b-row>
    <b-alert v-if="tags.length == 0" show variant="info">no tags in trend</b-alert>
    <b-row v-for="(tag, index) in tags" :key="index">
      <div class="w-100"></div>
      <div>
        <router-link :to="{name:'tag',params:{text:tag.name}}" tag="b-link"><b-link href="#foo">#{{tag.name}}</b-link></router-link>
        <div style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;">{{tag.count}} tweets</div>
      </div>
    </b-row>
  </b-container>
</template>

<script>
export default {
  props: ["tags"],
  methods:{
      t(){
      }
  }
};
</script>
