<template>
  <div>
    <Header class="meniu-header" />
    <router-view/>
  </div>
</template>

<script>
import Header from '@/components/Header.vue'

export default {
  name: 'App',
  components: {
    Header
  }
}
</script>

<style>
* {
  background-color: #FFFCF2;
  margin: 0;
  padding: 0;
}

.container {
  position: absolute;
  width: 1400px;
  left: 50%;
  top: 100px;
}

.meniu-header {
  z-index: 999;
  position: fixed;
}

.page-title {
  text-align: center;
  font-size: 40px;
  font-weight: bold;
}
</style>
