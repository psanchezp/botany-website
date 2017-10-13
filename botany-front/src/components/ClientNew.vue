<template>
  <div id='client-new'>
    <nav-bar></nav-bar>
    <md-layout md-gutter>
      <md-layout md-flex='40' md-flex-offset='30'>
        <h1>New Client</h1>
        <form v-on:submit='create'>
          <md-input-container>
            <label>Username</label>
            <md-input v-model='username' required></md-input>
          </md-input-container>
          <md-input-container>
            <label>Password</label>
            <md-input type='password' v-model='userPassword' required></md-input>
          </md-input-container>
          <md-input-container>
            <label>Name</label>
            <md-input v-model='name' required></md-input>
          </md-input-container>
          <md-input-container>
            <label>Description</label>
            <md-input v-model='userDescription' required></md-input>
          </md-input-container>
          <md-input-container>
            <label>Phone</label>
            <md-input v-model='userPhone'></md-input>
          </md-input-container>
          <md-input-container>
            <label>Address</label>
            <md-input v-model='userAddress'></md-input>
          </md-input-container>
          <md-input-container>
            <label>Email</label>
            <md-input v-model='userEmail'></md-input>
          </md-input-container>
          <input type="submit" value="Create"></input>
        </form>
      </md-layout>
    </md-layout>
  </div>
</template>

<script>
import NavBar from '@/components/NavBar'
import FormFields from '@/components/forms/FormFields'
import axios from 'axios'

export default {
  name: 'client-new',
  data () {
    return {
      url: 'http://localhost/botany-back/applicationLayer.php',
      username: '',
      userPassword: '',
      name: '',
      userDescription: '',
      userPhone: '',
      userAddress: '',
      userEmail: '',
      action: 'REGISTER_CLIENT'
    }
  },
  components: {
    NavBar, FormFields
  },
  methods: {
    create (event) {
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

<style scoped>
form {
  width: 100%;
}
</style>
