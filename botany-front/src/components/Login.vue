<template>
  <div class="login">
    <h1> {{ title }}</h1>
    <h4> {{ msg }}</h4>
    <form id="form" v-on:submit.prevent="login">
      <input type="text" id="user-input" placeholder="Username">
      <input type="password" id="password-input" placeholder="password">
      <input type="submit" id="login-button" value="Login">
    </form>
  </div>
</template>

<script>
  export default {
    name: 'login',
    data () {
      return {
        title: 'Botany Chips',
        msg: 'Ingresa con tu usuario y contraseña.'
      }
    }
  }
</script>

<style scoped>
  h1, h2 {
    font-weight: bold;
  }
</style>