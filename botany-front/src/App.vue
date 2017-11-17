<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'app',
  created: function () {
    var params = new URLSearchParams()
    params.append('sessionHash', localStorage.session_hash)
    params.append('action', 'GET_SESSION')
    axios.post('http://localhost/botany-back/applicationLayer.php', params)
      .then(function (response) {
      })
      .catch(function () {
        this.$router.push('/login')
      }.bind(this))
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.pink {
  background-color: #EC407A !important;
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
