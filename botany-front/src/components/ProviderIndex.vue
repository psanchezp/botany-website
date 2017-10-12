<template>
  <div class="provider-index">
    <nav-bar></nav-bar>
    <add-button></add-button>
    <provider-table></provider-table>
  </div>
</template>

<script>
import NavBar from '@/components/NavBar'
import AddButton from '@/components/buttons/AddButton'
import ProviderTable from '@/components/tables/ProviderTable'

export default {
  name: 'provider-index',
  data () {
    return {
      msg: 'Hello!'
    }
  },
  components: {
    NavBar, AddButton, ProviderTable
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
