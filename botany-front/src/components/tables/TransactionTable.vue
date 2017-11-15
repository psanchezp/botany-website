<template>
  <md-table class="transaction-table" v-once>
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
      <md-table-row v-for="item of transactionItems" :key="item.ID">
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
          {{ item.quantity }}
        </md-table-cell>
        <md-table-cell>
          {{ item.description }}
        </md-table-cell>
        <md-table-cell :v-if="tableType == 'non-final'">
          <finalize-button
            :transaction-id="item.ID"
          ></finalize-button>
        </md-table-cell>
        <md-table-cell :v-if="tableType == 'non-final'">
          <edit-button
            model="transactions"
            :name="item.ID"
          ></edit-button>
        </md-table-cell>
        <md-table-cell :v-if="tableType == 'non-final'">
          <delete-button
            :name="item.ID"
            variable="transactionID"
            action="DELETE_TRANSACTION"
          ></delete-button>
        </md-table-cell>
      </md-table-row>
    </md-table-body>
  </md-table>
</template>

<script>
import DeleteButton from '@/components/buttons/DeleteButton'
import EditButton from '@/components/buttons/EditButton'
import FinalizeButton from '@/components/buttons/FinalizeButton'

export default {
  name: 'transaction-table',
  data () {
    return {
    }
  },
  props: {
    transactionItems: Array,
    tableType: String
  },
  components: {
    DeleteButton, EditButton, FinalizeButton
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
