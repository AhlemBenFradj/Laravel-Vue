<template>
    <div class="addTask">
       <input type="text" name="name" v-model="task.name" placeholder="Task Name" class="form-control" />
      <input type="text" name="description" v-model="task.description" placeholder="Task Description" class="form-control" />
      <font-awesome-icon
        icon="plus-square"
        @click="addTask()"
        :class="[task.name && task.description ? 'active' : 'inactive', 'plus']"
      />
      <br>
      <Modal :errors="errors" v-if="showModal" @close="showModal = false" />

      <list-tasks></list-tasks>
    </div>
  </template>

  <script>
  import Modal from './Modal';
import listView from './listView'
  import axios from 'axios';

  export default {
    components: {
      Modal,listView

    },
    data() {
      return {
        task: {
          name: "",
          description: ""
        },
        errors: [],
        showModal: false
      };
    },
    methods: {
      addTask() {
        this.errors = [];

         if (!this.task.name || !this.task.description) {
          this.errors.push("Task name and description are required.");
          this.showModal = true;
          return;
        }

         axios
          .post("api/task/store", { task: this.task })
          .then(response => {
            if (response.status === 201) {
              this.task.name = "";
              this.task.description = "";
              this.errors = [];
              this.$emit("reloadList");
            }
          })
          .catch(error => {
            // Handle API errors
            if (error.response && error.response.status === 422) {
               this.errors = Object.values(error.response.data.errors).flat();
              this.showModal = true;
            } else {
              // Other errors
              console.error("API Error:", error);
            }
          });
      }
    }
  }
  </script>

  <style scoped>
  .addTask {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  input {
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
  }

  .plus {
    font-size: 20px;
  }

  .active {
    color: #00ce25;
  }

  .inactive {
    color: #999999;
  }
  </style>