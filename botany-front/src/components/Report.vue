<template>
  <div class="report-stuff">
    <nav-bar></nav-bar>
    <h1>Generar reporte</h1>
    <report-index></report-index>
  </div>
</template>

<script>
  import ReportIndex from '@/components/ReportIndex'
  import NavBar from '@/components/NavBar'

  export default {
    name: 'report-stuff',
    data () {
      return {
      }
    },
    components: {
      NavBar, ReportIndex
    }
  }
</script>
