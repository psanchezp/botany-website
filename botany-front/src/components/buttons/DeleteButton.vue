<template>
  <div class="delete-button">
    <md-button v-on:click="deleteObject" class="md-icon-button" href="#">
      <md-icon>
        delete
      </md-icon>
    </md-button>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'delete-button',
  data () {
    return {
      url: 'http://127.0.0.1/botany-back/applicationLayer.php'
    }
  },
  props: {
    name: String,
    variable: String,
    action: String
  },
  methods: {
    deleteObject (event) {
      event.preventDefault()
      var params = new URLSearchParams()
      params.append(this.variable, this.name)
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