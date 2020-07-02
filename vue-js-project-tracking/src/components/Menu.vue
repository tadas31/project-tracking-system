<template>
  <div>
    <ul>
      <li v-if="isLoggedIn && (getEmail != '' || email != '')" class="user-icon"><v-gravatar class="gravatar" v-bind:email="getEmail || email" /></li>
      <li v-if="isLoggedIn && (getUsername != '' || username != '')" class="user-name">{{ getUsername || username }}</li>
      <li><router-link to="/"><font-awesome-icon class="icon" icon="home" />Home</router-link></li>
      <li><router-link to="/public/projects"><font-awesome-icon class="icon" icon="folder-open" />Public Projects</router-link></li>
      <li v-if="isLoggedIn"><router-link to="/INSERT THIS LATER WHEN PATH EXISTS"><font-awesome-icon class="icon" icon="folder" />My Projects</router-link></li>
      <li v-if="isLoggedIn"><router-link to="/INSERT THIS LATER WHEN PATH EXISTS"><font-awesome-icon class="icon" icon="cog" />Settings</router-link></li>
      <li v-if="!isLoggedIn" class="bottom"><router-link to="/login"><font-awesome-icon class="icon" icon="sign-in-alt" />Log In</router-link></li>
      <li v-if="isLoggedIn" class="bottom"><button @click="logout()" ><font-awesome-icon class="icon" icon="sign-out-alt" />Log Out</button></li>
    </ul>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Menu',
  data () {
    return {
      email: '',
      username: '',
      loggedIn: false
    }
  },
  computed: mapGetters(['isLoggedIn', 'getEmail', 'getUsername']),
  async created () {
    if (this.isLoggedIn) {
      await this.me()
      this.email = this.getEmail
      this.username = this.getUsername
      this.loggedIn = this.isLoggedIn
    }
  },
  methods: {
    ...mapActions(['logout', 'me'])
  }
}
</script>

<style scoped>
div {
  position: absolute;
  height: calc(100vh - 50px);
  width: 260px;
  background-color: #403D39;
  margin-top: 50.25px;
}

li {
  background-color: #403D39;
  padding: 5px 5px;
  font-size: 20px;
}

li a {
  background-color: inherit;
  text-decoration: none;
  color: white;
  display: block;
}

li button {
  background-color: inherit;
  text-align-last: left;
  font-size: 18px;
  color: white;
  display: block;
  border: none;
  outline: none;
  width: 100%;
  height: 100%;
  cursor: pointer;
}

.icon {
  background-color: inherit;
  padding: 0 2px;
  margin-right: 10px;
}

li:hover {
  background-color: #252422;
  cursor: pointer;
}

.bottom {
  bottom: 10px;
  position: absolute;
  left: 0;
  right: 0;
}

.user-name {
  color: #EB5E28;
  font-size: 22px;
  text-align: center;
  padding-bottom: 30px;
}

.user-name:hover {
  background-color: #403D39;
  cursor: default;
}

.user-icon {
  text-align: center;
  padding-top: 20px;
}

.user-icon:hover {
  background-color: #403D39;
  cursor: default;
}

.gravatar {
  width: 90px;
  border-radius: 60px;
}
</style>
