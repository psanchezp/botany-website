<template>
  <div class="report-index">
    <md-layout md-gutter>
      <md-layout md-flex="50" md-flex-offset="25">
        <form v-on:submit='reportForm' class="report-form">
          <input
            type="date"
            v-model="transactionDateStart"
            placeholder="Fecha inicio"
            pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
          />
          <input
            type="date"
            v-model="transactionDateFinish"
            placeholder="Fecha fin"
            pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
          />
          <input
            type="text"
            v-model="transactionType"
            placeholder="Tipo de transacción"
          />
          <input
            type="text"
            v-model="transactionUsername"
            placeholder="Usuario"
          />
          <input
            type="text"
            v-model="transactionProductName"
            placeholder="Producto"
          />
          <input
            type="number"
            v-model="transactionState"
            placeholder="Estado"
            min=0
            max=1
          />
          <input class="md-button" type="submit" value="Submit">
        </form>
      </md-layout>
    </md-layout>
    <report-table
      v-if="dataLoaded" 
      class="finalized-table"
      table-type="final"
      :reportItems="reportItems"
    ></report-table>
  </div>
</template>

<script>
  import ReportTable from '@/components/tables/ReportTable'
  import axios from 'axios'

  export default {
    name: 'report-index',
    data () {
      return {
        model: '',
        name: this.$route.params.name,
        url: 'http://127.0.0.1/botany-back/applicationLayer.php',
        transactionDateStart: '',
        transactionDateFinish: '',
        transactionType: 'null',
        transactionUsername: 'null',
        transactionProductName: 'null',
        transactionState: 'null',
        reportItems: [],
        dataLoaded: false
      }
    },
    components: {
      ReportTable
    },
    methods: {
      reportForm (event) {
        event.preventDefault()
        var params = new URLSearchParams()
        params.append('transactionDateStart', this.transactionDateStart)
        params.append('transactionDateFinish', this.transactionDateFinish)
        params.append('transactionType', this.transactionType)
        params.append('transactionUsername', this.transactionUsername)
        params.append('transactionProductName', this.transactionProductName)
        params.append('transactionState', this.transactionState)
        params.append('action', 'GENERATE_REPORT')
        axios.post(this.url, params)
        .then(function (response) {
          this.reportItems = response.data.transactions
          this.dataLoaded = true
        }.bind(this))
        .catch(function (error) {
          console.log(error)
        })
      }
    }
  }
</script>
