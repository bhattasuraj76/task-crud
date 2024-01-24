@extends('layouts.master')
@section('title', 'View Task {{$task->id}}')

@section('action')
    <a class="btn btn-sm btn-success" href={{ route('tasks.create') }}>Add Task</a>
@endsection

@section('content')
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $task->title }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $task->description }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="task">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
