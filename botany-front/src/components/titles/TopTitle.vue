<template>
  <md-layout class="top-title" md-gutter>
      <md-layout :md-flex-offset="offset">
        <h2>{{ model }}</h2>      
      </md-layout>
    </md-layout>
</template>

<script>
  export default {
    name: 'top-title',
    data () {
      return {
      }
    },
    props: {
      model: String,
      offset: Number
    }
  }
</script>

<style scoped>
</style>