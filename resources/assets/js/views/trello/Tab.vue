<template>
  <div>
    <div v-for="task in tasks" :key="task">
      <main-task :task="task"></main-task>
    </div>
  </div>
</template>

<script>
import MainTask from './MainTask.vue'

export default {
  name: 'Tab',
  components: {
    MainTask
  },
  props: {
    user: {
      type: Object,
      default () { }
    },
    tasks: {
      type: Array,
      default () { return [] }
    }
  },
  data () {
    return {}
  },
  created: function () {

  }
}
</script>

<style scoped>
</style>
