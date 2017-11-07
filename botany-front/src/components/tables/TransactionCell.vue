<template>
  <md-table-cell>{{ item }}</md-table-cell>
</template>

<script>
  export default {
    data () {
      return {
      }
    },
    props: {
      item: [String, Date, Number]
    },
    methods: {
    }
  }
</script>

<style>
</style>