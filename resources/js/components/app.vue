<template>
    <div class="TodoListContainer">
        <div class="heading">
            <h2 id="title"> Todo List </h2>
            <addTask
            v-on:reloadList="getList()"
            />
         </div>
         <list-view
         :tasks="tasks"
         v-on:reloadList="getList()"


         />

     </div>
</template>



<script>
import addTask from './AddTask.vue';
import listView from './listView';
  export default {
    components : {
        addTask,
        listView,


    },
    data :function(){
        return {
            tasks:[]
        }
    },
    methods:{
        getList (){
            axios.get('api/tasks').then(response=> {
                this.tasks=response.data
            }).catch (error => {
                console.log(error);
            })
        }
    } ,
    created() {
        this.getList();
    },

}

</script>
<style scoped>
.TodoListContainer{
    width: 750px;
    margin: auto;

}

.heading{
    background: #e6e6e6;
    padding: 10px;
}
#title{
    text-align: center;
}


</style>