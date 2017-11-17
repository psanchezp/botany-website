<template>
  <div class="login">
    <md-layout md-gutter>
      <md-layout class="login-box" md-flex="40" md-flex-offset="30">
        <h2> {{ title }}</h2>
        <h4> {{ msg }}</h4>
        <form v-on:submit='login'>
          <label>Usuario</label> 
          <input v-model='user' type="text" name="username"><br>
          <label>Contraseña</label>
          <input v-model='password' type="password" name="userPassword"><br>
          <input v-model='action' class="hidden" type="text" name="action" value="LOGIN">
          <br>
          <input class="md-button pink" type="submit" value="Login">
        </form>
      </md-layout>
    </md-layout>

    <md-dialog-alert
      :md-content="alert.content"
      :md-ok-text="alert.ok"
      ref="errorDialog">
    </md-dialog-alert>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'login',
  data () {
    return {
      title: 'Botany Chips',
      msg: 'Ingresa con tu usuario y contraseña.',
      url: 'http://localhost/botany-back/applicationLayer.php',
      user: '',
      password: '',
      action: 'LOGIN',
      alert: {
        content: 'Contraseña o Usuario incorrectos',
        ok: 'Ok'
      }
    }
  },
  methods: {
    login (event) {
      event.preventDefault()
      var params = new URLSearchParams()
      params.append('username', this.user)
      params.append('userPassword', this.password)
      params.append('action', this.action)
      axios.post(this.url, params)
        .then(function (response) {
          localStorage.setItem('session_hash', response.data.sessionHash)
          this.$router.push('/')
        }.bind(this))
        .catch(function (error) {
          this.openDialog('errorDialog', error)
        }.bind(this))
    },
    openDialog (ref, error) {
      console.log(error)
      this.$refs[ref].open()
    },
    closeDialog (ref) {
      this.$refs[ref].close()
    }
  }
}
</script>

<style scoped>
  form {
    width: 100%;
  }

  .login-box {
    background: #FDFDFD;
    padding: 1em 2em;
    border-radius: 4px;
    margin-top: 6em;
  }
</style>