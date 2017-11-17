<template>
  <md-layout class="top-title" md-gutter>
      <md-layout :md-flex-offset="offset">
        <back-button v-if="showBack === 'true'" :model="model" padding-size="h2"></back-button>
        <h2>{{ translation }}</h2>      
      </md-layout>
    </md-layout>
</template>

<script>
  import BackButton from '@/components/buttons/BackButton'

  export default {
    name: 'top-title',
    data () {
      return {
      }
    },
    props: {
      model: String,
      offset: Number,
      translation: String,
      showBack: String
    },
    components: {
      BackButton
    }
  }
</script>

<style scoped>
</style>