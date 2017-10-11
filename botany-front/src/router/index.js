import Vue from 'vue'
import VueRouter from 'vue-router'
import Hello from '@/components/Hello'
import Login from '@/components/Login'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      title: 'Login path',
      name: 'Login',
      component: Login
    },
    {
      path: '/hello',
      title: 'Hello path',
      name: 'Hello',
      component: Hello
    }
  ]
})
