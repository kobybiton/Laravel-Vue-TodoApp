<template>

<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div id="app" class="todolist not-done">
                <div>
                    <h1>Todos</h1>    
                        <div class="new-todo">
                            <input type="text" v-model="newTask" class="form-control add-todo" placeholder="New Task"/>
                            <span>
                                <button v-on:click="addTask" class="btn btn-success pull-left">Add Task</button>
                            </span>
                        </div>        
                        <ul id="sortable" class="list-unstyled">
                            <li v-if="task.deleted === 0" v-for="(task, index) in tasks" class="ui-state-default">
                                <div v-bind:class="task.finished === 1 ? 'finished-true':''">
                                    <label v-bind:class="{ active: task.finished }" v-on:click="markTask(task.id, task)">{{ task.name }}</label>
                                    <span class="todo-buttons pull-right">
                                        <button v-on:click="deleteTask(task.id, index)" class="btn">Delete</button>
                                     </span>
                                </div>
                            </li>                                                      
                        </ul>
                    <div class="todo-footer">
                        <strong><span class="count-todos"></span></strong> Tasks Left to do: {{ remainTasks }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>
    
<script>

    export default {

        name: 'Tasks',

        data(){

            return{
                tasks: [],
                newTask: '',    
                name: '',
                deleted: true,
                finished: false,
                counter: 0
            }          
        },

        methods: {

            addTask: function(){

                let component = this;    
                if(component.newTask){
                    axios({
                        method: 'POST',
                        url: 'create_task',
                        data: {
                            newTask: component.newTask
                        }
                    })
                    .then(function(response){
                        if(response){
                            component.tasks.push(response.data);
                            component.newTask = '';
                        }
                    })
                    .catch(function(error){
                        console.log(error);
                    }); 
                }               
            },

            markTask: function(id, task){

                let component = this;    
                task.finished = !task.finished; 
                component.finished = !task.finished;
                
                axios({
                    method: 'POST',
                    url: 'finished_task/' + id,
                    data: {
                        finished: task.finished 
                    }
                })
                .then(function(response){
                   
                })
                .catch(function(error){
                    console.log(error);
                });                  
            },    

            deleteTask: function(id , index){

                let component = this;    
                
                axios({
                    method: 'POST',
                    url: 'delete_task/' + id,
                    data: {
                        deleted: component.deleted
                    }
                })
                .then(function(response){

                    var data_id = response.data.id;

                    if(id === data_id){

                        component.tasks.splice(index, 1);
                    }
                })
                .catch(function(error){
                    console.log(error);
                });                   
            }
        },

        computed: {
            
            remainTasks: function () {
              
                let component = this;  
                var tasksToComplete = [];

                for(var key in component.tasks){
    
                    if(component.tasks[key].deleted === 0 && component.tasks[key].finished === 0){
                        tasksToComplete.push(component.tasks[key])   
                    }
                    else if(component.tasks[key].finished === false){
                        tasksToComplete.push(component.tasks[key]); 
                    }
                    
                }   
                return tasksToComplete.length;
            }
        },        

        mounted(){
            
            let component = this;
            axios.get('get_tasks')
                .then(function(response){
                    component.tasks = response.data;
                })
            
                .catch(function(error){
                    console.log(error);
                });                        
                      
        }
    }

</script>
