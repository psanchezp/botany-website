<template>
  <md-table class="provider-table" v-once>
    <md-table-header>
      <md-table-row>
        <md-table-head>Usuario</md-table-head>
        <md-table-head>Nombre</md-table-head>
        <md-table-head>Descripción</md-table-head>
        <md-table-head>Telefono</md-table-head>
        <md-table-head>Dirección</md-table-head>
        <md-table-head>Correo</md-table-head>
        <md-table-head>Editar</md-table-head>
        <md-table-head>Borrar</md-table-head>
        <md-table-head>Información</md-table-head>
      </md-table-row>
    </md-table-header>

    <md-table-body>
      <md-table-row v-for="item of providerItems" :key="item.name">
        <md-table-cell>
          {{ item.username }}
        </md-table-cell>
        <md-table-cell>
          {{ item.name }}
        </md-table-cell>
        <md-table-cell>
          {{ item.description }}
        </md-table-cell>
        <md-table-cell>
          {{ item.phone }}
        </md-table-cell>
        <md-table-cell>
          {{ item.address }}
        </md-table-cell>
        <md-table-cell>
          {{ item.email }}
        </md-table-cell>
        <md-table-cell>
          <edit-button
            model="providers"
            :name="item.username"
          >
          </edit-button>
        </md-table-cell>
        <md-table-cell>
          <delete-button
            :variable="variable"
            :name="item.username"
            :action="action"
          >  
          </delete-button>
        </md-table-cell>
        <md-table-cell>
          <info-button
            model="providers"
            :name="item.username"
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
  name: 'provider-table',
  data () {
    return {
      variable: 'username',
      action: 'DELETE_PROVIDER'
    }
  },
  components: {
    DeleteButton, EditButton, InfoButton
  },
  props: {
    providerItems: Array
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
