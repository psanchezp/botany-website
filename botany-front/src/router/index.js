import Vue from 'vue'
import VueRouter from 'vue-router'
import Hello from '@/components/Hello'
import Login from '@/components/Login'
import ClientIndex from '@/components/ClientIndex'
import ProviderIndex from '@/components/ProviderIndex'
import ProductIndex from '@/components/ProductIndex'
import ClientShow from '@/components/ClientShow'
import ProductShow from '@/components/ProductShow'
import ProviderShow from '@/components/ProviderShow'
import ClientForm from '@/components/ClientForm'
import ProductForm from '@/components/ProductForm'
import ProviderForm from '@/components/ProviderForm'

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
    },
    {
      path: '/client/x',
      title: 'Client show path',
      name: 'Client',
      component: ClientShow
    },
    {
      path: '/provider/x',
      title: 'Provider show path',
      name: 'Provider',
      component: ProviderShow
    },
    {
      path: '/product/x',
      title: 'Product show path',
      name: 'Product',
      component: ProductShow
    },
    {
      path: '/edit/client/x',
      title: 'Client form path',
      name: 'Client',
      component: ClientForm
    },
    {
      path: '/edit/provider/x',
      title: 'Provider form path',
      name: 'Provider',
      component: ProviderForm
    },
    {
      path: '/edit/product/x',
      title: 'Product form path',
      name: 'Product',
      component: ProductForm
    },
    {
      path: '/new/client/x',
      title: 'New Client path',
      name: 'Client',
      component: ClientForm
    },
    {
      path: '/new/provider/x',
      title: 'New Provider path',
      name: 'Provider',
      component: ProviderForm
    },
    {
      path: '/new/product/x',
      title: 'New Product path',
      name: 'Product',
      component: ProductForm
    }
  ]
})
