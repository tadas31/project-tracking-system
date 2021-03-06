import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faBars, faHome, faFolderOpen, faFolder, faSignInAlt, faSignOutAlt, faSearch, faCog } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Gravatar from 'vue-gravatar'

library.add(faBars, faHome, faFolderOpen, faFolder, faSignInAlt, faSignOutAlt, faSearch, faCog)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('v-gravatar', Gravatar)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
