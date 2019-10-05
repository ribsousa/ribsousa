import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

window.Vue = require('vue')
Vue.use(Buefy,{
    defaultIconPack: 'mdi',
})

import router from './routes/routers'
import store from './vuex/store'

/**
 * Components Globals
 */
Vue.component('backend-component', require('./components/backend/layouts/BackendComponent').default)

const app = new Vue({
    router,
    store,
    el: '#app',
});
