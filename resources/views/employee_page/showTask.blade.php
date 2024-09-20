@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5">Assigned Tasks</h1>
        </div>

        @if($tasks->isEmpty())
            <div class="alert alert-warning" role="alert">
                No tasks assigned to you.
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover table-bordered table-striped mb-0">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td class="align-middle">{{ $task->title }}</td>
                                    <td class="align-middle">{{ $task->description }}</td>
                                    <td class="align-middle text-center">
                                        @if($task->status == 0)
                                            <a href="{{ route('tasks.updateTaskStatus', $task->id) }}" class="btn btn-danger"> Uncomplete </a>
                                        @elseif ($task->status == 1)
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-success">Completed</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
