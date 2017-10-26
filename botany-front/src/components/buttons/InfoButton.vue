<template>
  <div class="info-button">
    <md-button class="md-icon-button" :href="link_to_show">
      <md-icon>
        info
      </md-icon>
    </md-button>
  </div>
</template>

<script>
// import axios from 'axios'

export default {
  name: 'info-button',
  data () {
    return {
    }
  },
  props: {
    model: String,
    name: String
  },
  computed: {
    link_to_show: function () {
      return '/' + this.model + '/' + this.name
    }
  }
}
</script>

<style scoped>
</style>