<template>
  <md-layout md-gutter>
    <md-layout md-flex="80" md-flex-offset="10">
      <h3>Transacciones no finalizadas</h3>
      <transaction-table 
        v-if="nonFDataLoaded" 
        class="nonfinalized-table"
        table-type="non-final"
        :transactionItems="nonFTransactions"
      >
      </transaction-table>
    </md-layout>
    <md-layout md-flex="80" md-flex-offset="10">
      <h3>Transacciones finalizadas</h3>
      <transaction-table
        v-if="FDataLoaded"
        class="finalized-table"
        table-type="final"
        :transactionItems="FTransactions"
      >
      </transaction-table>
    </md-layout>
  </md-layout>
</template>

<script>
  import axios from 'axios'
  import TransactionTable from '@/components/tables/TransactionTable'
  import NavBar from '@/components/NavBar'

  export default {
    data () {
      return {
        FDataLoaded: false,
        nonFDataLoaded: false,
        FTransactions: [],
        nonFTransactions: [],
        url: 'http://127.0.0.1/botany-back/applicationLayer.php'
      }
    },
    components: {
      TransactionTable, NavBar
    },
    created: function () {
      this.loadFT()
      this.loadNonFT()
    },
    methods: {
      loadFT () {
        var params = new URLSearchParams()
        params.append('action', 'GET_FINALIZED_TRANSACTIONS')
        axios.post(this.url, params)
          .then(function (response) {
            this.FTransactions = response.data.transactions
            this.FDataLoaded = true
          }.bind(this))
          .catch(function (error) {
            console.log(error)
          })
      },
      loadNonFT () {
        var params = new URLSearchParams()
        params.append('action', 'GET_NONFINALIZED_TRANSACTIONS')
        axios.post(this.url, params)
          .then(function (response) {
            this.nonFTransactions = response.data.transactions
            this.nonFDataLoaded = true
          }.bind(this))
          .catch(function (error) {
            console.log(error)
          })
      }
    }
  }
</script>

<style scoped>
</style>