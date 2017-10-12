<template>
  <div class="client-index">
    <nav-bar></nav-bar>
    <add-button></add-button>
    <client-table></client-table>
  </div>
</template>

<script>
import NavBar from '@/components/NavBar'
import AddButton from '@/components/buttons/AddButton'
import ClientTable from '@/components/tables/ClientTable'

export default {
  name: 'client-index',
  data () {
    return {
      msg: 'Hello!'
    }
  },
  components: {
    NavBar, AddButton, ClientTable
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
