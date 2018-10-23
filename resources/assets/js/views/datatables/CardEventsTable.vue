<template>
  <div class="ui container" id="table">
    <vuetable ref="vuetable"
              api-url="revive-on.xyz/api/card-events"
              :fields="['id', 'priority', 'category', 'name', 'location', 'time', 'stage', 'image']"
    ></vuetable>
  </div>
</template>


<script>
  import Vuetable from 'vuetable-2'
  export default {
    name: "card-events-table",
    components: {
      Vuetable
    },
    mounted(){
      this.loadJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js');
      this.loadJs('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.js');
    }
  }
</script>
<style scoped>
  #table {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
</style>