import axios from 'axios'
import router from '../../router'

const state = {
  publicProjects: null,
  error: null
}

const getters = {
  getPublicProjects (state) {
    return state.publicProjects
  },
  getProjectError (state) {
    return state.error
  }
}

const actions = {
  async publicProjects ({ commit }, searchQuery = '') {
    await axios.get(process.env.VUE_APP_API + 'public/project?search=' + searchQuery)
      .then(response => {
        commit('fetchPublicProjects', response.data)
      })
      .catch(error => {
        var key = Object.keys(error.response.data)[0]
        commit('error', error.response.data[key])
      })
  }
}

const mutations = {
  fetchPublicProjects (state, projects) {
    if (router.currentRoute.path !== '/') {
      router.push('/')
    }
    state.error = null
    state.publicProjects = projects
  },
  error (state, error) {
    if (router.currentRoute.path !== '/') {
      router.push('/')
    }
    if (Array.isArray(error)) {
      state.error = error[0]
    } else {
      state.error = error
    }
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
