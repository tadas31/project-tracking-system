<template>
 <div class="container">
    <div class="page-title">
      New project
    </div>
    <form @submit.prevent="createNewProject()">
      <div class="input-container">
        <div class="input-wraper">
          <input type="text" name="name" id="name" v-model="name" :class="{'red-border': name.length < 3}" autocomplete="off" placeholder=" " required/>
          <label for="name">Project name</label>
        </div>
        <div class="input-wraper">
          <textarea name="description" id="description" v-model="description" rows="9"></textarea>
          <label class="textarea-label" for="description">Description</label>
        </div>
        <div class="input-wraper">
          <textarea name="notes" id="notes" v-model="notes" rows="9"></textarea>
          <label class="textarea-label" for="notes">Notes</label>
        </div>
        <div class="input-wraper">
          <input type="url" name="gitRepository" id="gitRepository" v-model="gitRepository" :class="{'red-border': gitRepository.length < 3}" autocomplete="off" placeholder=" "/>
          <label for="gitRepository">Git repository</label>
        </div>
        <div class="input-wraper">
          <input class="checkbox" type="checkbox" name="isPublic" id="isPublic" v-model="isPublic">
          <label class="checkbox-label" for="isPublic">Is public</label>
        </div>
      </div>
      <div class="error">{{ getProjectError }}</div>
      <button class="ripple" type="submit">Create</button>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'AddProject',
  data () {
    return {
      name: '',
      description: '',
      notes: '',
      gitRepository: '',
      isPublic: false
    }
  },
  computed: mapGetters(['getProjectError']),
  methods: {
    ...mapActions(['addProject']),
    createNewProject () {
      this.addProject({ name: this.name, description: this.description, notes: this.notes, git_repository: this.gitRepository, is_public: this.isPublic })
    }
  }
}
</script>

<style scoped>
* {
  background-color: white;
}

.input-container {
  padding: 0 100px;
}

textarea {
  width: calc(100% - 14px);
  border: 2px solid black;
  padding: 10px;
  border-radius: 4px;
  resize: vertical;
  outline: green;
}

textarea:focus {
  border: 2px solid green;
}

input {
  width: 100%;
  outline: none;
  border: none;
  padding: 0 5px;
  border-bottom: 2px solid black;
}

input:focus {
  border-bottom: 2px solid green;
}

.red-border:focus,
input:not(:placeholder-shown):invalid {
  border-bottom: 2px solid red;
}

.input-wraper {
  padding: 20px 20px;
  position: relative;
}

.checkbox {
  margin-left: calc(-50% + 80px);
}

label {
  display: block;
  position: absolute;
  color: #909090;
  font-size: 16px;
  margin-left: 5px;
  top: 16px;
  transition: 0.3s linear all;
}

.textarea-label {
  margin-top: -5px;
}

.checkbox-label {
  font-size: 16px !important;
  top: 18px !important;
  transition: none !important;
}

input:focus + label,
input:not(:placeholder-shown):valid + label,
input:not(:placeholder-shown):invalid + label {
  font-size: 14px;
  top: 2px;
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
  margin-left: calc(50% - 100px);
  margin-bottom: 34px;
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
  background-color: #ec7e53;
  background-size: 100%;
  transition: background 0s;
}

.error {
  color: red;
  padding: 0 124px;
  margin-bottom: 20px;
  height: 18px;
}
</style>
