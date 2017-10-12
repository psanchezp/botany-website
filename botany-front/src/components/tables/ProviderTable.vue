<template>
  <div class="client-table">
    <md-layout md-gutter>
      <md-layout md-flex="70" md-flex-offset="15">
        <md-table v-once>
          <md-table-header>
            <md-table-row>
              <md-table-head>Nombre</md-table-head>
              <md-table-head>Correo</md-table-head>
              <md-table-head>Telefono</md-table-head>
              <md-table-head>Editar</md-table-head>
              <md-table-head>Borrar</md-table-head>
            </md-table-row>
          </md-table-header>

          <md-table-body>
            <md-table-row v-for="(row, index) in 3" :key="index">
              <md-table-cell>
                <a class="md-transparent" href="/product/x">
                  Juanito
                </a>
              </md-table-cell>
              <md-table-cell>juan@juan.com</md-table-cell>
              <md-table-cell>8115433345</md-table-cell>
              <md-table-cell><edit-button></edit-button></md-table-cell>
              <md-table-cell><delete-button></delete-button></md-table-cell>
            </md-table-row>
          </md-table-body>
        </md-table>
      </md-layout>
    </md-layout>
  </div>
</template>

<script>
import DeleteButton from '@/components/buttons/DeleteButton'
import EditButton from '@/components/buttons/EditButton'

export default {
  name: 'client-table',
  data () {
    return {
    }
  },
  components: {
    DeleteButton, EditButton
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
