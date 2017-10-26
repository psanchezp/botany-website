<template>
  <div class="generic-table">
    <md-layout md-gutter>
      <md-layout v-if="dataLoaded" md-flex="80" md-flex-offset="10">
        <client-table :client-items="itemList" v-if="model === 'clients'"></client-table>
        <provider-table :provider-items="itemList" v-if="model === 'providers'"></provider-table>
        <product-table :product-items="itemList" v-if="model === 'products'"></product-table>
      </md-layout>
      <md-layout v-if="dataError" md-flex="70" md-flex-offset="15">
        <h5>{{ errorMessage }}</h5>
      </md-layout>
    </md-layout>
  </div>
</template>

<!-- <edit-button :model="model"></edit-button> -->

<script>
import ClientTable from '@/components/tables/ClientTable'
import ProductTable from '@/components/tables/ProductTable'
import ProviderTable from '@/components/tables/ProviderTable'

import axios from 'axios'

export default {
  name: 'generic-table',
  data () {
    return {
      url: 'http://127.0.0.1/botany-back/applicationLayer.php',
      itemList: [],
      dataLoaded: false,
      dataError: false,
      errorMessage: ''
    }
  },
  components: {
    ClientTable, ProviderTable, ProductTable
  },
  props: ['model'],
  created: function () {
    this.getList(this.model)
  },
  methods: {
    getList (model) {
      var params = new URLSearchParams()
      params.append('action', this.getAction(model))
      axios.post(this.url, params)
        .then(function (response) {
          this.retrieveList(response).forEach(function (element) {
            this.itemList.push(element)
          }.bind(this))
          this.dataLoaded = true
        }.bind(this))
        .catch(function (error) {
          this.errorMessage = error.response.data
          this.dataError = true
        }.bind(this))
    },
    getAction (model) {
      switch (model) {
        case 'clients':
          return 'GET_CLIENTS'
        case 'products':
          return 'GET_PRODUCTS'
        case 'providers':
          return 'GET_PROVIDERS'
      }
    },
    retrieveList (response) {
      switch (this.model) {
        case 'clients':
          return response.data.clients
        case 'products':
          return response.data.products
        case 'providers':
          return response.data.providers
      }
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
