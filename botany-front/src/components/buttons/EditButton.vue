<template>
  <div class="edit-button">
    <md-button class="md-icon-button" href="/edit/client/x">
      <md-icon>
        mode_edit
      </md-icon>
    </md-button>
  </div>
</template>

<script>
export default {
  name: 'edit-button',
  props: ['link'],
  data () {
    return {
    }
  }
}
</script>

<style scoped>
</style>