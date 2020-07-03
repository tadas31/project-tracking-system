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
body {
  background-color: #FFFCF2;;
}

* {
  margin: 0;
  padding: 0;
}

.container {
  position: absolute;
  width: 1300px;
  left: 50%;
  top: 100px;
  padding: 10px;
  box-shadow: 0 0 10px 5px #CCC5B9;
  margin-left: -660px;
}

.meniu-header {
  z-index: 999;
  position: fixed;
}

.page-title {
  text-align: center;
  font-size: 40px;
  font-weight: bold;
  padding-bottom: 20px;
}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #EB5E28;
  border-bottom: 16px solid #EB5E28;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

.loader-center {
  position: absolute;
  top: 35%;
  left: calc(50% - 75.5px);
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
