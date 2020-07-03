<template>
  <div class="container">
    <div class="page-title">
      Public projects
    </div>
    <ProjecctsTable :projects=getPublicProjects />
    <br>
    COMPONENT THAT HAS PAGINATION
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ProjecctsTable from '@/components/ProjectsTable.vue'

export default {
  name: 'Home',
  components: {
    ProjecctsTable
  },
  mounted () {
    if (this.getPublicProjects == null) {
      this.publicProjects()
    }
  },
  computed: mapGetters(['getPublicProjects']),
  methods: {
    ...mapActions(['publicProjects'])
  }
}
</script>

<style scoped>
* {
  background-color: white;
}
</style>
