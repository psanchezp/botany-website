<template>
  <div class="generic-form">
    <md-layout md-gutter>
      <md-layout md-flex="40" md-flex-offset="30">
        <back-button padding-size="h4" :model="model"></back-button>
        <h4>Nuevo {{ translatedModel }}</h4>
        <client-form
          action="REGISTER_CLIENT"
          v-if="model === 'clients'"
        ></client-form>
        <provider-form
          action="REGISTER_PROVIDER"
          v-if="model === 'providers'"
        ></provider-form>
        <product-form
          action="REGISTER_PRODUCT"
          v-if="model === 'products'"
        ></product-form>
      </md-layout>
    </md-layout>
  </div>
</template>

<script>
  import ProductForm from '@/components/forms/ProductForm'
  import ProviderForm from '@/components/forms/ProviderForm'
  import ClientForm from '@/components/forms/ClientForm'
  import BackButton from '@/components/buttons/BackButton'

  export default {
    name: 'generic-form',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php'
      }
    },
    components: {
      ProductForm, ProviderForm, ClientForm, BackButton
    },
    props: {
      model: String
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