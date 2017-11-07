<template>
  <div class="generic-show">
    <md-layout md-gutter>
      <md-layout v-if="dataLoaded" md-flex="70" md-flex-offset="15">
        <client-show :client-item="item" v-if="model === 'clients'"></client-show>
        <provider-show :provider-item="item" v-if="model === 'providers'"></provider-show>
        <product-show :product-item="item" v-if="model === 'products'"></product-show>
      </md-layout>
    </md-layout>
  </div>
</template>

<script>
import ClientShow from '@/components/show/ClientShow'
import ProductShow from '@/components/show/ProductShow'
import ProviderShow from '@/components/show/ProviderShow'

import axios from 'axios'

export default {
  name: 'generic-show',
  data () {
    return {
      url: 'http://127.0.0.1/botany-back/applicationLayer.php',
      item: {},
      dataLoaded: false
    }
  },
  components: {
    ClientShow, ProviderShow, ProductShow
  },
  props: {
    model: String,
    name: String
  },
  created: function () {
    this.getItem(this.model)
  },
  methods: {
    getItem (model) {
      var params = new URLSearchParams()
      params.append('action', this.getAction(model))
      params.append(this.getName(model), this.name)
      axios.post(this.url, params)
        .then(function (response) {
          this.item = response.data
          this.dataLoaded = true
        }.bind(this))
        .catch(function (error) {
          console.log(error)
        })
    },
    getAction (model) {
      switch (model) {
        case 'clients':
          return 'READ_CLIENT'
        case 'products':
          return 'READ_PRODUCT'
        case 'providers':
          return 'READ_PROVIDER'
      }
    },
    getName (model) {
      switch (model) {
        case 'clients':
          return 'username'
        case 'products':
          return 'productName'
        case 'providers':
          return 'username'
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
