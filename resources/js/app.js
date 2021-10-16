require('./bootstrap')

window.Vue = require('vue').default

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from "./routes"

Vue.use(VueRouter)

// Vue.component('example-component', require('./components/ExampleComponent.vue').default)
Vue.component('employees-index', require('./components/employees/Index.vue').default)

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

const app = new Vue({
    el: '#app',
    router: router
})
