<template>
  <div class="generic-form">
    <md-layout md-gutter>
      <md-layout md-flex="40" md-flex-offset="30">
        <h4>Editar {{ translatedModel }}</h4>
        <client-form 
          :item="item"
          action="UPDATE_CLIENT"
          v-if="model === 'clients' && dataLoaded === true"
        ></client-form>
        <provider-form
          :item="item"
          action="UPDATE_PROVIDER"
          v-if="model === 'providers' && dataLoaded === true"
        ></provider-form>
        <product-form
          :item="item"
          action="UPDATE_PRODUCT"
          v-if="model === 'products' && dataLoaded === true"
        ></product-form>
      </md-layout>
    </md-layout>
  </div>
</template>

<script>
  import ProductForm from '@/components/forms/ProductForm'
  import ProviderForm from '@/components/forms/ProviderForm'
  import ClientForm from '@/components/forms/ClientForm'
  import axios from 'axios'

  export default {
    name: 'generic-form',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        item: {},
        dataLoaded: false
      }
    },
    components: {
      ProductForm, ProviderForm, ClientForm
    },
    props: {
      model: String,
      name: String
    },
    computed: {
      translatedModel: function () {
        switch (this.model) {
          case 'products':
            return 'producto'
          case 'providers':
            return 'proveedor'
          case 'clients':
            return 'cliente'
          default:
            return 'administrador'
        }
      }
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