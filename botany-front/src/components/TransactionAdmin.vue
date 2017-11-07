<template>
  <md-layout md-gutter>
    <md-layout md-flex="80" md-flex-offset="10">
      <h3>Transacciones no finalizadas</h3>
      <md-table v-if="nonFDataLoaded" class="nonfinalized-table" v-once>
        <md-table-header>
          <md-table-row>
            <md-table-cell>Producto</md-table-cell>
            <md-table-cell>Usuario</md-table-cell>
            <md-table-cell>Fecha</md-table-cell>
            <md-table-cell>Estado</md-table-cell>
            <md-table-cell>Cantidad</md-table-cell>
            <md-table-cell>Descripción</md-table-cell>
          </md-table-row>
        </md-table-header>
        <md-table-body>
          <!-- Loop con cada row -->
          <md-table-row v-for="item in nonFTransactions" :key="item">
            <transaction-cell v-for="value in item" :key="value" :item="value"></transaction-cell>
            <div><md-button>Finalizar</md-button></div>
          </md-table-row>
        </md-table-body>
      </md-table>
      <br>
      <h3>Transacciones finalizadas</h3>
      <md-table v-if="FDataLoaded" class="finalized-table" v-once>
        <md-table-header>
          <md-table-row>
            <md-table-cell>Producto</md-table-cell>
            <md-table-cell>Usuario</md-table-cell>
            <md-table-cell>Fecha</md-table-cell>
            <md-table-cell>Estado</md-table-cell>
            <md-table-cell>Cantidad</md-table-cell>
            <md-table-cell>Descripción</md-table-cell>
          </md-table-row>
        </md-table-header>
        <md-table-body>
          <md-table-row v-for="item in FTransactions" :key="item">
            <transaction-cell v-for="value in item" :key="value" :item="value"></transaction-cell>
          </md-table-row>
          <!-- <transaction-actions status="finalized"></transaction-actions> -->
        </md-table-body>
      </md-table>
    </md-layout>
  </md-layout>
</template>

<script>
  import axios from 'axios'
  import TransactionCell from '@/components/tables/TransactionCell'
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
      TransactionCell, NavBar
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