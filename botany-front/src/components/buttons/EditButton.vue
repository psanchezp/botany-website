<template>
  <div class="edit-button">
    <md-button class="md-icon-button" :href="model">
      <md-icon>
        mode_edit
      </md-icon>
    </md-button>
  </div>
</template>

<script>
export default {
  name: 'edit-button',
  props: {
    model: String,
    name: String
  },
  data () {
    return {
    }
  }
}
</script>

<style scoped>
</style>