<template>
  <div class="hello">
    <nav-bar></nav-bar>
    <div class="content">
      <h1>{{ msg }}</h1>
    </div>
  </div>
</template>

<script>
import NavBar from '@/components/NavBar'

export default {
  name: 'hello',
  data () {
    return {
      msg: 'Hello!'
    }
  },
  components: {
    NavBar
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
  vertical-align: middle; 
}

.content {
  text-align: center;
}
</style>
