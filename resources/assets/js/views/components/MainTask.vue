<template>
  <div>
    <b-card>
      <p class="card-text">
        <b-badge variant="info">ISSUE-{{ task.idShort }}</b-badge>
        {{ task.name }}
      </p>
      <p class="cart-text">Start date : {{ task.start }}<br>
        Due date : {{ task.due }}</p>
      <b-btn v-b-toggle="task.id" size="sm">내용보기...</b-btn>
      <b-collapse :id="task.id" class="mt-2">
        <b-card>{{ task.desc }}</b-card>
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
      default () { }
    }
  },
  data () {
    return {}
  },
  computed: {}
}
</script>

<style scoped>
</style>
