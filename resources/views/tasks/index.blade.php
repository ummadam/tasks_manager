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
      <th scope="col">DeadLine</th>
    </tr>
  </thead>
  <tbody>
  @foreach($tasks as $task)
    <tr>
      <td>{{$task->id}}</td>
      <td>{{$task->name}}</td>
      <td>{{$task->description}}</td>
      <td>{{$task->to_do_date}}</td>
      <?php
        $date = new Carbon\Carbon;        
        $deadline = date('d',strtotime($task->to_do_date) - strtotime($date));
          //echo date('d h:i:s',strtotime($task->to_do_date) - strtotime($date));
      
        if($date > $task->to_do_date){
          ?>
          <td><p class="text-danger">ВРЕМЯ ИСТЕКЛО!!!</p></td>
          <?php
        }
        elseif($deadline == 1){
          ?>
          <td><p class="text-danger"><?php echo date('d h:i:s',strtotime($task->to_do_date) - strtotime($date)); ?></p></td>
          <?php
        }
        elseif($deadline <= 3){
          ?>
          <td><p class="text-warning"><?php echo date('d h:i:s',strtotime($task->to_do_date) - strtotime($date)); ?></p></td>
          <?php
        }
        elseif($deadline > 3){
          ?>
          <td><p class="text-success"><?php echo date('d h:i:s',strtotime($task->to_do_date) - strtotime($date)); ?></p></td>
          <?php
        }
        
      ?>             
		  
      <td>      
      {!! Form::open(['route' => ['task.destroy',$task->id],'method'=>'DELETE']) !!}
        <a href="{{ route('task.edit',$task->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('task.show',$task->id) }}" class="btn btn-light">Show</a>
        <button type="submit" class="btn btn-danger">Delete</button>
      {!! Form::close() !!}
      </td>
      
    </tr>
    @endforeach
  </tbody>
</table>
{{$tasks->links()}}
   

  @endif

@endsection

