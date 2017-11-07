import Vue from 'vue'
import VueRouter from 'vue-router'
import Hello from '@/components/Hello'
import Login from '@/components/Login'
import ModelIndex from '@/components/ModelIndex'
import ModelShow from '@/components/ModelShow'
import ModelNew from '@/components/ModelNew'
import ModelEdit from '@/components/ModelEdit'
import TransactionIndex from '@/components/TransactionIndex'

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
    {
      path: '/transactions/:model/:name?',
      title: 'Transactions',
      component: TransactionIndex,
      props: true
    },
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
      path: '/:model/:name',
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
  ]
})
