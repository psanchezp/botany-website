<template>
  <form v-on:submit='providerCreate' class="provider-form">
    <input
      type="text"
      v-model="username"
      placeholder="Usuario" 
    />
    <input
      type="password"
      v-model="userPassword"
      placeholder="Contraseña"
    />
    <input
      type="text"
      v-model="name"
      placeholder="Nombre de proveedor"
    />
    <input
      type="text"
      v-model="userDescription"
      placeholder="Descripción"
    />
    <md-icon>phone</md-icon>
    <input
      type="text"
      v-model="userPhone"
      placeholder="Teléfono"
    />
    <input
      type="text"
      v-model="userAddress"
      placeholder="Dirección"
    />
    <input
      type="text"
      v-model="userEmail"
      placeholder="Correo"
    />
    <input class="md-button" type="submit" value="Create">
  </form>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'provider-form',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        username: '',
        userPassword: '',
        name: '',
        userDescription: '',
        userPhone: '',
        userAddress: '',
        userEmail: '',
        action: 'REGISTER_PROVIDER'
      }
    },
    methods: {
      providerCreate (event) {
        event.preventDefault()
        var params = new URLSearchParams()
        params.append('username', this.username)
        params.append('userPassword', this.userPassword)
        params.append('name', this.name)
        params.append('userDescription', this.userDescription)
        params.append('userPhone', this.userPhone)
        params.append('userAddress', this.userAddress)
        params.append('userEmail', this.userEmail)
        params.append('action', this.action)
        axios.post(this.url, params)
        .then(function (response) {
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        })
      }
    }
  }
</script>