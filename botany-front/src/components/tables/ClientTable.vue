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
                <a class="md-transparent" href="/client/x">
                  Juanito
                </a>
              </md-table-cell>
              <md-table-cell>juan@juan.com</md-table-cell>
              <md-table-cell>8115433345</md-table-cell>
              <md-table-cell>
                <edit-button link-prop="/edit/client/x"></edit-button>
              </md-table-cell>
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

// import axios from 'axios'

export default {
  name: 'client-table',
  data () {
    return {
      url: 'http://127.0.0.1/botany-back/applicationLayer.php'
    }
  },
  components: {
    DeleteButton, EditButton
  },
  created: function () {
    this.getClientList()
  },
  methods: {
    getClientList () {
      // var url = 'http://localhost/botany-back/applicationLayer.php'
      // axios.get(url, { action: 'GET_CLIENTS' })
      // axios({
      //   method: 'post',
      //   url: url,
      //   dataType: 'json',
      //   contentType: 'application/x-www-form-urlencoded',
      //   headers: { 'action': 'GET_CLIENTS' },
      //   data: {
      //     'action': 'GET_CLIENTS'
      //   }
      // }).then(function (response) {
      //   console.log(response)
      // })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .md-table {
    width: 100%;
  }
</style>
