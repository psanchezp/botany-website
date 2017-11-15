<template>
  <div class="model-show">
    <nav-bar></nav-bar>
    <top-title :model="uppercaseName" :offset="15"></top-title>
    <generic-show :model="model" :name="name"></generic-show>
  </div>
</template>

<script>
  import GenericShow from '@/components/GenericShow'
  import NavBar from '@/components/NavBar'
  import TopTitle from '@/components/titles/TopTitle'
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
      GenericShow, NavBar, TopTitle
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
      },
      uppercaseName: function () {
        return (this.name.charAt(0)).toUpperCase() + (this.name).slice(1)
      }
    }
  }
</script>