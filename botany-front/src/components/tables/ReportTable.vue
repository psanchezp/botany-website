<template>
  <md-table class="report-table" v-once>
    <md-table-header>
      <md-table-row>
        <md-table-head>Usuario</md-table-head>
        <md-table-head>Producto</md-table-head>
        <md-table-head>Fecha</md-table-head>
        <md-table-head>Cantidad</md-table-head>
        <md-table-head>Descripción</md-table-head>
      </md-table-row>
    </md-table-header>

    <md-table-body>
      <md-table-row v-for="item of reportItems" :key="item.ID">
        <md-table-cell>
          {{ item.username }}
        </md-table-cell>
        <md-table-cell>
          {{ item.productName }}
        </md-table-cell>
        <md-table-cell>
          {{ item.transactionDate }}
        </md-table-cell>
        <md-table-cell>
          {{ item.state }}
        </md-table-cell>
        <md-table-cell>
          {{ item.quantity }}
        </md-table-cell>
        <md-table-cell>
          {{ item.description }}
        </md-table-cell>
      </md-table-row>
    </md-table-body>
  </md-table>
</template>

<script>
export default {
  name: 'report-table',
  data () {
    return {
    }
  },
  props: {
    reportItems: Array
  }
}
</script>
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
