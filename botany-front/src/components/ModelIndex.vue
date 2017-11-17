<template>
  <div class="model-index">
    <nav-bar></nav-bar>
    <top-title
      :model="model"
      :translation="translatedModel"
      :offset="5"
      showBack=false
    ></top-title>
    <md-layout class="button-div">
      <add-button :model="model"></add-button>
    </md-layout>
    <generic-table :model="model"></generic-table>
  </div>
</template>

<script>
  import GenericTable from '@/components/GenericTable'
  import NavBar from '@/components/NavBar'
  import TopTitle from '@/components/titles/TopTitle'
  import AddButton from '@/components/buttons/AddButton'
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
      GenericTable, NavBar, TopTitle, AddButton
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

<style scoped>
  .button-div {
    float: right;
  }
</style>