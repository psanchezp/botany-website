<template>
  <div class="model-edit">
    <nav-bar></nav-bar>
    <generic-edit :model="model" :name="name"></generic-edit>
  </div>
</template>

<script>
  import GenericEdit from '@/components/GenericEdit'
  import NavBar from '@/components/NavBar'

  export default {
    name: 'model-edit',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        model: this.$route.params.model,
        name: this.$route.params.name
      }
    },
    components: {
      GenericEdit, NavBar
    }
  }
</script>