<template>
  <div class="button-template">
    <md-button class="md-accent" href="/hello">{{ msg }}</md-button>
  </div>
</template>

<script>
export default {
  name: 'loginbutton',
  data () {
    return {
      msg: 'Login'
    }
  }
}
</script>

<style scoped>
</style>