<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.green {
  background-color: #66BB6A;
  color: white !important;
}

.red {
  background-color: #F44336;
  color: white !important;
}

.hidden {
  display: none;
}
</style>
