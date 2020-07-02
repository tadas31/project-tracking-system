<template>
  <div class="container">
    <div class="page-title">
      Public projects
    </div>
    <ProjecctsTable />
    <br>
    COMPONENT THAT HAS PAGINATION
  </div>
</template>

<script>
import ProjecctsTable from '@/components/ProjectsTable.vue'

export default {
  name: 'Home',
  components: {
    ProjecctsTable
  }
}
</script>

<style scoped>
* {
  background-color: white;
}

.page-title {
  padding-bottom: 20px;
}
</style>
