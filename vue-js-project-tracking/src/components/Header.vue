<template>
  <div>
     <ul>
      <li class="left"><button @click="meniuOpen = !meniuOpen" ><font-awesome-icon class="hamburger-icon" icon="bars" /></button></li>
      <li class="title"><router-link to="/">Rework</router-link></li>
      <li class="search">
        <form @submit.prevent="publicProjects(searchQuery)">
          <input type="text" name="searchQuery" v-model="searchQuery" placeholder="Search public projects">
          <button class="ripple" type="submit"><font-awesome-icon class="icon" icon="search" /></button>
        </form>
      </li>
    </ul>
    <Menu :class="[meniuOpen ? 'open-menu' : 'close-menu']"/>
  </div>
</template>

<script>
import Menu from '@/components/Menu.vue'
import { mapActions } from 'vuex'

export default {
  name: 'Header',
  data: function () {
    return {
      meniuOpen: true,
      searchQuery: ''
    }
  },
  methods: {
    ...mapActions(['publicProjects'])
  },
  components: {
    Menu
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Offside&display=swap');

ul {
  list-style-type: none;
  margin: 0;
  padding: 0 0;
  overflow: hidden;
  background-color: #403D39;
  position: fixed;
  top: 0;
  width: 100%;
}

li {
  padding: 5px 2px;
  margin-right: 20px;
  background-color: #403D39;
  display: inline-block;
}

.left {
  float: left;
}

.hamburger-icon {
  font-size: 30px;
  background-color: #403D39;
  color: white;
  padding: 5px;
}

.hamburger-icon:hover {
  color: #EB5E28;
  cursor: pointer;
}

button {
  border: none;
  outline: none;
}

li a {
  font-size: 30px;
  font-family: 'Offside', sans-serif;
  text-align: center;
  text-decoration: none;
  color: white;
  background-color: #403D39;
}

li a:hover{
  color: #EB5E28;
}

.open-menu {
  animation: MenuShow 1s;
  left: 0;
}

.close-menu {
  animation: MenuHide 1s;
  left: -260px;
}

.search {
  display: inline-block;
  position: absolute;
  width: 400px;
  top: calc(50% - 18.5px);
  left: calc(50% - 202px);
}

form {
   background-color: #403D39;
}

input {
  outline: none;
  border: solid 1px #252422;
  padding: 0 2px;
  font-size: 15px;
  width: 85.5%;
  height: 25px;
  border-radius: 4px 0 0 4px;
}

input:focus {
  border: solid 1px #EB5E28;
}

button.ripple{
  position: absolute;
  outline: none;
  border: none;
  background-color: #252422;
  display: inline-block;
  width: 52px;
  height: 27px;
  border-radius: 0 4px 4px 0;
}

.ripple {
  background-position: center;
  transition: background 0.8s;
}

.ripple:hover {
  background: #2c2a29 radial-gradient(circle, transparent 1%, #33312f 1%) center/15000%;
}

.ripple:active {
  background-color: #33312f;
  background-size: 100%;
  transition: background 0s;
}

.icon {
  background-color: inherit;
  color: white;
}

@keyframes MenuShow {
  from {
    left: -260px;
  }
  to {
    left: 0;
  }
}

@keyframes MenuHide {
  from {
    left: 0;
  }
  to {
    left: -260px;
  }
}

/* @media only screen and (max-width: 1480px) {
  ul {
    padding: 0 0;
  }
}

@media only screen and (max-width: 860px) {
  li.left, li.right {
    float: none;
  }

  input {
    margin: 0 0;
    margin-bottom: 10px;
  }
} */
</style>
