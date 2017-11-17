<template>
  <md-button :style="style" class="md-icon-button" :href="linkToFollow">
    <md-icon>
      keyboard_backspace
    </md-icon>
  </md-button>
</template>

<script>
export default {
  name: 'back-button',
  props: {
    model: String,
    paddingSize: String
  },
  data () {
    return {
    }
  },
  computed: {
    linkToFollow () {
      return '/' + this.model
    },
    style () {
      switch (this.paddingSize) {
        case 'h4':
          return 'margin: 1.2em 0.5em 0 0;'
        case 'h2':
          return 'margin: 2.6em 0.5em 0 0;'
      }
    }
  }
}
</script>

<style scoped>
  .md-icon {
    color: #AAAAAA;
  }

  .md-button {
    display: inline;
  }
</style>