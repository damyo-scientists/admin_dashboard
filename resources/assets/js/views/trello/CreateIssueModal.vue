<template>
  <b-modal title="이슈 생성하기" class="modal-primary" v-model="createIssueModal" @ok="hideModal">
    <b-form @submit="onSubmit" @reset="onReset">

    </b-form>
    <div slot="modal-footer" class="w-100">
      <b-btn type="button" class="float-right" variant="secondary" @click="hideModal">취소</b-btn>
      <b-btn type="button" class="float-right" variant="primary">생성하기</b-btn>
    </div>
  </b-modal>
</template>

<script>
  export default {
    name: "create-issue-modal",
    props: {
      createIssueModal: {
        type: Boolean,
        default() {
          return false
        }
      }
    },
    methods: {
      onSubmit: function () {

      },
      onReset: function () {
      },
      hideModal: function () {
        this.createIssueModal = false
        this.$emit('click')
      }
    }
  }
</script>

<style scoped>

</style>