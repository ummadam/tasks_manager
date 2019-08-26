@extends('layouts.main')
    @section('title','Create task')

    

        @section('content')
        <div class="row">
            <h1>Create Task</h1>
            {!! Form::open(['route' => 'task.store','method' => 'POST']) !!}

                @component('components.taskform')
                @endcomponent

            {!! Form::close() !!}

        </div>
    @endsection


