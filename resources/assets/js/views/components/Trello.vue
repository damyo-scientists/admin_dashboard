<template>
  <div>
    <h1>Trello Dashboard</h1>
    <b-alert show>회의 진행을 위한 Daily 대시보드</b-alert>
    <h2>9월</h2>
    <div>
      <tabs></tabs>
    </div>
  </div>
</template>

<script>
  import Tabs from './Tabs.vue'

  export default {
    name: 'trello',
    components: {
      Tabs
    },
    methods: {}
  }
</script>
<style>
  #trello {
    margin-left: 1em;
  }

  .heading h1 {
    margin-bottom: 0;
  }
</style>
