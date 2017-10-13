<template>
  <div class="delete-button">
    <!-- <md-button class="md-icon-button" href="#">
      <md-icon>
        delete
      </md-icon>
    </md-button> -->
    <form v-on:submit='deleteObject'>
        <input type="text" v-model='username' name="username" value="Alta" class="hidden">
        <input class="hidden" v-model='action' type="text" name="action" value="DELETE_CLIENT">
        <input type="submit" value="delete">
      </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'delete-button',
  data () {
    return {
      url: 'http://127.0.0.1/botany-back/applicationLayer.php',
      username: 'Alta',
      action: 'DELETE_CLIENT'
    }
  },
  methods: {
    deleteObject (event) {
      event.preventDefault()
      var params = new URLSearchParams()
      params.append('username', this.username)
      params.append('action', this.action)
      axios.post(this.url, params)
        .then(function (response) {
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>

<style scoped>
</style>