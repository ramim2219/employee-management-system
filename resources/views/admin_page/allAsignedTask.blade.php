@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <style>
        .task-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin: 10px 0;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
        }

        .task-card:hover {
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        .task-card h3 {
            margin-top: 0;
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .task-card p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        .task-card .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 12px;
            color: #fff;
            font-size: 14px;
            text-transform: capitalize;
            font-weight: 500;
        }

        .status-uncomplete {
            background-color: #6c757d;
        }

        .status-approve {
            background-color: #28a745;
        }

        .status-cancel {
            background-color: #dc3545;
        }

        .status-completed {
            background-color: #17a2b8;
        }

        .btn {
            padding: 8px 16px;
            margin: 4px;
            font-size: 14px;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-approve:hover {
            background-color: #218838; /* Darker green */
        }

        .btn-cancel:hover {
            background-color: #c82333; /* Darker red */
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .task-card {
                padding: 15px;
            }

            .btn {
                font-size: 13px;
            }
        }
    </style>
    <div class="content container mt-4">
        <h1 class="mb-4">Assigned Tasks Overview</h1>
        
        <!-- Check if there are tasks -->
        @if($tasks->isEmpty())
            <div class="alert alert-info">No tasks available.</div>
        @else
            @foreach($tasks as $task)
                <div class="task-card">
                    <h3>Task ID: {{ $task->id }}</h3>
                    <p><strong>Title:</strong> {{ $task->title }}</p>
                    <p><strong>Description:</strong> {{ $task->description }}</p>
                    <p><strong>Status:</strong>
                        @if($task->status == 0)
                            <span class="status-badge status-uncomplete">Uncomplete</span>
                        @elseif ($task->status == 1)
                            <div>
                                <a href="{{ route('tasks.Approve', $task->id) }}" class="btn btn-approve">Approve</a>
                                <a href="{{ route('tasks.Cancel', $task->id) }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        @else
                            <span class="status-badge status-completed">Completed</span>
                        @endif
                    </p>
                    <p><strong>Task Report:</strong> {{ $task->task_report }}</p>
                    <p><strong>Assigned To:</strong> {{ $task->full_name }}</p> <!-- Full name of the employee -->
                    <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($task->created_at)->format('d M Y, h:i A') }}</p> <!-- Formatted date using Carbon -->
                </div>
            @endforeach
        @endif
    </div>
</main>
@endsection
