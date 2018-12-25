<template>
  <b-modal title="이슈 생성하기" class="modal-primary" v-model="createIssueModal" @ok="hideModal">
    <b-form @submit="onSubmit" @reset="onReset">
      <b-form-group id="titleInputGroup" label="제목 :" label-for="titleInput">
        <b-form-input id="titleInput" type="text" v-model="form.title" required placeholder="제목을 입력하세요"></b-form-input>
      </b-form-group>
      <b-form-group id="descriptionInputGroup" label="설명 :" label-for="descriptionTextarea">
        <b-form-input id="descriptionTextarea" type="textarea" v-model="form.description" rows="3" required
                         placeholder="설명을 입력하세요"></b-form-input>
      </b-form-group>
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
    data() {
      return {
        form: {
          title: '',
          description: '',
        }
      }
    },
    methods: {
      onSubmit: function () {

      },
      onReset: function () {
        this.form.title = ''
        this.description = ''
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