<template>
  <div class="navigation-bar-template">
    <md-toolbar>
      <md-button class="md-icon-button">
        <md-icon>menu</md-icon>
      </md-button>

      <h2 class="md-title" style="flex: 1">Botany Chips</h2>

      <md-button class="md-icon-button">
        <md-icon>account_circle</md-icon>
      </md-button>
      <md-button href="/" class="md-icon-button">
        <md-icon>exit_to_app</md-icon>
      </md-button>
    </md-toolbar>
  </div>
</template>

<script>
export default {
  name: 'navbar',
  data () {
    return {
      options: ['Login', 'Other']
    }
  }
}
</script>

<style scoped>
</style>