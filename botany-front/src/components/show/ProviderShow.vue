<template>
  <md-table class="provider-show" v-once>
    <md-table-header>
      <md-table-row>
        <md-table-head>Usuario</md-table-head>
        <md-table-head>Nombre</md-table-head>
        <md-table-head>Descripción</md-table-head>
        <md-table-head>Telefono</md-table-head>
        <md-table-head>Address</md-table-head>
        <md-table-head>Correo</md-table-head>
        <md-table-head>Editar</md-table-head>
        <md-table-head>Borrar</md-table-head>
      </md-table-row>
    </md-table-header>
    <md-table-body>
      <md-table-row>
        <md-table-cell>
          {{ providerItem.username }}
        </md-table-cell>
        <md-table-cell>
          {{ providerItem.name }}
        </md-table-cell>
        <md-table-cell>
          {{ providerItem.description }}
        </md-table-cell>
        <md-table-cell>
          {{ providerItem.phone }}
        </md-table-cell>
        <md-table-cell>
          {{ providerItem.address }}
        </md-table-cell>
        <md-table-cell>
          {{ providerItem.email }}
        </md-table-cell>
        <md-table-cell>
          <edit-button
            model="providers"
            :name="providerItem.username"
          >
          </edit-button>
        </md-table-cell>
        <md-table-cell>
          <delete-button
            :variable="variable"
            :name="providerItem.name"
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
  name: 'provider-show',
  data () {
    return {
      variable: 'username',
      action: 'DELETE_PROVIDER'
    }
  },
  components: {
    DeleteButton, EditButton
  },
  props: {
    providerItem: Object
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
