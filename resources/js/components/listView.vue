<template>
  <div>
      <table class="table">
          <th># </th>
          <th style="width: 15%;">Name</th>
          <th style="width: 30%;">Description</th>
          <th>Created At</th>
          <th>Updated at</th>

      </table>
      <div v-for="(task,index) in tasks" :key="index">
          <list-tasks

              :task="task"
              class="task"
              v-on:taskChanged="$emit('reloadList')"

          />



      </div>

  </div>
</template>



<script>
import listTasks from './listTasks'
export default {
  props : ['tasks'],
  components : {
      listTasks
  }

}


</script>


<style scoped>

.task{
  background : #e6e6e6;
  padding : 5px;
  margin-top : 5px;

}
.table{
  background : #e6e6e6;
  padding : 5px;
  margin-top : 30px;
  text-align: center;
  display: flex;
  font-weight: bold;
}
th{
  padding-right: 40px;

}



</style>
