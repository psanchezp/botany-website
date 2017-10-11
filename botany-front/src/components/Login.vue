<template>
  <div class="login">
    <h1> {{ title }}</h1>
    <h4> {{ msg }}</h4>
    <login-button></login-button>
  </div>
</template>

<script>
import LoginButton from '@/components/LoginButton'

export default {
  name: 'login',
  data () {
    return {
      title: 'Botany Chips',
      msg: 'Ingresa con tu usuario y contraseña.',
      newUser: {
        username: '',
        password: ''
      }
    }
  },
  components: {
    LoginButton
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
</style>