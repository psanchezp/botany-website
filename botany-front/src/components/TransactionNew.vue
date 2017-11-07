<template>
  <md-layout md-gutter>
    <h3>Nueva transacción</h3>
    <md-layout md-flex="70" md-flex-offset="15">
      <form v-on:submit='transactionCreate' class="transaction-new">
        <md-input
          type="text"
          v-model="productName"
          placeholder= "Nombre de producto"
        />
        <md-input
          type="text"
          v-model="username"
          placeholder="Usuario"
        />
<!--         <input type="radio" name="ttype" v-model="transactionType" value="sale">Compra<br>
        <input type="radio" name="ttype" v-model="transactionType" value="purchase">Venta<br> -->
        <md-radio v-model="transactionType" md-value="purchase">Compra</md-radio>
        <md-radio v-model="transactionType" md-value="sale">Venta</md-radio>
        <md-input 
          type="datetime" 
          v-model="transactionDate"
          placeholder="Fecha de transacción" 
        />
<!--         <input type="radio" name="state" v-model="state" value=0>No finalizado<br>
        <input type="radio" name="state" v-model="state" value=1>Finalizado<br> -->
        <md-radio v-model="state" md-value=0>No finalizado</md-radio>
        <md-radio v-model="state" md-value=1>Finalizado</md-radio>
        <md-input
          type="number"
          v-model="quantity"
          placeholder="Cantidad"
        />
        <md-input
          type="text"
          v-model="description"
          placeholder="Descripción"
        />
        <input class="md-button" type="submit" value="Crear">
      </form>
    </md-layout>
  </md-layout>
</template>

<script>
  import axios from 'axios'
  // import Datepicker from 'vue-material-datepicker'

  export default {
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        action: 'CREATE_TRANSACTION',
        productName: 'quesadilla',
        username: 'client',
        transactionType: 'sale',
        transactionDate: '2000-01-01',
        state: 0,
        quantity: 0,
        description: 'Describe'
      }
    },
    methods: {
      transactionCreate (event) {
        event.preventDefault()
        var params = new URLSearchParams()
        params.append('productName', this.productName)
        params.append('username', this.username)
        params.append('transactionType', this.transactionType)
        params.append('transactionDate', this.transactionDate)
        params.append('state', this.state)
        params.append('quantity', this.quantity)
        params.append('description', this.description)
        params.append('action', this.action)
        axios.post(this.url, params)
        .then(function (response) {
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        })
      }
    },
    props: {
      model: String
    }
    // components: {
    //   datepicker: { Datepicker }
    // }
  }
</script>

<style scoped>
  [type="radio"]:not(:checked), [type="radio"]:checked {
    position: relative;
    left: 0 !important;
    opacity: 1 !important;
  }
</style>