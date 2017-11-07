<template>
  <div class="model-new">
    <nav-bar></nav-bar>
    <transaction-new v-if="model == 'transaction'"></transaction-new>
    <generic-form v-else :model="model"></generic-form>
  </div>
</template>

<script>
  import NavBar from '@/components/NavBar'
  import GenericForm from '@/components/GenericForm'
  import TransactionNew from '@/components/TransactionNew'
  // import axios from 'axios'

  export default {
    name: 'model-new',
    data () {
      return {
        model: this.$route.params.model
      }
    },
    components: {
      GenericForm, NavBar, TransactionNew
    }
  }
</script>