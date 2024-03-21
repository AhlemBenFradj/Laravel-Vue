<template>
    <div class="task">
        <input type="checkbox"
        @change="updateCheck()"
        v-model="task.completed" />
        <tbody class="table">
            <tr>
                <td style="width: 150px;"> <!-- Adjust width as needed -->
                    <span :class="[task.completed ? 'completed': '' , 'TaskText' ]">{{ task.name }}</span>
                </td>
                <td style="width: 250px;"> <!-- Adjust width as needed -->
                    <span :class="[task.completed ? 'completed': '' , 'TaskText' ]">{{ task.description }}</span>
                </td>
                <td style="width: 150px;"> <!-- Adjust width as needed -->
                    <span :class="[task.completed ? 'completed': '' , 'TaskText' ]">{{ formatDate(task.created_at) }}</span>
                </td>
                <td style="width: 150px;"> <!-- Adjust width as needed -->
                    <span :class="[task.completed ? 'completed': '' , 'TaskText' ]">{{ formatDate(task.updated_at) }}</span>
                </td>
            </tr>
            <!-- More rows if needed -->
        </tbody>

        <button @click="removeTask()" class="trashcan">
            <font-awesome-icon icon="trash"></font-awesome-icon>

        </button>

     </div>

</template>



<script>
export default {
    props : ['task'],
    methods: {
        formatDate(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diffTime = Math.abs(now - date);
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)); // Use floor instead of ceil

        if (diffDays === 0) {
            // Date is today
            const formattedTime = `Today at ${date.getHours()}:${(date.getMinutes()<10?'0':'') + date.getMinutes()}`;
            return formattedTime;
        } else if (diffDays === 1) {
            // Date is yesterday
            return "Yesterday";
        } else {
            // Date is more than 1 day ago
            return `${diffDays} days ago`;
        }
    }

,
    updateCheck(){
        axios.put('api/task/'+ this.task.id , {
            task : this.task
        }) .then (response=> {
            if (response.status == 200 ){
                this.$emit('taskChanged')
            }
        }).catch (error=> {
            console.log(error);
        } )
    },removeTask(){
        axios.delete('api/task/'+ this.task.id , {
            task : this.task
        }) .then (response=> {
            if (response.status == 200 ){
                this.$emit('taskChanged')
            }
        }).catch (error=> {
            console.log(error);
        } )
    }
}

}

</script>
<style scoped>
.completed{
    text-decoration: line-through;
    color: #999999;
}
.TaskText{
    width: 100%;
    margin-left:20px ;
}
.task{
display: flex;
justify-content: center;
text-align: center;
}

.trashcan{
    background : #e6e6e6;
border: none;
color: #FF0000;
    text-align: center;
    outline: none;
}
</style>

