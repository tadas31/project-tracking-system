<template>
  <div>
     <ul>
      <li class="left"><button @click="meniuOpen = !meniuOpen" ><font-awesome-icon class="hamburger-icon" icon="bars" /></button></li>
      <li class="title"><router-link to="/">Rework</router-link></li>
      <li class="search">
        <form>
          <input type="text">
        </form>
      </li>
    </ul>
    <Menu :class="[meniuOpen ? 'open-menu' : 'close-menu']"/>
  </div>
</template>

<script>
import Menu from '@/components/Menu.vue'

export default {
  name: 'Header',
  data: function () {
    return {
      meniuOpen: true
    }
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
  width: 350px;
  margin-top: -10px;
  /* height: 35px; */
}

input {
  width: 100%;
  height: 25px;
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
