<template>
  <div class="container signup-container">
     <div class="page-title">
      Sign up
    </div>
    <form @submit.prevent="signUpMethod()">
      <div class="input-container">
        <div class="auth-input-wraper">
          <input type="text" name="username" id="username" v-model="username" :class="{'red-border': username.length < 3}" autocomplete="off" placeholder=" " required/>
          <label for="username">Username</label>
        </div>
        <div class="auth-input-wraper">
          <input type="email" name="email" id="email" v-model="email" :class="{'red-border': email.length < 1}" autocomplete="off" placeholder=" " required/>
          <label for="email">Email</label>
        </div>
        <div class="auth-input-wraper">
          <input type="password" name="password" id="password" v-model="password" :class="{'red-border': password.length < 6}" autocomplete="off" placeholder=" " required/>
          <label for="password">Password</label>
        </div>
        <div class="auth-input-wraper">
          <input type="password" name="confirmPassword" id="confirmPassword" v-model="confirmPassword" :class="{'red-border': confirmPassword.length < 6}" autocomplete="off" placeholder=" " required/>
          <label for="confirmPassword">Confirm Password</label>
        </div>
      </div>
      <div class="error">{{ getError }}</div>
      <button class="ripple" type="submit">Sign Up</button>
    </form>
    <router-link to="/login">Log In</router-link>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'SignUp',
  data () {
    return {
      username: '',
      email: '',
      password: '',
      confirmPassword: '',
      error: ''
    }
  },
  computed: mapGetters(['getError']),
  created () {
    this.resetError()
  },
  methods: {
    ...mapActions(['signUp', 'resetError']),
    signUpMethod () {
      this.signUp({ username: this.username, email: this.email, password: this.password, confirm_password: this.confirmPassword })
    }
  }
}
</script>

<style scoped>
* {
  background-color: white;
}

.signup-container {
  width: 400px;
  height: 540px;
  padding: 10px;
  box-shadow: 0 0 10px 5px #CCC5B9;
  margin-left: -210px;
}

.red-border:focus,
input:not(:placeholder-shown):invalid {
  border-bottom: 2px solid red;
}

input {
  width: 100%;
  outline: none;
  border: none;
  border-bottom: 2px solid black;
}

input:focus {
  border-bottom: 2px solid green;
}

.input-container {
  padding: 10px 10px;
  margin-top: 20px;
}

.auth-input-wraper {
  padding: 30px 20px;
  position: relative;
}

label {
  display: block;
  position: absolute;
  color: #909090;
  font-size: 16px;
  top: 26px;
  transition: 0.3s linear all;
}

input:focus + label,
input:valid + label,
input:not(:placeholder-shown):invalid + label {
  font-size: 14px;
  top: 12px;
  transition: 0.2s linear all;
}

button {
  outline: none;
  border: none;
  background-color: #EB5E28;
  cursor: pointer;
  width: 200px;
  height: 50px;
  border-radius: 20px;
  margin-left: 25%;
  color: white;
  font-size: 20px;
  box-shadow: 0 0 2px #999;
}

.ripple {
  background-position: center;
  transition: background 0.8s;
}

.ripple:hover {
  background: #f06d3a radial-gradient(circle, transparent 1%, #f06d3a 1%) center/15000%;
}

.ripple:active {
  background-color: #EC7E53;
  background-size: 100%;
  transition: bacground 0s;
}

.error {
  color: red;
  padding: 0 30px;
  margin-top: -10px;
  margin-bottom: 20px
}

a{
  display: block;
  margin-top: 20px;
  text-align: center;
}
</style>
