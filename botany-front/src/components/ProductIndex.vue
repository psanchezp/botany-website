<template>
  <div class="product-index">
    <nav-bar></nav-bar>
    <add-button></add-button>
    <product-table></product-table>
  </div>
</template>

<script>
import NavBar from '@/components/NavBar'
import AddButton from '@/components/buttons/AddButton'
import ProductTable from '@/components/tables/ProductTable'

export default {
  name: 'product-index',
  data () {
    return {
      msg: 'Hello!'
    }
  },
  components: {
    NavBar, AddButton, ProductTable
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
