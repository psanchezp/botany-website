<!-- CAMBIAR A SOLO TABLES DE USUARIO -->
<template>
  <md-layout md-gutter>
    <md-layout v-if="dataLoaded" md-flex="80" md-flex-offset="10">
      <h3>Transacciones no finalizadas</h3>
      <md-table class="nonfinalized-table" v-once>
        <md-table-header>
          <md-table-row>
            <md-table-cell>Producto</md-table-cell>
            <md-table-cell>Usuario</md-table-cell>
            <md-table-cell>Tipo de transaccion</md-table-cell>
            <md-table-cell>Fecha</md-table-cell>
            <md-table-cell>Estado</md-table-cell>
            <md-table-cell>Cantidad</md-table-cell>
            <md-table-cell>Descripción</md-table-cell>
          </md-table-row>
        </md-table-header>
        <md-table-body>
          <!-- Loop con cada row -->
          <transaction-cell></transaction-cell>
          <!-- <transaction-actions status="nonFinalized"></transaction-actions> -->
        </md-table-body>
      </md-table>
      <br>
      <h3>Transacciones finalizadas</h3>
      <md-table class="finalized-table" v-once>
        <md-table-header>
          <md-table-row>
            <md-table-cell>Producto</md-table-cell>
            <md-table-cell>Usuario</md-table-cell>
            <md-table-cell>Tipo de transaccion</md-table-cell>
            <md-table-cell>Fecha</md-table-cell>
            <md-table-cell>Estado</md-table-cell>
            <md-table-cell>Cantidad</md-table-cell>
            <md-table-cell>Descripción</md-table-cell>
          </md-table-row>
        </md-table-header>
        <md-table-body>
          <transaction-cell></transaction-cell>
          <!-- <transaction-actions status="nonFinalized"></transaction-actions> -->
        </md-table-body>
      </md-table>
    </md-layout>
  </md-layout>
</template>

<script>
  // import axios from 'axios'
  import TransactionCell from '@/components/tables/TransactionCell'
  import NavBar from '@/components/NavBar'

  export default {
    data () {
      return {
        dataLoaded: true
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
      },
      loadNonFT () {
      }
    }
  }
</script>

<style scoped>
</style>