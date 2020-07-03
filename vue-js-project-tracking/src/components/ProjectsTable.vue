<template>
  <div class="projects-container">
      <table v-if="projects != null && getProjectError == null">
        <tr>
          <th>Name</th>
          <th>Author</th>
          <th>Git repository</th>
        </tr>
        <tr class="table-body" v-for="project in projects.data"  v-bind:key="project.id" @click="openProject(project.id)">
          <td class="truncate">{{ project.name }}</td>
          <td class="truncate">{{ project.username }}</td>
          <td class="truncate"><a :href="project.git_repository" target="_blank">{{ project.git_repository }}</a></td>
        </tr>
      </table>
      <div class="loader loader-center" v-if="projects == null && getProjectError == null"></div>
      <div class="error" v-if="getProjectError != null">
        {{ getProjectError }}
      </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'ProjectsTable',
  props: ['projects'],
  computed: mapGetters(['getProjectError']),
  methods: {
    openProject (key) {
      this.$router.push('/project/' + key)
    }
  }
}
</script>

<style scoped>
.projects-container {
  background-color: white;
  height: 668px;
}

table {
  border-collapse: collapse;
  width: 96%;
  margin-left: 2%;
  font-size: 18px;
}

td, th {
  text-align: left;
  padding: 8px;
  width: 33.33%;
}

tr {
  background-color: white;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.table-body:hover {
  background-color: #CCC5B9;
  cursor: pointer;
}

.truncate {
  max-width: 1px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.error {
  color: red;
  font-size: 20px;
  text-align: center;
}
</style>
