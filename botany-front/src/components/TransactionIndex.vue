<template>
  <div class="transaction-index">
    <nav-bar></nav-bar>
    <transaction-admin v-if="model == 'admin'" :model="model"></transaction-admin>
    <transaction-user v-else :model="model" :name="name"></transaction-user>
  </div>
</template>

<script>
  import TransactionAdmin from '@/components/TransactionAdmin'
  import TransactionUser from '@/components/TransactionUser'
  import NavBar from '@/components/NavBar'
  import axios from 'axios'

  export default {
    name: 'transaction-index',
    data () {
      return {
        model: '',
        name: this.$route.params.name,
        url: 'http://127.0.0.1/botany-back/applicationLayer.php'
      }
    },
    components: {
      TransactionAdmin, TransactionUser, NavBar
    },
    created: function () {
      this.checkUser()
    },
    methods: {
      checkUser () {
        var params = new URLSearchParams()
        params.append('action', 'GET_CURRENT_USER')
        axios.post(this.url, params)
          .then(function (response) {
            this.model = response.data.type
          }.bind(this))
          .catch(function (error) {
            console.log(error)
          })
      }
    }
  }
</script>