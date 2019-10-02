import Vue from 'vue'
import Vuex from 'vuex'

import skills from './modules/skills/skills'
import loading from './modules/loading/loading'

Vue.use(Vuex)

const store = new Vuex.Store({
   modules: {
      skills,
      loading
   }
})

export default store
