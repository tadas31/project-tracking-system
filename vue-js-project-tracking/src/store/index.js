import Vue from 'vue'
import Vuex from 'vuex'
import login from './modules/login'
import project from './modules/project'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    login,
    project
  }
})
