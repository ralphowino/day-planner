@extends('layouts.app')

@section('content')
    <h1>
        Tasks
        <a href="{{route('tasks.create')}}" class="btn btn-sm btn-default pull-right">New Task</a>
    </h1>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Assigned To</th>
            <th>Due</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{$task->id}}</td>
            <td>{{$task->name}}</td>
            <td>{{$task->assignee->name}}</td>
            <td>{{$task->due_at->diffForHumans()}}</td>
            <td>{{$task->status}}</td>
            <td>
                <a href="{{route('tasks.show',$task->id)}}" class="btn btn-info btn-sm">Details</a>
            </td>
        </tr>
        @endforeach
        </tbody>

    </table>
@endsection
