import Vue from 'vue'
import VueRouter from 'vue-router'
import Hello from '@/components/Hello'
import Login from '@/components/Login'
import ModelIndex from '@/components/ModelIndex'
import ModelShow from '@/components/ModelShow'
import ModelNew from '@/components/ModelNew'
import ModelEdit from '@/components/ModelEdit'
// import ClientIndex from '@/components/ClientIndex'
// import ProviderIndex from '@/components/ProviderIndex'
// import ProductIndex from '@/components/ProductIndex'
// import ClientShow from '@/components/ClientShow'
// import ProviderShow from '@/components/ProviderShow'
// import ProductShow from '@/components/ProductShow'
// import ClientNew from '@/components/ClientNew'
// import ClientEdit from '@/components/ClientEdit'
// import ProviderNew from '@/components/ProviderNew'
// import ProviderEdit from '@/components/ProviderEdit'
// import ProductNew from '@/components/ProductNew'
// import ProductEdit from '@/components/ProductEdit'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      title: 'Login path',
      component: Login
    },
    {
      path: '/hello',
      title: 'Hello path',
      component: Hello
    },
    // {
    //   path: '/clients',
    //   title: 'Client index path',
    //   component: ClientIndex
    // },
    {
      path: '/:model',
      title: 'Generic model path',
      component: ModelIndex,
      props: true
    },
    {
      path: '/:model/new',
      title: 'Generic new path',
      component: ModelNew,
      props: true
    },
    {
      path: '/:model/edit/:name',
      title: 'Generic edit path',
      component: ModelEdit,
      props: true
    },
    {
      path: '/:model/show/:name',
      title: 'Generic show path',
      component: ModelShow,
      props: true
    },
    {
      path: '/:model/edit/:name',
      title: 'Generic edit path',
      component: ModelEdit,
      props: true
    }
    // {
    //   path: '/products',
    //   title: 'Product index path',
    //   component: ProductIndex
    // },
    // {
    //   path: '/client/x',
    //   title: 'Client show path',
    //   component: ClientShow
    // },
    // {
    //   path: '/provider/x',
    //   title: 'Provider show path',
    //   component: ProviderShow
    // },
    // {
    //   path: '/product/x',
    //   title: 'Product show path',
    //   component: ProductShow
    // },
    // {
    //   path: '/edit/client/x',
    //   title: 'Client edit path',
    //   component: ClientEdit
    // },
    // {
    //   path: '/edit/provider/x',
    //   title: 'Provider edit path',
    //   component: ProviderEdit
    // },
    // {
    //   path: '/edit/product/x',
    //   title: 'Product edit path',
    //   component: ProductEdit
    // },
    // {
    //   path: '/new/client',
    //   title: 'New Client path',
    //   component: ClientNew
    // },
    // {
    //   path: '/new/provider',
    //   title: 'New Provider path',
    //   component: ProviderNew
    // },
    // {
    //   path: '/new/product',
    //   title: 'New Product path',
    //   component: ProductNew
    // }
  ]
})
