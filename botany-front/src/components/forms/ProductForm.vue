<template>
  <form v-on:submit='productForm' class="product-form">
    <input
      :hidden="disabledEdit"
      type="text"
      v-model="productName"
      placeholder="Nombre de producto"
    />
    <input
      :hidden="disabledCreate"
      type="text"
      v-model="oldProductName"
      placeholder="Viejo nombre del producto"
      disabled
    />
    <input
      :hidden="disabledCreate"
      type="text"
      v-model="newProductName"
      placeholder="Nuevo nombre del producto"
    />
    <input
      type="text"
      v-model="productCategory"
      placeholder="Categoria"
    />
    <input 
      type="text"
      v-model="productMeasure"
      placeholder="Medida" 
    />
    <input
      type="number"
      step="0.01"
      min="0"
      v-model="productPrice"
      placeholder="Precio"
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
    name: 'product-form',
    data () {
      return {
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        model: '',
        productName: '',
        oldProductName: '',
        newProductName: '',
        productCategory: '',
        productMeasure: '',
        productPrice: '',
        alert: {
          content: 'El producto se actualizó.',
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
        this.oldProductName = this.item.name
        this.newProductName = this.item.name
        this.productCategory = this.item.category
        this.productMeasure = this.item.measure
        this.productPrice = this.item.price
      }
    },
    computed: {
      submitButton () {
        if (this.action === 'UPDATE_PRODUCT') {
          return 'Editar'
        } else {
          return 'Crear'
        }
      },
      disabledEdit () {
        if (this.action === 'UPDATE_PRODUCT') {
          return true
        } else {
          return false
        }
      },
      disabledCreate () {
        if (this.action !== 'UPDATE_PRODUCT') {
          return true
        } else {
          return false
        }
      }
    },
    methods: {
      productForm (event) {
        event.preventDefault()
        var params = new URLSearchParams()
        if (this.action === 'UPDATE_PRODUCT') {
          params.append('oldProductName', this.oldProductName)
          params.append('newProductName', this.newProductName)
        } else {
          params.append('productName', this.productName)
        }
        params.append('productCategory', this.productCategory)
        params.append('productMeasure', this.productMeasure)
        params.append('productPrice', this.productPrice)
        params.append('action', this.action)
        axios.post(this.url, params)
        .then(function (response) {
          if (this.action === 'UPDATE_PRODUCT') {
            this.openDialog('dialogSubmit')
          } else {
            this.$router.push('/products')
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