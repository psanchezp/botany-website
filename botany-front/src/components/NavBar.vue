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
      <form v-on:submit='logout'>
        <input class="hidden" v-model='action' type="text" name="action" value="LOGOUT">
        <input type="submit" value="logout">
      </form>
    </md-toolbar>

    <md-sidenav class="md-left" ref="leftSidenav" @open="open('Left')" @close="close('Left')">
      <md-toolbar class="md-large">
        <div class="md-toolbar-container">
          <h3 class="md-title">Menu</h3>
        </div>
      </md-toolbar>
      <ul>
        <li v-for="option in options">
          <router-link :to="option.url">{{ option.title }}</router-link>
        </li>
      </ul>
    </md-sidenav>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'navbar',
  data () {
    return {
      options: [
        { title: 'Clientes', url: '/clients' },
        { title: 'Proveedores', url: '/providers' },
        { title: 'Productos', url: '/products' }
      ],
      url: 'http://127.0.0.1/botany-back/applicationLayer.php',
      action: 'LOGOUT'
    }
  },
  methods: {
    toggleLeftSidenav () {
      this.$refs.leftSidenav.toggle()
    },
    open (ref) {
    },
    close (ref) {
    },
    logout (event) {
      event.preventDefault()
      var params = new URLSearchParams()
      params.append('action', this.logout)
      axios.post(this.url, params)
        .then(function (response) {
          window.location.replace('/')
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>

<style scoped>
ul {
  margin-left: 16px; 
}
</style>