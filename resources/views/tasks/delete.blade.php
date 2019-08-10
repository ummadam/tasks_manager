@extends('layouts.main')
    @section('title','Delete task')

        @section('content')
        <div class="row">
            <h1>Delete Task</h1>
            {!! Form::model($task,['route' => ['task.destroy',$task->id],'method'=>'DELETE']) !!}

                @component('components.taskform')
                @endcomponent

            {!! Form::close() !!}

        </div>
        @endsection


