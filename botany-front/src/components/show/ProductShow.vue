<template>
  <md-table class="product-show" v-once>
    <md-table-header>
      <md-table-row>
        <md-table-head>Nombre</md-table-head>
        <md-table-head>Categoria</md-table-head>
        <md-table-head>Medida</md-table-head>
        <md-table-head>Precio</md-table-head>
        <md-table-head>Editar</md-table-head>
        <md-table-head>Borrar</md-table-head>
      </md-table-row>
    </md-table-header>

    <md-table-body>
      <md-table-row>
        <md-table-cell v-if="value != 'SUCCESS'" v-for="(value, key) in productItem" :key="key">
          {{ value }}
        </md-table-cell>
        <md-table-cell>
          <edit-button
            model="products"
            :name="productItem.name"
          >
          </edit-button>
        </md-table-cell>
        <md-table-cell>
          <delete-button
            :variable="variable"
            :name="productItem.name"
            :action="action"
          >  
          </delete-button>
        </md-table-cell>
      </md-table-row>
    </md-table-body>
  </md-table>
</template>

<script>
import DeleteButton from '@/components/buttons/DeleteButton'
import EditButton from '@/components/buttons/EditButton'

export default {
  name: 'product-show',
  data () {
    return {
      variable: 'productName',
      action: 'DELETE_PRODUCT'
    }
  },
  components: {
    DeleteButton, EditButton
  },
  props: {
    productItem: Object
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
