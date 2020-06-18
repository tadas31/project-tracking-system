import axios from 'axios'
import router from '../../router'

const state = {
  access_token: localStorage.getItem('access_token') || null,
  error: null,
  email: null,
  username: null
}

const getters = {
  isLoggedIn (state) {
    return state.access_token != null
  },
  accessToken (state) {
    if (state.access_token != null) {
      return state.access_token
    }
    return false
  },
  getError (state) {
    return state.error
  },
  getUsername (state) {
    return state.username
  },
  getEmail (state) {
    return state.email
  }
}

const actions = {
  async login ({ commit }, credentials) {
    await axios.post(process.env.VUE_APP_API + 'login', credentials)
      .then(response => {
        commit('login', response.data)
      })
      .catch(error => {
        var key = Object.keys(error.response.data)[0]
        commit('error', error.response.data[key])
      })
  },
  async logout ({ commit }) {
    await axios.post(process.env.VUE_APP_API + 'logout', null, { headers: { Authorization: 'Bearer ' + state.access_token } })
      .then(response => {
        commit('logout')
      })
      .catch(response => {
        commit('logout')
      })
  },
  async me ({ commit, dispatch }) {
    await axios.post(process.env.VUE_APP_API + 'me', null, { headers: { Authorization: 'Bearer ' + state.access_token } })
      .then(response => {
        commit('setUserData', response.data)
      })
      .catch(response => {
        dispatch('logout')
      })
  },
  async signUp ({ commit, dispatch }, credentials) {
    await axios.post(process.env.VUE_APP_API + 'signup', credentials)
      .then(response => {
        if (response.data.message === 'User created') {
          dispatch('login', { email: credentials.email, password: credentials.password })
        }
      })
      .catch(error => {
        var key = Object.keys(error.response.data)[0]
        commit('error', error.response.data[key])
      })
  },
  resetError () {
    state.error = null
  }
}

const mutations = {
  login (state, user) {
    state.access_token = user.access_token
    localStorage.setItem('access_token', user.access_token)
    router.push('/')
    router.go()
  },
  error (state, error) {
    if (Array.isArray(error)) {
      state.error = error[0]
    } else {
      state.error = error
    }
  },
  logout (state) {
    state.access_token = null
    state.email = null
    state.username = null
    localStorage.removeItem('access_token')
    router.push('/login')
    router.go()
  },
  setUserData (state, userData) {
    state.email = userData.email
    state.username = userData.username
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
