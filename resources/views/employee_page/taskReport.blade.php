@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content container mt-4">
        <form action="{{ route('updateTask') }}" method="POST">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <div class="form-group mb-4">
                <label for="employee_id" class="form-label">Employee ID</label>
                <input type="text" id="employee_id" name="employee_id" class="form-control" value="{{ $task->employee_id }}" disabled>
            </div>
            <div class="form-group mb-4">
                <label for="task_title" class="form-label">Task Title</label>
                <input type="text" id="task_title" name="task_title" class="form-control" value="{{ $task->title }}" disabled>
            </div>
            <div class="form-group mb-4">
                <label for="task_description" class="form-label">Task Description</label>
                <textarea id="task_description" name="task_description" class="form-control" rows="5" disabled>{{ $task->description }}</textarea>
            </div>
            <div class="form-group mb-4">
                <label for="task_report" class="form-label">Task Report</label>
                <textarea id="task_report" name="task_report" class="form-control" rows="5" required>{{ $task->task_report }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
@endsection
