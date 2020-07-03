import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import SignUp from '../views/SignUp.vue'
import MyProjects from '../views/MyProjects.vue'
import AddProject from '../views/AddForms/AddProject.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/public/projects',
    name: 'Public projects',
    component: Home
  },
  {
    path: '/login',
    name: 'Log in',
    component: Login
  },
  {
    path: '/signup',
    name: 'Sign up',
    component: SignUp
  },
  {
    path: '/my/projects',
    name: 'My projects',
    component: MyProjects
  },
  {
    path: '/add/project',
    name: 'Add project',
    component: AddProject
  }
]

const router = new VueRouter({
  routes
})

export default router
