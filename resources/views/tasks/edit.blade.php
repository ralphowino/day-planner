@extends('layouts.app')

@section('content')
    <div class="panel">
        <div class="panel-body">
            {!! Former::open()->route('tasks.update', $task->id) !!}
            {!! Former::text('name') !!}
            {!! Former::textarea('description') !!}
            {!! Former::datetime('due_at')->placeholder('YYYY-MM-DD HH:MM') !!}
            {!! Former::datetime('start_at')->placeholder('YYYY-MM-DD HH:MM') !!}
            {!! Former::select('assigned_to')->options($users) !!}
            {!! Former::select('status')->options($statuses) !!}
            {!! Former::submit('Update')->class('btn btn-success') !!}
            {!! Former::close() !!}
        </div>
    </div>
@endsection
