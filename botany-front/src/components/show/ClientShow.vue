<template>
  <md-table class="client-show" v-once>
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
          {{ clientItem.username }}
        </md-table-cell>
        <md-table-cell>
          {{ clientItem.name }}
        </md-table-cell>
        <md-table-cell>
          {{ clientItem.description }}
        </md-table-cell>
        <md-table-cell>
          {{ clientItem.phone }}
        </md-table-cell>
        <md-table-cell>
          {{ clientItem.address }}
        </md-table-cell>
        <md-table-cell>
          {{ clientItem.email }}
        </md-table-cell>
        <md-table-cell>
          <edit-button
            :model="model"
            :name="clientItem.username"
          >
          </edit-button>
        </md-table-cell>
        <md-table-cell>
          <delete-button
            :variable="variable"
            :name="clientItem.name"
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
  name: 'client-show',
  data () {
    return {
      variable: 'username',
      action: 'DELETE_CLIENT',
      model: 'clients'
    }
  },
  components: {
    DeleteButton, EditButton
  },
  props: {
    clientItem: Object
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
