import Vue from 'vue'
import VueRouter from 'vue-router'
import Hello from '@/components/Hello'
import Login from '@/components/Login'
import ClientIndex from '@/components/ClientIndex'
import ProviderIndex from '@/components/ProviderIndex'
import ProductIndex from '@/components/ProductIndex'

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
    },
    {
      path: '/clients',
      title: 'Client index path',
      name: 'Clients',
      component: ClientIndex
    },
    {
      path: '/providers',
      title: 'Provider index path',
      name: 'Providers',
      component: ProviderIndex
    },
    {
      path: '/products',
      title: 'Product index path',
      name: 'Products',
      component: ProductIndex
    }
  ]
})
