<template>
  <md-table class="product-table" v-once>
    <md-table-header>
      <md-table-row>
        <md-table-head>Nombre</md-table-head>
        <md-table-head>Categoria</md-table-head>
        <md-table-head>Medida</md-table-head>
        <md-table-head>Precio</md-table-head>
        <md-table-head>Editar</md-table-head>
        <md-table-head>Borrar</md-table-head>
        <md-table-head>Información</md-table-head>
      </md-table-row>
    </md-table-header>

    <md-table-body>
      <md-table-row v-for="item of productItems" :key="item.name">
        <md-table-cell>
          {{ item.name }}
        </md-table-cell>
        <md-table-cell>
          {{ item.category }}
        </md-table-cell>
        <md-table-cell>
          {{ item.measure }}
        </md-table-cell>
        <md-table-cell>
          {{ item.price }}
        </md-table-cell>
        <md-table-cell>
          <edit-button
            model="products"
            :name="item.name"
          >
          </edit-button>
        </md-table-cell>
        <md-table-cell>
          <delete-button
            :variable="variable"
            :name="item.name"
            :action="action"
          >  
          </delete-button>
        </md-table-cell>
        <md-table-cell>
          <info-button
            model="products"
            :name="item.name"
          >
          </info-button>
        </md-table-cell>
      </md-table-row>
    </md-table-body>
  </md-table>
</template>

<script>
import DeleteButton from '@/components/buttons/DeleteButton'
import EditButton from '@/components/buttons/EditButton'
import InfoButton from '@/components/buttons/InfoButton'

export default {
  name: 'product-table',
  data () {
    return {
      variable: 'productName',
      action: 'DELETE_PRODUCT'
    }
  },
  components: {
    DeleteButton, EditButton, InfoButton
  },
  props: {
    productItems: Array
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
