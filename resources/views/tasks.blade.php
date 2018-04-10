@extends('layouts.app')

@section('content')

<Tasks></Tasks>  

@endsection

<style>
body{
    background-color:#EEEEEE;
}

.todolist{
    background-color:#FFF;
    padding:20px 20px 10px 20px;
    margin-top:30px;
}
.todolist h1{
    margin:0;
    padding-bottom:20px;
    text-align:center;
}
.form-control{
    border-radius:0;
}

.todolist li {
	height: 50px;
}
li.ui-state-default{
    background:#fff;
    border:none;
    border-bottom:1px solid #ddd;
    line-height: 50px;
}

li.ui-state-default:last-child{
    border-bottom:none;
}

.todo-footer{
    background-color:#F4FCE8;
    margin:0 -20px -10px -20px;
    padding: 10px 20px;
}
#done-items li{
    padding:10px 0;
    border-bottom:1px solid #ddd;
    text-decoration:line-through;
}
#done-items li:last-child{
    border-bottom:none;
}
.new-todo button{
    margin-top:10px;
}

.finished-true label{
	 text-decoration: line-through;
}

.active {
  text-decoration: line-through;
}

label{
    cursor: pointer;
}

.new-todo {
    height: 100px;
}

.todo-buttons {
    height: 40px;
    margin-top: 10px;
}
</style>

