<template>
  <div class="edit-button">
    <md-button class="md-icon-button" :href="link_to_show">
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
  },
  computed: {
    link_to_show: function () {
      return '/' + this.model + '/edit/' + this.name
    }
  }
}
</script>

<style scoped>
</style>