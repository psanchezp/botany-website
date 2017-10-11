<template>
  <div class="button-template">
    <md-button href="/hello">{{ msg }}</md-button>
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