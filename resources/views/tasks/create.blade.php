@extends('layouts.master')
@section('title', 'Add Task')

@section('action')
    <a class="btn btn-sm btn-success" href={{ route('tasks.index') }}>View All Tasks</a>
@endsection

@section('content')
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Add a Task</h3>
                <form action="{{ route('tasks.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                            required>
                        @if ($errors->has('title'))
                            <div class="text-danger">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="text-danger">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                    <br>
                    <div class="mb-3 row">
                        <label for="project">Project</label>
                        <select name="project_id" class="form-control" id="project_id">
                            <option value=""> Select Project</option>
                            @foreach ($projects as $id => $title)
                                <option value="{{ $id }}"
                                    @if (old('project_id') == $id) {{ 'selected' }} @endif>
                                    {{ $title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('project_id'))
                            <div class="text-danger">{{ $errors->first('project_id') }}</div>
                        @endif
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </form>
            </div>
        </div>
    </div>
@endsection
