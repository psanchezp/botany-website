<template>
  <div class="transaction-index">
    <nav-bar></nav-bar>
    <transaction-admin v-if="model == 'admin'" :model="model"></transaction-admin>
    <transaction-user v-else :model="model" :name="name"></transaction-user>
  </div>
</template>

<script>
  import TransactionAdmin from '@/components/TransactionAdmin'
  import TransactionUser from '@/components/TransactionUser'
  import NavBar from '@/components/NavBar'

  export default {
    name: 'transaction-index',
    data () {
      return {
        model: this.$route.params.model,
        name: this.$route.params.name
      }
    },
    components: {
      TransactionAdmin, TransactionUser, NavBar
    }
  }
</script>