<template>
  <b-container class="listTags">
    <b-row>
      <div class="w-100"></div>
      <h5>Trends for you</h5>
    </b-row>
    <b-row v-for="(index, tag) in tags" :key="index">
      <div class="w-100"></div>
      <div>
        <router-link :to="{name:'tag',params:{text:tag}}" tag="b-link"><b-link href="#foo">#{{tag}}</b-link></router-link>
        <div style="font-size: 10px;font-family: Arial, Helvetica, sans-serif;">{{tags[tag]}} tweets</div>
      </div>
    </b-row>
  </b-container>
</template>

<script>
export default {
  props: ["tags"]
};
</script>
