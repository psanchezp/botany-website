<template>
  <div class="model-new">
    <nav-bar></nav-bar>
    <generic-form :model="model"></generic-form>
  </div>
</template>

<script>
  import NavBar from '@/components/NavBar'
  import GenericForm from '@/components/GenericForm'
  // import axios from 'axios'

  export default {
    name: 'model-new',
    data () {
      return {
        model: 'products'
      }
    },
    components: {
      GenericForm, NavBar
    }
  }
</script>