@extends('layouts.app')

@section('content')
    <div class="row">
        <h1>{{$task->name}}<div class="pull-right btn-group">
                {!! Former::open_inline()->route('tasks.destroy',$task->id)->method('DELETE') !!}
                <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-sm btn-info">Edit</a>
                {!! Former::submit('Archive')->class('btn btn-sm btn-danger') !!}
                {!! Former::close() !!}
            </div></h1>

        <table class="table table-striped">
            <tbody>
            <tr>
                <td>Description</td>
                <td>{{$task->description}}</td>
            </tr>
            <tr>
                <td>Start By</td>
                <td>{{$task->start_at}}</td>
            </tr>
            <tr>
                <td>Due In</td>
                <td>{{$task->due_at->diffForHumans()}}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{$task->status}}</td>
            </tr>
            <tr>
                <td>Created By</td>
                <td>{{$task->creator->name}}</td>
            </tr>
            <tr>
                <td>Assigned To</td>
                <td>{{$task->assignee->name}}</td>
            </tr>
            <tr>
                <td>Expected Outcome</td>
                <td>
                    <ul>
                        @if($task->outcome)
                            @forelse($task->outcome as $outcome)
                                <li>{{$outcome}}</li>
                            @empty
                                <li>No outcome specified</li>
                            @endforelse
                        @else
                            <li>No outcome specified</li>
                        @endif
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
