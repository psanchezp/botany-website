<template>
  <div class="model-index">
    <nav-bar></nav-bar>
    <h2>{{ translatedModel }}</h2>
    <generic-table :model="model"></generic-table>
  </div>
</template>

<script>
  import GenericTable from '@/components/GenericTable'
  import NavBar from '@/components/NavBar'
  // import axios from 'axios'

  export default {
    name: 'model-index',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        model: this.$route.params.model
      }
    },
    components: {
      GenericTable, NavBar
    },
    computed: {
      translatedModel: function () {
        switch (this.model) {
          case 'products':
            return 'Productos'
          case 'providers':
            return 'Proveedores'
          case 'clients':
            return 'Clientes'
          default:
            return 'Administradores'
        }
      }
    }
  }
</script>