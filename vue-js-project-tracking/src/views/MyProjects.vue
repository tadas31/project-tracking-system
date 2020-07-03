<template>
  <div class="container">
    <div class="page-title">
      My projects
      <router-link class="ripple" to="/add/project">+</router-link>
    </div>
    <ProjecctsTable :projects=getMyProjects />
    <br>
    COMPONENT THAT HAS PAGINATION
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ProjecctsTable from '@/components/ProjectsTable.vue'

export default {
  name: 'MyProjects',
  components: {
    ProjecctsTable
  },
  mounted () {
    if (this.getMyProjects == null) {
      this.myProjects()
    }
  },
  computed: mapGetters(['getMyProjects']),
  methods: {
    ...mapActions(['myProjects'])
  }
}
</script>

<style scoped>
* {
  background-color: white;
}

a {
  text-decoration: none;
  color: white;
  background-color: #EB5E28;
  padding: 0px 10px;
  border-radius: 15px;
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
</style>
