@extends('layouts.main')

@section('title','Tasks Home')

@section('content')

  <div class="row justify-content-center mb-3">
    <a href="{{route('task.create')}}" class="btn btn-primary">Create Task</a>  
  </div>

  @if($tasks->count()==0)
  <p align="center">Not have task</p>
    @else
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Todo_date</th>
    </tr>
  </thead>
  <tbody>
  @foreach($tasks as $task)
    <tr>
      <td>{{$task->id}}</td>
      <td>{{$task->name}}</td>
      <td>{{$task->description}}</td>
      <td>{{$task->to_do_date}}</td>
      <td><a href="{{ route('task.edit',$task->id) }}" class="btn btn-light">Edit</a></td>
      <td><a href="{{ route('task.destroy',$task->id) }}" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$tasks->links()}}
   

  @endif

@endsection

