<template>
  <md-button class="md-icon-button md-raised pink" :href="linkToFollow">
    <md-icon>
      add
    </md-icon>
  </md-button>
</template>

<script>
export default {
  name: 'add-button',
  props: {
    model: String
  },
  data () {
    return {
    }
  },
  computed: {
    linkToFollow () {
      return '/' + this.model + '/new'
    }
  }
}
</script>

<style scoped>
  .md-button {
    margin: -5em;
  }
</style>