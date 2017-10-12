<template>
  <div class="navigation-bar-template">
    <md-toolbar>
      <md-button class="md-icon-button" @click="toggleLeftSidenav">
        <md-icon>menu</md-icon>
      </md-button>

      <h2 class="md-title" style="flex: 1">
        <a href="/hello" style="color: white">Botany Chips</a>
      </h2>

      <md-button class="md-icon-button">
        <md-icon>account_circle</md-icon>
      </md-button>
      <md-button href="/" class="md-icon-button">
        <md-icon>exit_to_app</md-icon>
      </md-button>
    </md-toolbar>

    <md-sidenav class="md-left" ref="leftSidenav" @open="open('Left')" @close="close('Left')">
      <md-toolbar class="md-large">
        <div class="md-toolbar-container">
          <h3 class="md-title">Menu</h3>
        </div>
      </md-toolbar>
      <ul>
        <li v-for="option in options">
          <a :href="option.url">{{ option.title }}</a>
        </li>
      </ul>
    </md-sidenav>
  </div>
</template>

<script>
export default {
  name: 'navbar',
  data () {
    return {
      options: [
        { title: 'Clientes', url: '/clients' },
        { title: 'Proveedores', url: '/providers' },
        { title: 'Productos', url: '/products' }
      ]
    }
  },
  methods: {
    toggleLeftSidenav () {
      this.$refs.leftSidenav.toggle()
    },
    open (ref) {
    },
    close (ref) {
    }
  }
}
</script>

<style scoped>
ul {
  margin-left: 16px; 
}
</style>