<template>
  <datatable :columns="columns" :data="rows"></datatable>
</template>

<script>
  export default {
    name: "card-events.vue",
    table_columns: [
      {label: 'id', field: 'id'},
      {label: 'Priority', field: 'priority', headerClass: 'class-in-header second-class'},
    ],
    rows: [
      {
        "id": 1,
        "priority": 2,
        "category": "main",
        "name": "연구원 자기소개",
        "location": "laboratory",
        "time": "whenever",
        "stage": "after 1",
        "image": "hank"
      }, {
        "id": 2,
        "priority": 2,
        "category": "main",
        "name": "김대훈 자기소개",
        "location": "laboratory",
        "time": "whenever",
        "stage": "after 2",
        "image": "default"
      }, {
        "id": 3,
        "priority": 3,
        "category": "daily",
        "name": "김지수 자기소개",
        "location": "laboratory",
        "time": "morning",
        "stage": "1~3",
        "image": "default"
      }, {
        "id": 4,
        "priority": 3,
        "category": "daily",
        "name": "신벼리 자기소개",
        "location": "office",
        "time": "night",
        "stage": "3~6",
        "image": "default"
      }, {
        "id": 5,
        "priority": 3,
        "category": "daily",
        "name": "채대언 자기소개",
        "location": "office",
        "time": "afternoon",
        "stage": "3~7",
        "image": "default"
      }, {
        "id": 6,
        "priority": 1,
        "category": "daily",
        "name": "김대훈 빵구 똥구",
        "location": "office",
        "time": "afternoon",
        "stage": "3~7",
        "image": "default"
      }, {
        "id": 7,
        "priority": 1,
        "category": "daily",
        "name": "지수의 빵꾸 똥꾸 일기",
        "location": "office",
        "time": "afternoon",
        "stage": "3~7",
        "image": "default"
      }, {
        "id": 8,
        "priority": 1,
        "category": "daily",
        "name": "린생은 즐거워",
        "location": "office",
        "time": "afternoon",
        "stage": "3~7",
        "image": "default"
      }, {
        "id": 9,
        "priority": 1,
        "category": "daily",
        "name": "나는 무엇인가",
        "location": "office",
        "time": "afternoon",
        "stage": "3~7",
        "image": "default"
      }, {
        "id": 10,
        "priority": 1,
        "category": "daily",
        "name": "그대는 코스모스1",
        "location": "office",
        "time": "afternoon",
        "stage": "3~7",
        "image": "default"
      }, {
        "id": 11,
        "priority": 1,
        "category": "daily",
        "name": "그대는 코스모스2",
        "location": "office",
        "time": "afternoon",
        "stage": "3~7",
        "image": "default"
      }
    ]
  }
</script>

<style scoped>

</style>