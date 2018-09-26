<template>
  <div>
    <b-card>
      <p class="card-text">
        <b-badge variant="info">ISSUE-{{ task.idShort }}</b-badge>
        {{ task.name }}
      </p>
      <ul>
        <li>시작일: &nbsp;&nbsp;&nbsp;{{ task['Start Date'] | formatDate }}</li>
        <li>마감일: &nbsp;&nbsp;&nbsp;{{ task.due | formatDate }}</li>
        <li>파트: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{task.Part}}</li>
        <li>상태: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{task.Status}}</li>
      </ul>
      <b-btn v-b-toggle="task.id" size="sm">내용보기...</b-btn>
      <b-collapse :id="task.id" class="mt-2">
        <b-card><pre>{{ task.desc }}</pre></b-card>
      </b-collapse>
    </b-card>
  </div>
</template>

<script>

  export default {
    name: 'MainTask',
    props: {
      task: {
        type: Object,
        default() {
        }
      }
    },
    data() {
      return {}
    },
    computed: {}
  }
</script>

<style scoped>
</style>
