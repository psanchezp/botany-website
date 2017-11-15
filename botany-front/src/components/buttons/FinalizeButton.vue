<template>
  <div class="finalize-button">
    <md-button v-on:click="finalizeObject" class="md-icon-button" href="#">
      <md-icon>
        done_all
      </md-icon>
    </md-button>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'finalize-button',
  data () {
    return {
      url: 'http://127.0.0.1/botany-back/applicationLayer.php',
      action: 'FINALIZE_TRANSACTION',
      variable: 'transactionID'
    }
  },
  props: {
    transactionId: String
  },
  methods: {
    finalizeObject (event) {
      event.preventDefault()
      var params = new URLSearchParams()
      params.append(this.variable, this.transactionId)
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