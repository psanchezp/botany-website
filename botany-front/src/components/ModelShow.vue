<template>
  <div class="model-show">
    <nav-bar></nav-bar>
    <h2>{{ name }}</h2>
    <generic-show :model="model" :name="name"></generic-show>
  </div>
</template>

<script>
  import GenericShow from '@/components/GenericShow'
  import NavBar from '@/components/NavBar'
  // import axios from 'axios'

  export default {
    name: 'model-show',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        model: this.$route.params.model,
        name: this.$route.params.name
      }
    },
    components: {
      GenericShow, NavBar
    },
    computed: {
      translatedModel: function () {
        switch (this.model) {
          case 'products':
            return 'Producto'
          case 'providers':
            return 'Proveedor'
          case 'clients':
            return 'Clientes'
          default:
            return 'Administrador'
        }
      }
    }
  }
</script>