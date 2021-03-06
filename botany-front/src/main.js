// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.css'

Vue.use(VueMaterial)
Vue.config.productionTip = false
// Vue.http.options.emulateJSON = true
// Vue.http.options.emulateHTTP = true

// Material theme colors
Vue.material.registerTheme('default', {
  primary: { color: 'pink', hue: 400, textColor: 'white' },
  accent: { color: 'grey', hue: 400 },
  warn: { color: 'yellow', hue: 400 },
  background: { color: 'grey', hue: 50 }
})

Vue.material.setCurrentTheme('default')

// Vue app
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
