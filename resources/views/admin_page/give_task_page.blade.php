@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content container mt-4">
        <a href="{{ route('allAssignedTasks') }}" class="btn btn-success">Show All Assigned Task</a>
        <h2>Create New Task</h2>
        <form action="{{ route('saveTask') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="employee" class="form-label">Select Employee</label>
                <select id="employee" name="employee_id" class="form-select">
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->user_id }}">
                            {{ $employee->full_name }} 
                            <small class="text-muted">({{ $employee->position_name }})</small>
                        </option>
                    @endforeach
                    <option value="all_employees">All Employees</option>
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="task_title" class="form-label">Task Title</label>
                <input type="text" id="task_title" name="task_title" class="form-control" required>
            </div>
            <div class="form-group mb-4">
                <label for="task_description" class="form-label">Task Description</label>
                <textarea id="task_description" name="task_description" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
</main>
@endsection
