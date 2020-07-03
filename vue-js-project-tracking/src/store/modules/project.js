import axios from 'axios'
import router from '../../router'

const state = {
  public_projects: null,
  my_projects: null,
  error: null
}

const getters = {
  getPublicProjects (state) {
    return state.public_projects
  },
  getMyProjects (state) {
    return state.my_projects
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
        commit('publicProjectError', error.response.data[key])
      })
  },
  async myProjects ({ commit }, searchQuery = '') {
    await axios.get(process.env.VUE_APP_API + 'project', { headers: { Authorization: 'Bearer ' + localStorage.getItem('access_token') } })
      .then(response => {
        commit('fetchMyProjects', response.data)
      })
      .catch(error => {
        var key = Object.keys(error.response.data)[0]
        commit('projectError', error.response.data[key])
      })
  },
  async addProject ({ commit }, project) {
    await axios.post(process.env.VUE_APP_API + 'project', project, { headers: { Authorization: 'Bearer ' + localStorage.getItem('access_token') } })
      .then(response => {
        router.push('/project/' + response.data.id)
      })
      .catch(error => {
        var key = Object.keys(error.response.data)[0]
        commit('projectError', error.response.data[key])
      })
  }
}

const mutations = {
  fetchPublicProjects (state, projects) {
    if (router.currentRoute.path !== '/') {
      router.push('/')
    }
    state.error = null
    state.public_projects = projects
  },
  publicProjectError (state, error) {
    if (router.currentRoute.path !== '/') {
      router.push('/')
    }
    if (Array.isArray(error)) {
      state.error = error[0]
    } else {
      state.error = error
    }
  },
  fetchMyProjects (state, projects) {
    state.error = null
    state.my_projects = projects
  },
  projectError (state, error) {
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
