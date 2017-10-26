<template>
  <div class="generic-form">
    <md-layout md-gutter>
      <md-layout md-flex="40" md-flex-offset="30">
        <h4>Nuevo {{ translatedModel }}</h4>
        <client-form v-if="model === 'clients'"></client-form>
        <provider-form v-if="model === 'providers'"></provider-form>
        <product-form v-if="model === 'products'"></product-form>
      </md-layout>
    </md-layout>
  </div>
</template>

<script>
  import ProductForm from '@/components/forms/ProductForm'
  import ProviderForm from '@/components/forms/ProviderForm'
  import ClientForm from '@/components/forms/ClientForm'
  // import axios from 'axios'

  export default {
    name: 'generic-form',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        model: this.$route.params.model
      }
    },
    components: {
      ProductForm, ProviderForm, ClientForm
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
    }
  }
</script>