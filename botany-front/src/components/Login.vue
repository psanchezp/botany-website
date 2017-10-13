<template>
  <div class="login">
    <h1> {{ title }}</h1>
    <h4> {{ msg }}</h4>
    <md-layout md-gutter>
      <md-layout md-flex="40" md-flex-offset="30">
        <form v-on:submit='login'>
          User: <input v-model='user' type="text" name="username"><br>
          Password: <input v-model='password' type="password" name="userPassword"><br>
          <input v-model='rememberMe' name="rememberMe" type='checkbox'>Remember Me</md-checkbox>
          <input v-model='action' class="hidden" type="text" name="action" value="LOGIN">
          <br>
          <input type="submit" value="Login">
        </form>
      </md-layout>
    </md-layout>
    <!-- <login-button></login-button> -->
  </div>
</template>

<script>
import axios from 'axios'
import LoginButton from '@/components/LoginButton'

export default {
  name: 'login',
  data () {
    return {
      title: 'Botany Chips',
      msg: 'Ingresa con tu usuario y contraseña.',
      url: 'http://localhost/botany-back/applicationLayer.php',
      user: '',
      password: '',
      rememberMe: false,
      action: 'LOGIN'
    }
  },
  components: {
    LoginButton
  },
  methods: {
    login (event) {
      event.preventDefault()
      var params = new URLSearchParams()
      params.append('username', this.user)
      params.append('userPassword', this.password)
      params.append('rememberMe', this.rememberMe)
      params.append('action', this.action)
      axios.post(this.url, params)
        .then(function (response) {
          window.location.replace('/hello')
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>

<style scoped>
  h1, h2 {
    font-weight: bold;
  }

  .login {
    text-align: center;
  }

  form {
    width: 100%;
  }

  .hidden {
    display: none;
  }

  input[type='checkbox'] {
    opacity: 1;
    position: relative;
    left: 0;
  }
</style>