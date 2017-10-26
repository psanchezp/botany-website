<template>
  <form v-on:submit='$_product_update' class="product-form">
    <input
      type="text"
      v-model="productName"
      placeholder="Nombre de producto" 
    />
    <input
      type="text"
      v-model="productCategory"
      placeholder="Categoria"
    />
    <input type="text" v-model="productMeasure">
    <input type="number"  step="0.01" min="0" v-model="productPrice">
    <input type="submit" value="Create">
  </form>
</template>

<script>
  import axios from 'axios'

  export default {
    name: 'product-form',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        model: '',
        productName: '',
        productCategory: '',
        productMeasure: '',
        productPrice: '',
        action: 'REGISTER_PRODUCT'
      }
    },
    methods: {
      $_product_update (event) {
        event.preventDefault()
        var params = new URLSearchParams()
        params.append('productName', this.productName)
        params.append('productCategory', this.productCategory)
        params.append('productMeasure', this.productMeasure)
        params.append('productPrice', this.productPrice)
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