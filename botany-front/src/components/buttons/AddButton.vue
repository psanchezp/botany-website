<template>
  <!-- <md-button class="md-icon-button md-raised green">
    <md-icon>
      add
    </md-icon>
  </md-button> -->
  <router-link :to="'link'"></router-link>
</template>

<script>
export default {
  name: 'add-button',
  props: ['link'],
  data () {
    return {
    }
  }
}
</script>

<style scoped>
.add-button {
  text-align: right;
}
</style>