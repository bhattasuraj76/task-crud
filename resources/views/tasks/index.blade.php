@extends('layouts.master')
@section('title', 'View All Tasks')

@section('styles')
    <style>
        .task_list_ul {
            margin: 0px;
            padding: 5px;
        }

        .task_list_ul li {
            list-style: none;
            padding: 5px 10px 5px 30px;
            background: #fff;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.3);
            margin-bottom: 10px;
            cursor: move;
            position: relative;
            font-size: 16px;
        }


        .task_list_ul li .pos_num {
            display: inline-block;
            padding: 2px 5px;
            /* width: 30px; */
            height: 20px;
            line-height: 17px;
            background: rgb(6, 160, 65);
            color: #fff;
            text-align: center;
            border-radius: 5px;
            position: absolute;
            left: -5px;
            top: 6px;
        }

        .task_list_ul li:hover {
            list-style: none;
            background: #7a49eb;
            /* color: #fff; */
        }

        .task_list_ul li.ui-state-highlight {
            padding: 20px;
            background-color: #eaecec;
            border: 1px dotted #ccc;
            cursor: move;
            margin-top: 12px;
        }

        .task_list_ul .btn_move {
            display: inline-block;
            cursor: move;
            background: #ededed;
            border-radius: 2px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
        }
    </style>
@section('action')
    <a class="btn btn-sm btn-success" href={{ route('tasks.create') }}>Add Task</a>
@endsection

@section('content')
    <div class="container mt-5">
        <form action="{{ route('tasks.index') }}" method="GET" class="row g-3 justify-content-center">
            <div class="col-6">
                <div class="mb-3">
                    <select class="form-control" name="project_id">
                        <option value=""> Select Project</option>
                        @foreach ($projects as $id => $title)
                            <option value="{{ $id }}"
                                @if (request()->get('project_id') == $id) {{ 'selected' }} @endif>
                                {{ $title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
            </div>
        </form>

        <div class="table-responsive">
            <div id="tasks_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($tasks->isNotEmpty())
                            <ul id="task_sortable" class="task_list_ul">
                                @foreach ($tasks as $task)
                                    <li class="ui-state-default" data-id="{{ $task->id }}">
                                        <div class="card">
                                            <div class="card-header">
                                                <span class="pos_num">{{ $loop->index + 1 }}</span>
                                                <h5 class="card-title">{{ $task->title }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $task->description }}</p>
                                            </div>
                                            <div class="card-footer">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('tasks.destroy', $task->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Oops... There are no tasks to show</h5>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#task_sortable").sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    //var data = $(this).sortable('toArray');

                    var task_ids = new Array();
                    $('#task_sortable li').each(function() {
                        task_ids.push($(this).data("id"));
                    });

                    // console.log(task_ids);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('tasks.priority_change') }}",
                        dataType: "json",
                        data: {
                            tasks: task_ids,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            $('#task_sortable li').each(function(index) {
                                $(this).find('.pos_num').text(index + 1);
                                //console.log(index);
                            });

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection
