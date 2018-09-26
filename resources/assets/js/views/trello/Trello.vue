<template>
  <div>
    <h1>Trello Dashboard</h1>
    <b-alert show>회의 진행을 위한 Daily 대시보드</b-alert>
    <h2>9월</h2>
    <b-button type="button" v-on:click="createIssueModal = false" @click="createIssueModal = true" class="float-right" variant="primary">이슈 생성</b-button>
    <div>
      <tabs></tabs>
    </div>
    <create-issue-modal :createIssueModal="createIssueModal"></create-issue-modal>
  </div>
</template>

<script>
  import Tabs from './Tabs.vue'
  import CreateIssueModal from "./CreateIssueModal";

  export default {
    name: 'trello',
    components: {
      CreateIssueModal,
      Tabs
    },
    data() {
      return {
        createIssueModal: false,
      }
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
