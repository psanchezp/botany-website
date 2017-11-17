<template>
  <form v-on:submit='providerForm' class="provider-form">
    <input
      type="text"
      v-model="username"
      placeholder="Usuario"
      :disabled="disabledInput"
    />
    <input
      type="password"
      v-model="userPassword"
      :placeholder="passwordPlaceholder"
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
    <input class="md-button" type="submit" :value="submitButton">

    <md-dialog-alert
      :md-content="alert.content"
      :md-ok-text="alert.ok"
      ref="dialogSubmit">
    </md-dialog-alert>
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
        alert: {
          content: 'El proveedor se actualizó.',
          ok: 'Ok!'
        }
      }
    },
    props: {
      item: Object,
      action: String
    },
    created: function () {
      if (this.item) {
        this.username = this.item.username
        this.name = this.item.name
        this.userDescription = this.item.description
        this.userPhone = this.item.phone
        this.userAddress = this.item.address
        this.userEmail = this.item.email
      }
    },
    computed: {
      submitButton () {
        if (this.action === 'UPDATE_PROVIDER') {
          return 'Editar'
        } else {
          return 'Crear'
        }
      },
      disabledInput () {
        if (this.action === 'UPDATE_PROVIDER') {
          return true
        } else {
          return false
        }
      },
      passwordPlaceholder () {
        if (this.action === 'UPDATE_PROVIDER') {
          return 'Nueva contraseña'
        } else {
          return 'Contraseña'
        }
      }
    },
    methods: {
      providerForm (event) {
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
          if (this.action === 'UPDATE_PROVIDER') {
            this.openDialog('dialogSubmit')
          } else {
            this.$router.push('/providers')
          }
        }.bind(this))
        .catch(function (error) {
          console.log(error)
        })
      },
      openDialog (ref) {
        this.$refs[ref].open()
      },
      closeDialog (ref) {
        this.$refs[ref].close()
      }
    }
  }
</script>