@extends('layouts.main')
    @section('title','Delete task')

        @section('content')
        <div class="row">
            <h1>Delete Task</h1>
            {!! Form::open(['action' => ['TaskController@destroy', $task->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
             {!! Form::close() !!}

        </div>
        @endsection


