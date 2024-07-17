@extends('layout')
@section('content')
<main>
    <style>
        .content {
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container2 {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .img-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card-body {
            flex-grow: 1;
        }
        .card-title {
            font-weight: 500;
        }
        .card-text {
            font-weight: 400;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container2 {
                padding: 10px;
            }
            .btn {
                padding: 4px 8px;
                font-size: 12px;
            }
        }
    </style>
    @include('sidebar_layout')
    <div class="content">
        <div class="container2">
            <h1 class="mb-4">Employee List</h1>
            <div class="row">
                @if ($employees->isNotEmpty())
                    @foreach ($employees as $employee)
                        <div class="col-md-4 mb-2">
                            <div class="card p-3">
                                <img src="{{ asset('storage/' . $employee->file) }}" class="img-thumbnail" alt="Employee Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ ucfirst($employee->first_name) }} {{ ucfirst($employee->last_name) }}</h5>
                                    <p class="card-text"><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                                    <p class="card-text"><strong>Address:</strong> {{ $employee->Address }}</p>
                                    <p class="card-text"><strong>Position:</strong> {{ $employee->position_name }}</p>
                                    <p class="card-text"><strong>Phone Number:</strong> {{ $employee->phone_number }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('UpdateEmployeePage', $employee->employee_id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i> Update
                                        </a>
                                        <a href="{{ route('deleteEmployee', $employee->employee_id) }}" class="btn btn-danger btn-sm delete-user">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <div class="alert alert-warning">No employees found</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteLinks = document.querySelectorAll('.delete-user');

        deleteLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior

                const confirmation = confirm('Are you sure you want to delete this user?');

                if (confirmation) {
                    window.location.href = this.href; // Proceed with the deletion if confirmed
                }
            });
        });
    });
</script>
@endsection
